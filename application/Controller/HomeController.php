<?php

/**
 * CodeMommy Static File
 * @author  Candison November <www.kandisheng.com>
 */

namespace Controller;

use CodeMommy\WebPHP\Input;
use CodeMommy\WebPHP\Config;
use CodeMommy\WebPHP\Me;

/**
 * Class HomeController
 * @package Controller
 */
class HomeController extends BaseController
{
    /**
     * 删除路径两边的斜杠
     *
     * @param string $string
     *
     * @return string $string
     */
    private function removePathSlash($string)
    {
        // 去掉第一个斜杠
        if (substr($string, 0, 1) == '/') {
            $string = substr($string, 1);
        }
        // 去掉最后一个斜杠
        if (substr($string, -1) == '/') {
            $string = substr($string, 0, strlen($string) - 1);
        }
        return $string;
    }

    /**
     * 列出目录里包含的文件
     *
     * @param string $path
     *
     * @return array $list
     */
    private function listFolder($path)
    {
        $list = array();
        if (is_dir($path)) {
            if (substr($path, -1) != '/') {
                $path .= '/';
            }
            $directory = dir($path);
            while ($file = $directory->read()) {
                $list[$path . $file] = $file;
            }
            $directory->close();
        }
        return $list;
    }

    /**
     * 获取文件类型
     *
     * @param $pathFull
     * @param $file
     *
     * @return string
     */
    private function getFileType($pathFull, $file)
    {
        if (in_array($file, Config::get('application.limit'))) {
            return 'hide';
        }
        if (is_dir($pathFull)) {
            return 'folder';
        }
        if (is_file($pathFull)) {
            $type = isset(pathinfo($pathFull)['extension']) ? pathinfo($pathFull)['extension'] : 'file';
            $type = strtolower($type);
            return $type;
        }
        return 'unknown';
    }

    /**
     * HomeController constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @return bool
     */
    public function index()
    {
        // 整理路径
        $path = Input::get('path', '');
        $path = $this->removePathSlash($path);
        $pathLocal = Config::get('application.file_path') . $path;
        // 列举目录里的文件
        $list = array();
        $logo = null;
        $about = null;
        foreach ($this->listFolder($pathLocal) as $pathFull => $file) {
            $array = array();
            $array['pathFull'] = $pathFull;
            $array['file'] = $file;
            $array['type'] = $this->getFileType($pathFull, $file);
            $cdn = Config::get('application.cdn');
            if (empty($path)) {
                    $array['link'] = Me::root() . '?path=' . $file;
                $array['cdn'] = $cdn . $file;
            } else {
                $array['link'] = Me::root() . '?path=' . $path . '/' . $file;
                $array['cdn'] = $cdn . $path . '/' . $file;
            }
            $list[$file] = $array;
            // 读取Logo
            if (strtolower($file) == 'logo.png') {
                $logo = 'logo.png';
            }
            // 读取readme.txt
            if (strtolower($file) == 'readme.txt') {
                $about = file_get_contents($pathFull);
            }
        }
        // 面包削
        $crumbs = array();
        $crumbs['Root'] = '/?path=';
        if (!empty($path)) {
            $temp = explode('/', $path);
            foreach ($temp as $key=>$value) {
                if($key == 0){
                    $crumbs[$value] = end($crumbs) .$value;
                }else{
                    $crumbs[$value] = end($crumbs) . '/'.$value;
                }
            }
        }
        // 输出
        $this->data['list'] = $list;
        $this->data['logo'] = $logo;
        $this->data['about'] = $about;
        $this->data['path'] = $path;
        $this->data['crumbs'] = $crumbs;
        $this->data['keyword'] = str_replace('/', ',', $path);
        $this->data['word'] = str_replace('/', ' ', $path);
        $this->data['title'] = $this->data['word'];
        return $this->template('home/index');
    }
}