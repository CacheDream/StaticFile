<?php
// Configure
$configure = array();
$configure["cdnRoot"] = "http://cdn.staticfile.shareany.com/";
$configure["localRoot"] = dirname(__FILE__)."/file/";
$configure["remoteRoot"] = "//www.staticfile.net/";
$configure["siteTitle"] = "ShareAny Static File";
// Path
$path = isset($_GET["path"])?$_GET["path"]:"/";
if(substr($path, -1)!="/"){
    header("Location: ".$configure["remoteRoot"].$path."/");
}
if(substr($path, 0, 1) == "/"){
    $path = substr($path, 1);
}

// Navigation
$navigation = array();
$navigation["ShareAny Static File"] = "";
$temp = explode("/", $path);
foreach($temp  as $key=>$value){
    if(!empty($value)){
        $yes = "";
        for($i=0 ; $i<=$key; $i++){
            $yes.=$temp[$i]."/";
        }
        $navigation[$value] = $yes;
    }
}
$navigations = "";
foreach($navigation as $key => $value){
    $navigations.= '<a href="'.$configure['remoteRoot'].$value.'" title="'.$key.'">'.$key.'</a>&nbsp;/&nbsp;';
}
$navigations = substr($navigations, 0,strlen($navigations)-13);

// Initialization
$directory = $configure["localRoot"].$path;
$html = "";
$readme = "";
$logo = "";
// Show
if(is_dir($directory)){
    $folderList = array();
    $fileList = array();
    $dir = dir($directory);
    while($file = $dir->read()){
	$limitFolder = array();
	$limitFolder[] = ".";
	$limitFolder[] = "..";
	$limitFolder[] = "Help";
	$limitFolder[] = "Mirror";
        if(!in_array($file, $limitFolder)){
            if(is_dir($directory.$file)){
                $folderList[] = $file;
            }
            else{
                $fileList[] = $file;
            }
        }
    }
    $dir->close();
	natcasesort($folderList);
	natcasesort($fileList);
    foreach($folderList as $key => $value){
	$readme = "";
        $url = $value.'/';
        $code = "Folder";
        $html.= '<tr><td><a href="'.$url.'" title="'.$value.'">'.$value.'</a></td><td>'.$code.'</td></tr>';
        foreach(explode("/", $path) as $value){
            if(!empty($value)){
                $readme.= $value." ";
            }
        }
        $readme.="Static File";
    }
    foreach($fileList as $key => $value){
        if($value == "readme.txt"){
            $readme = "<div>".file_get_contents($directory.$value)."</div>";
        }
	else if($value == "logo.png" or $value == "logo.jpg" or $value == "logo.gif"){
		$logo = '<div style="text-align:center;"><img style="max-height:100px;width:auto;" src="'.$configure["cdnRoot"].$path.$value.'"></div>';
	}
        else{
            $url = $configure["cdnRoot"].$path.$value;
            $code = "";
            $extension = pathinfo($value)["extension"];
            if($extension == "js"){
                $code = '<script src="'.$url.'"></script>';
            }
            else if($extension == "css"){
                $code = '<link rel="stylesheet" href="'.$url.'">';
            }
            else if($extension == "jpg" or $extension == "png" or $extension == "gif"){
                $code = '<img src="'.$url.'">';
            }
            else{
                $code = "Unknown File";
            }
            $code = htmlspecialchars($code);
            $html.= '<tr><td><a target="_blank" href="'.$url.'" title="'.$value.'">'.$value.'</a></td><td>'.$code.'</td></tr>';
            $readme1 = "";
            foreach(explode("/", $path) as $value){
                if(!empty($value)){
                    $readme1.= $value." ";
                }
            }
            $readme1.="Static File";
		if(empty($readme)){
			$readme = $readme1;
		}
        }
    }
}
else{
    $html.=  $path;
}
// Site title
if(!empty($path)){
    $m = "";
    foreach(explode("/", $path) as $value){
        if(!empty($value)){
            $m.= $value." ";
        }
    }
    $m.= "- ".$configure["siteTitle"];
    $configure["siteTitle"] = $m;
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $configure["siteTitle"]; ?></title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=Edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=0">
		<meta name="author" content="ShareAny.com">
		<meta name="keywords" content="<?php echo $configure["siteTitle"]; ?>,<?php echo $path; ?>">
		<meta name="description" content="<?php echo $readme; ?>。<?php echo $path; ?>。<?php echo $configure["siteTitle"]; ?>。">
        <link rel="shortcut icon" type="image/vnd.microsoft.icon" href="http://main.static.shareany.com/staticfile/favicon.ico">
        <style>
            .shareany_menu {
                font-family: "Microsoft YaHei";
                background-color: #338AD1;
                color: #ffffff;
                font-size: 16px;
                height: 40px;
                overflow: hidden;
            }
            .shareany_menu ul {
                margin: 0px;
                padding: 0px;
                list-style: none;
            }
            .shareany_menu ul li {
                float: left;
            }
            .shareany_menu ul li a {
                text-decoration: none;
                display: block;
                padding: 11px 30px;
                color: #ffffff;
            }
            .shareany_menu ul li a:link, .shareany_menu ul li a:visited {
                transition: background-color 0.5s ease 0s;
            }
            .shareany_menu ul li a:hover, .shareany_menu ul li a:active, .shareany_menu ul li .active {
                background-color: #06589f;
                transition: background-color 0.5s ease 0s;
            }
        </style>
        <style>
            * {
                font-family: "Microsoft YaHei";
                font-size: 16px;
                outline: none;
            }
            html, body {
                background-color: #eee;
                margin: 0px;
            }
            table {
                /*border-top: 1px solid #ccc;*/
                border-left: 1px solid #ccc;
                width: 100%;
                background-color: #fff;
               /* margin-bottom: 20px;*/
            }
            th {
                border-right: 1px solid #ccc;
                border-bottom: 1px solid #ccc;
                padding:10px;
            }
            td {
                border-right: 1px solid #ccc;
                border-bottom: 1px solid #ccc;
                padding:10px;
            }
            a:link,
            a:visited {
            	color: #1E82CC;
            	text-decoration: none;
            }
            a:focus,
            a:hover,
            a:active {
            	color: #e2621b;
            	text-decoration: none;
            }
            .clear{clear: both;}
            .container {
                width: 100%;
                max-width: 1000px;
                margin: auto;
            }
            .readme {
                background-color: #333;
                border-top: none;
                padding: 10px;
                color: #ccc;
            }
            .navigation {
                background-color: #FFFFCC;
                border: 1px solid #ccc;
                border-top: none;
                padding: 10px;
            }
            .ad {
                background-color: #fff;
                margin-bottom:-4px;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="shareany_menu">
                <ul style="float:left;">
                    <li><a class="active" href="<?php echo $configure["remoteRoot"]; ?>" title="ShareAny Static File">ShareAny Static File</a></li>
                </ul>
 <ul style="float:right;">
                   <!-- <li><a href="/Mirror/CDNJS/" title="CDNJS Mirror">CDNJS Mirror</a></li>-->
                    <li><a href="/Mirror/BaiduCDN/" title="Baidu Mirror">Baidu Mirror</a></li>
                    <li><a href="/Mirror/StaticFile.org/" title="StaticFile.org Mirror">StaticFile.org Mirror</a></li>
                    <li><a href="/Help/" title="Help">Help</a></li>
                    <li><a target="_blank" href="http://www.shareany.com/" title="About">About</a></li>
                </ul>

                <div class="clear"></div>
            </div>
        </div>
        <!-- <div class="container">
            <div class="ad">

            </div>
        </div> -->
        <?php
            if(!empty($readme) or !(empty($logo))):
        ?>
            <div class="container">
                <div class="readme">
                    <?php echo $logo; ?>
                    <?php echo $readme; ?>
                </div>
            </div>
        <?php
            endif;
        ?>
        <div class="container">
            <div class="navigation">
                Path:&nbsp; <?php echo $navigations; ?>
            </div>
        </div>
        <div class="container">
            <table cellpadding="0" cellspacing="0" border="0">
                <?php echo $html; ?>
            </table>
        </div>
	<div class="container" style="text-align:center;">
              <a href="http://www.qiniu.com/" target="_blank" title="Qiniu"><img src="http://assets.qiniu.com/qiniu-transparent.png"></a>
        </div>
	<div style="display:none;">
		<script src="http://s6.cnzz.com/stat.php?id=5762705&web_id=5762705" language="JavaScript"></script>
	</div>
    </body>
</html>

