<?php if(!defined('IN_UCHOME')) exit('Access Denied');?><?php subtplcheck('template/default/3dreplyindex', '1385291147', 'template/default/3dreplyindex');?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <title>神回复</title>
        <meta name="description" content="HexaFlip: A Flexible 3D Cube Plugin" />
        <meta name="keywords" content="hexaflip, 3d cube, css3 javascript, plugin, perspective, rotation, transition" />
        <meta name="author" content="Dan Motzenbecker for Codrops" />
        <link rel="shortcut icon" href="../favicon.ico"> 
        <link rel="stylesheet" type="text/css" href="./template/default/3dreplyindex/default.css" />
        <link href="./template/default/3dreplyindex/hexaflip.css" rel="stylesheet" type="text/css">
        <link href="./template/default/3dreplyindex/demo.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <div class="container">    
            <!-- Codrops top bar -->
            <div class="codrops-top clearfix">
                <a href="http://tympanus.net/Tutorials/InteractiveSVG/">本网站采用<strong>html5+css3</strong>构建</a>
                <span class="right"><a href="http://tympanus.net/codrops/?p=14452"><strong>不支持ie浏览</strong></a></span>
            </div><!--/ Codrops top bar -->
            <header class="clearfix">
                <h1>神回复<span><!--猜猜出下面组合字--></span></h1>    
                <nav class="codrops-demos">
                    <a href="space.php?do=reply" style="text-align:center;">进入官网</a>
                </nav>
            </header>
            <div class="main">

                <div id="hexaflip-demo1" class="demo"></div>
                <div id="hexaflip-demo2" class="demo"></div>
                
            </div>
        </div>
    <script src="./template/default/3dreplyindex/hexaflip.js"></script>
    <script>
        var hexaDemo1,
            hexaDemo2,
            hexaDemo3,
            text1 = '神回复'.split(''),
            text2 = '欢迎你'.split(''),
            settings = {
                size: 150,
                margin: 12,
                fontSize: 100,
                perspective: 450
            },
            makeObject = function(a){
                var o = {};
                for(var i = 0, l = a.length; i < l; i++){
                    o['letter' + i] = a;
                }
                return o;
            },
            getSequence = function(a, reverse, random){
                var o = {}, p;
                for(var i = 0, l = a.length; i < l; i++){
                    if(reverse){
                        p = l - i - 1;
                    }else if(random){
                        p = Math.floor(Math.random() * l);
                    }else{
                        p = i;
                    }
                    o['letter' + i] = a[p];
                }
                return o;
            };
    
        document.addEventListener('DOMContentLoaded', function(){
            hexaDemo1 = new HexaFlip(document.getElementById('hexaflip-demo1'), makeObject(text1), settings);
            hexaDemo2 = new HexaFlip(document.getElementById('hexaflip-demo2'), makeObject(text2), settings);
            hexaDemo3 = new HexaFlip(document.getElementById('hexaflip-demo3'));
    
            setTimeout(function(){
                hexaDemo1.setValue(getSequence(text1, true));
                hexaDemo2.setValue(getSequence(text2, true));
            }, 0);
    
            setTimeout(function(){
                hexaDemo1.setValue(getSequence(text1));
                hexaDemo2.setValue(getSequence(text2));
            }, 1000);
    
            setTimeout(function(){
                setInterval(function(){
                    hexaDemo1.setValue(getSequence(text1, false, true));
                    hexaDemo2.setValue(getSequence(text2, false, true));
                }, 3000);
            }, 5000);
        }, false);
    
    </script>
    </body>
</html><?php ob_out();?>