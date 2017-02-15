<?php

/**
 * CodeMommy Mirrors.mom
 * @author  Candison November <www.kandisheng.com>
 */

namespace Controller\Tool;

use Controller\BaseController;
use QRCode;

/**
 * Class QRGeneratorController
 * @package Controller\Tool
 */
class QRGeneratorController extends BaseController
{
    /**
     * QRGeneratorController constructor.
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
        $dataWidth = intval(isset($_GET['w']) ? $_GET['w'] : '500');
        $dataHeight = intval(isset($_GET['h']) ? $_GET['h'] : '500');
        $dataText = isset($_GET['t']) ? $_GET['t'] : 'Hello';
        $qr = new QRCode();
        $qr->setWidth($dataWidth);
        $qr->setHeight($dataHeight);
        $qr->setText($dataText);
        $qr->showInBrowser();
        return true;
    }
}