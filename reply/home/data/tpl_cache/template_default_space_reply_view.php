<?php if(!defined('IN_UCHOME')) exit('Access Denied');?><?php subtplcheck('template/default/space_reply_view', '1385291568', 'template/default/space_reply_view');?><!DOCTYPE html>
<html class="demo-3 demo-dark">
<head>
  <title>Medium-Style Page Transition</title>
  <meta name="viewport" content="initial-scale=1.0, width=device-width, minimum-scale=1.0, maximum-scale=2.0">

  <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:400,700,400italic,700italic|PT+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
  <link href='./template/default/view/css/styles.css' rel='stylesheet' type='text/css'>
<!--   <link rel="stylesheet" type="text/css" href="./template/default/loading/css/style.css" /> -->
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />  
  <script type="text/javascript" src='./template/default/view/js/lib/jquery.js'></script>
  <script type="text/javascript" src='./template/default/view/js/app.js'></script>
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
    </style>
</head>
<body>
 <!--  <section class="main" style="position:absolute;width:100%;text-algin:center;margin:10% auto;z-index:2;"> -->
        <!-- the component -->
        <!-- <ul class="bokeh">
          <li></li>
          <li></li>
          <li></li>
          <li></li>
        </ul>
      </section> -->
  <!-- Page. --> 
  <article class='page hidden'>
    <div class='big-image'>
        <div class='inner'>
          <div class='fader'>
            <div class='text'>
              <a class='goto-next'>下一个神回复</a>
              <h1 class='title'></h1>
              <h2 class='description'></h2>
            </div>
          </div>
        </div>
    </div>
    <div class='content'>
        <h3 class='byline'>
         <span class='author'></span><br/><time></time> 
        </h3>
      <h1 class='title'></h1>
      <h2 class='description'></h2>
      <div class='text'></div>
      <div class="ds-thread" data-limit="30" data-order="desc" data-category="<?=$id?>" data-thread-key="<?=$id?>" data-title="<?=$value['subject']?>" data-author-key="<?=$value['uid']?>" data-url=""></div>
<script type="text/javascript">
var duoshuoQuery = {short_name:"zhongwei"};
(function() {
var ds = document.createElement('script');
ds.type = 'text/javascript';ds.async = true;
ds.src = 'http://static.duoshuo.com/embed.js';
ds.charset = 'UTF-8';
(document.getElementsByTagName('head')[0] 
|| document.getElementsByTagName('body')[0]).appendChild(ds);
})();
</script>
    </div>

  </article>
 <style>
  #ds-indicator {
    left:48%;
    top:48%;

  }
  </style>
 <!-- <script>
    $(window).load(function(){
      $(".main").hide();
    })
    </script>-->
</body>
</html><?php ob_out();?>