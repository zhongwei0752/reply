<?php if(!defined('IN_UCHOME')) exit('Access Denied');?><?php subtplcheck('template/default/space_reply_list', '1385291551', 'template/default/space_reply_list');?><!DOCTYPE HTML>
<!--
Striped 2.5 by HTML5 Up!
html5up.net | @n33co
Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html class="demo-3 demo-dark">
<head>
<title>神标题</title>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<meta name="description" content="" />
<meta name="keywords" content="" />
<link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:400,400italic,700|Open+Sans+Condensed:300,700" rel="stylesheet" />

<script src="./template/default/loading/js/modernizr.custom.63321.js"></script>
<script src="./template/default/list/js/jquery.min.js"></script>
<script src="./template/default/list/js/skel.min.js"></script>
<script src="./template/default/list/js/skel-panels.min.js"></script>
<script src="./template/default/list/js/init.js"></script>
<noscript>
<link rel="stylesheet" href="./template/default/list/css/skel-noscript.css" />
<link rel="stylesheet" href="./template/default/list/css/style.css" />
<link rel="stylesheet" href="./template/default/list/css/style-desktop.css" />
<link rel="stylesheet" href="./template/default/list/css/style-wide.css" />
</noscript>
<link rel="stylesheet" type="text/css" href="./template/default/loading/css/style.css" />
<!--[if lte IE 9]><link rel="stylesheet" href="./template/default/list/css/ie9.css" /><![endif]-->
<!--[if lte IE 8]><script src="./template/default/list/js/html5shiv.js"></script><link rel="stylesheet" href="./template/default/list/css/ie8.css" /><![endif]-->
<!--[if lte IE 7]><link rel="stylesheet" href="./template/default/list/css/ie7.css" /><![endif]-->
<style>
.ds-paginator{
display:none;
}
.ds-sort{
display:none;
}
.ds-meta{
text-align:center;
margin:0 auto;
width:100%;
}
#ds-thread #ds-reset .ds-account-control ul li .ds-bind-more{
display: none;
}
.ds-meta{
display:none;
}
.ds-post-reply{
display: none;
}
#ds-indicator{
width:100%;
text-align:center
margin:0 auto;
}
#skel-panels-defaultWrapper{
display:none;
}
</style>
</head>
<!--
Note: Set the body element's class to "left-sidebar" to position the sidebar on the left.
Set it to "right-sidebar" to, you guessed it, position it on the right.
-->
<body class="left-sidebar">
<section class="main" style="position:absolute;width:100%;text-algin:center;margin:10% auto;z-index:2;">
<!-- the component -->
<ul class="bokeh">
<li></li>
<li></li>
<li></li>
<li></li>
</ul>
</section>
<!-- Wrapper -->
<div id="wrapper">

<!-- Content -->
<div id="content">

<div id="content-inner">

<?php if($count) { ?>
<?php if(is_array($list)) { foreach($list as $value) { ?>
<!-- Post -->
<article class="is-post is-post-excerpt">
<header>
<h2><a href="space.php?do=reply&id=<?=$value['replyid']?>&count=<?=$count?>"><?=$value['subject']?></a></h2>
<!-- <span class="byline"><?=$value['subject']?></span> -->
</header>
<div class="info">
<?php if($value['uid']=='1') { ?>
<img src="<?php echo avatar($value[uid],small); ?>">
<?php } else { ?>
<img src="<?=$value['avatar_url']?>">
<?php } ?>
 <p style="font-size:15px;">&nbsp;<?=$value['username']?></p>
<!-- <ul class="stats">
<li><a href="#" class="fa fa-heart">32</a></li>
 <li><a href="#" class="fa fa-comment">16</a></li>

<li><a href="#" class="fa fa-twitter">64</a></li>
<li><a href="#" class="fa fa-facebook">128</a></li>
</ul>  -->
</div>
<a href="#" class="image image-full"><img src="./template/default/list/images/fotogrph-dark-stairwell.jpg" alt="" /></a>
<p>
<?=$value['message']?>
</p>
</article>
<!-- Duoshuo Comment BEGIN -->
<div class="ds-thread" data-limit="3" data-order="desc" data-category="<?=$value['replyid']?>" data-thread-key="<?=$value['replyid']?>" 
data-title="<?=$value['subject']?>" data-author-key="<?=$value['uid']?>" data-url=""></div>
<script>
var duoshuoQuery = {
   short_name: "zhongwei", 
   sso: { 
       login: "http://localhost/reply/home/space.php?&do=reply",
       logout: "http://duoshuo.com/logout/"
   }};

(function() {
    var ds = document.createElement('script');
    ds.type = 'text/javascript';ds.async = true;
    ds.src = 'http://static.duoshuo.com/embed.js';
    ds.charset = 'UTF-8';
    (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(ds);
})();
</script>

<!-- Duoshuo Comment END -->
<?php } } ?>
<!-- Pager -->
<div class="pager" style="text-align:center;">
<!--<a href="#" class="button previous">Previous Page</a>-->

<div class="pages"><?=$multi?></div>
</div>


<?php } else { ?>
<?php if($_GET['status']=='like') { ?>
<div class="c_form">还没有相关的喜欢。</div>
<?php } elseif($_GET['status']=='hotreply') { ?>
<div class="c_form">还没有相关的热评。</div>
<?php } else { ?>
<div class="c_form">还没有相关的神标题。</div>
<?php } ?>
<?php } ?>
</div>
</div>

<!-- Sidebar -->
<div id="sidebar">

<!-- Logo -->
<div id="logo">
<h1>神回复</h1>
</div>

<!-- Nav -->
<nav id="nav">
<ul>
<li <?php if(empty($_GET['status'])) { ?>class="current_page_item"<?php } ?>><a href="space.php?uid=<?=$_GET['uid']?>&do=reply">新标题</a></li>
<li <?php if($_GET['status']=='hotreply') { ?>class="current_page_item"<?php } ?>><a href="space.php?uid=<?=$_GET['uid']?>&do=reply&status=hotreply">热评论</a></li>

<!-- <li><a href="#">我关注</a></li> -->
</ul>
</nav>

<!-- Search -->
<!-- 	<section class="is-search">
<form method="post" action="#">
<input type="text" class="text" name="search" placeholder="Search" />
</form>
</section>
 -->






<!-- Copyright -->
<div id="copyright">
<p>
用户发布暂未开放<br/>
power by: <a href="#">西瓜冰团队</a><br/>
感谢多说为我们提供评论系统
</p>
</div>

</div>

</div>
<style>
  #ds-indicator {
    left:48%;
    top:48%;

  }
  </style>
  		<script>
  			$("#wrapper").hide();
$(window).load(function(){
$(".main").hide();
$("#wrapper").show();
})
</script>
</body>
</html><?php ob_out();?>