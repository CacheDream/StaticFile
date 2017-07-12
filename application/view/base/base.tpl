<!DOCTYPE html>
<html>
<head>
    <title>{$title}</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="CodeMommy.com">
    <meta name="keywords" content="CodeMommy Static File For Free Forever,{$keyword}">
    <meta name="description" content="CodeMommy Static File For Free Forever. {$word}">
    <link rel="shortcut icon" type="image/vnd.microsoft.icon"
          href="//static.shareany.com/public/favicon/favicon.ico">
    <link rel="stylesheet" href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="{$static}/style/theme.css">
</head>
<body>
<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            {*<a class="navbar-brand" href="{$root}" title="CodeMommy Static File">*}
            {*<img alt="CodeMommy Static File" src="{$static}/picture/logo.png">*}
            {*</a>*}
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1"
                    aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{$root}" title="CodeMommy Static File">CodeMommy Static File</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            {*<form class="navbar-form navbar-left" role="search">*}
            <div class="navbar-form navbar-left" role="search">
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon">Search</div>
                        <input type="text" class="form-control" placeholder="Keyword" id="search_input">
                    </div>
                </div>
            </div>
            {*<button type="submit" class="btn btn-default">Search</button>*}
            {*</form>*}
            <ul class="nav navbar-nav">
                <!--                <li class="active"><a href="#">Link <span class="sr-only">(current)</span></a></li>-->
                <!-- <li><a href="/Mirror/CDNJS/" title="CDNJS Mirror">CDNJS Mirror</a></li>-->
                {*<li><a href="{$root}Mirror/BaiduCDN/">Baidu Mirror <span class="sr-only">(current)</span></a></li>*}
                {*<li><a href="{$root}Mirror/StaticFile.org/">StaticFile.org Mirror <span class="sr-only">(current)</span></a></li>*}
                {*<li><a href="#">Link</a></li>*}

                {*<li class="dropdown">*}
                {*<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"*}
                {*aria-expanded="false">Mirror <span class="caret"></span></a>*}
                {*<ul class="dropdown-menu">*}
                {*<li><a href="{$root}?path=Mirror/BaiduCDN">Baidu</a></li>*}
                {*<li><a href="{$root}?path=Mirror/StaticFile.org">StaticFile.org</a></li>*}
                {*<li><a href="#">Another action</a></li>*}
                {*<li><a href="#">Something else here</a></li>*}
                {*<li role="separator" class="divider"></li>*}
                {*<li><a href="#">Separated link</a></li>*}
                {*<li role="separator" class="divider"></li>*}
                {*<li><a href="#">One more separated link</a></li>*}
                {*</ul>*}
                {*</li>*}
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                       aria-expanded="false">Mirror <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{$root}?path=Mirror/BaiduCDN">Baidu</a></li>
                        <li><a href="{$root}?path=Mirror/StaticFile.org">StaticFile.org</a></li>
                        {*<li><a href="#">Action</a></li>*}
                        {*<li><a href="#">Another action</a></li>*}
                        {*<li><a href="#">Something else here</a></li>*}
                        {*<li role="separator" class="divider"></li>*}
                        {*<li><a href="#">Separated link</a></li>*}
                    </ul>
                </li>
                <li><a href="https://github.com/CodeMommy/StaticFile" target="_blank" title="GitHub">GitHub</a></li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container-fluid -->
</nav>
<div class="container-fluid" style="padding:0;padding-top:50px;">
    {block name=main}{/block}
    <div style="text-align:center;">
        <a href="http://www.qiniu.com/" target="_blank" title="Qiniu">
            <img src="//assets.qiniu.com/qiniu-transparent.png">
        </a>
    </div>
</div>
<div>
    <script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
    <script src="//cdn.bootcss.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script>
        function search() {
            $("#project").find("tr.project").each(function () {
                var text = $.trim(String($(this).attr('data-text'))).toLowerCase();
                var keyword = $.trim(String($("#search_input").val())).toLowerCase();
                if (keyword == "") {
                    $(this).show();
                } else {
                    if (text.indexOf(keyword) >= 0) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                }
            });
        }
        $("#search_input").keydown(function () {
            if (event.keyCode == "13") {
                search();
            }
        });
        $("#search_input").on("input", function () {
            search();
        });
    </script>
</div>
<div class="hide">
    <script type="text/javascript">var cnzz_protocol = (("https:" == document.location.protocol) ? " https://" : " http://");
        document.write(unescape("%3Cspan id='cnzz_stat_icon_5762705'%3E%3C/span%3E%3Cscript src='" + cnzz_protocol + "s6.cnzz.com/stat.php%3Fid%3D5762705' type='text/javascript'%3E%3C/script%3E"));</script>
</div>
</body>
</html>