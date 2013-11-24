<?php if(!defined('IN_UCHOME')) exit('Access Denied');?><?php subtplcheck('template/default/do_login', '1385290835', 'template/default/do_login');?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html class="demo-3 demo-dark">
    <head>
        <title>登录/注册</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <meta name="description" content="Expand, contract, animate forms with jQuery wihtout leaving the page" />
        <meta name="keywords" content="expand, form, css3, jquery, animate, width, height, adapt, unobtrusive javascript"/>
<link rel="shortcut icon" href="../favicon.ico" type="image/x-icon"/>
        <link rel="stylesheet" type="text/css" href="./template/default/login/css/style.css" />
<link rel="stylesheet" type="text/css" href="./template/default/loading/css/style.css" />
 <link rel="stylesheet" type="text/css" href="./template/default/note/css/style.css" />
<script src="./template/default/loading/js/modernizr.custom.63321.js"></script>
<script src="./template/default/login/js/cufon-yui.js" type="text/javascript"></script>
<script src="./template/default/login/js/ChunkFive_400.font.js" type="text/javascript"></script>
<script type="text/javascript">
$(".wrapper").hide();
Cufon.replace('h1',{ textShadow: '1px 1px #fff'});
Cufon.replace('h2',{ textShadow: '1px 1px #fff'});
Cufon.replace('h3',{ textShadow: '1px 1px #000'});
Cufon.replace('.back');
</script>
    </head>
    <body>
<input type="checkbox" id="zhongwei" style="display:none;" class="fire-check"/>
<section style="position:absolute;width:100%;text-algin:center;margin:10px auto;">

            <div class="tn-box tn-box-color-1">
<p>登录失败</p>
<div class="tn-progress"></div>
</div>

<!--<div class="tn-box tn-box-color-2">
<p>Yummy! I just ate your settings! They were delicious!</</p>
<div class="tn-progress"></div>
</div>

<div class="tn-box tn-box-color-3">
<p>Look at me! I take much longer!<p>
<div class="tn-progress"></div>
</div>-->

</section>
<section class="main" style="position:absolute;width:100%;text-algin:center;margin:10% auto;">
<!-- the component -->
<ul class="bokeh">
<li></li>
<li></li>
<li></li>
<li></li>
</ul>
</section>
<div class="wrapper" style="padding-top:100px;">

<div class="content" >
<div id="form_wrapper" class="form_wrapper">

<form class="register">
<h3>暂不开放注册</h3>
<!--<div class="column">
<div>
<label>First Name:</label>
<input type="text" />
<span class="error">This is an error</span>
</div>
<div>
<label>Last Name:</label>
<input type="text" />
<span class="error">This is an error</span>
</div>
<div>
<label>Website:</label>
<input type="text" value="http://"/>
<span class="error">This is an error</span>
</div>
</div>
<div class="column">
<div>
<label>Username:</label>
<input type="text"/>
<span class="error">This is an error</span>
</div>
<div>
<label>Email:</label>
<input type="text" />
<span class="error">This is an error</span>
</div>
<div>
<label>Password:</label>
<input type="password" />
<span class="error">This is an error</span>
</div>
</div>
<div class="bottom">
<div class="remember">
<input type="checkbox" />
<span>Send me updates</span>
</div>
<input type="submit" value="Register" />
<a href="index.html" rel="login" class="linkform">You have an account already? Log in here</a>
<div class="clear"></div>
</div>-->
</form>
<form class="login active" id="loginform" name="loginform" action="do.php?ac=<?=$_SCONFIG['login_action']?>&<?=$url_plus?>&ref" method="post">
<h3>登录</h3>
<div>
<label>用户名:</label>
<input type="text" name="username" id="username" />
<span class="error">This is an error</span>
</div>
<div>
<label>密码: <a href="forgot_password.html" rel="forgot_password" class="forgot linkform">忘记密码？</a></label>
<input type="password" name="password" id="password"/>
<span class="error">This is an error</span>
</div>
<div class="bottom">
<div class="remember"><input type="checkbox" /><span>下次自动登录</span></div>
<input type="hidden" id="refer" name="refer" value="<?=$refer?>" />
<input type="button" id="loginsubmit" name="loginsubmit" value="登录" class="submit" tabindex="5" />
<input type="hidden" id="formhash" name="formhash" value="<?php echo formhash(); ?>" />
<a href="register.html" rel="register" class="linkform">还没有账号?点我注册吧</a>
<div class="clear"></div>
</div>
</form>
<form class="forgot_password">
<h3>Forgot Password</h3>
<div>
<label>Username or Email:</label>
<input type="text" />
<span class="error">This is an error</span>
</div>
<div class="bottom">
<input type="submit" value="Send reminder"></input>
<a href="index.html" rel="login" class="linkform">Suddenly remebered? Log in here</a>
<a href="register.html" rel="register" class="linkform">You don't have an account? Register here</a>
<div class="clear"></div>
</div>
</form>
</div>
<div class="clear"></div>
</div>
</div>


<!-- The JavaScript -->
<script type="text/javascript" src="./source/jquery-2.0.0.min.js"></script>
<script>
 $(document).ready(function () {
 $("#loginsubmit").click(function () {
 $("#zhongwei").attr("checked",false); 
 $.ajax({
                 type: "POST",
                 url: "space.php?do=cheak",
                 data:"username="+$('#username').val()+"&password="+$('#password').val()+"&formhash="+$('#formhash').val()+"&refer="+$('#refer').val()+"&loginsubmit=true",//提交表单，相当于CheckCorpID.ashx?ID=XXX
                  async: true,                    
                    success: function (data) {
                    if(data=='0'){
window.location.href='space.php?do=feed';
}else{
$("#zhongwei").attr("checked",true); 


}

                    },  //操作成功后的操作！msg是后台传过来的值
                }); 
}); 
});
</script>
<script>
$(window).load(function(){
$(".main").hide();
})
</script>
<script type="text/javascript">
$(function() {
//the form wrapper (includes all forms)
var form_wrapper	= $('#form_wrapper'),

//the current form is the one with class active
currentForm	= form_wrapper.children('form.active'),
//the change form links
linkform		= form_wrapper.find('.linkform');

//get width and height of each form and store them for later						
form_wrapper.children('form').each(function(i){
var theForm	= $(this);
//solve the inline display none problem when using fadeIn fadeOut
if(!theForm.hasClass('active'))
theForm.hide();
theForm.data({
width	: theForm.width(),
height	: theForm.height()
});
});

//set width and height of wrapper (same of current form)
setWrapperWidth();

/*
clicking a link (change form event) in the form
makes the current form hide.
The wrapper animates its width and height to the 
width and height of the new current form.
After the animation, the new form is shown
*/
linkform.bind('click',function(e){
var link	= $(this);
var target	= link.attr('rel');
currentForm.fadeOut(400,function(){
//remove class active from current form
currentForm.removeClass('active');
//new current form
currentForm= form_wrapper.children('form.'+target);
//animate the wrapper
form_wrapper.stop()
 .animate({
width	: currentForm.data('width') + 'px',
height	: currentForm.data('height') + 'px'
 },500,function(){
//new form gets class active
currentForm.addClass('active');
//show the new form
currentForm.fadeIn(400);
 });
});
e.preventDefault();
});

function setWrapperWidth(){
form_wrapper.css({
width	: <?=$currentForm['data']?>('width') + 'px',
height	: <?=$currentForm['data']?>('height') + 'px'
});
}

/*
for the demo we disabled the submit buttons
if you submit the form, you need to check the 
which form was submited, and give the class active 
to the form you want to show
*/

});
        </script>
    </body>
</html><?php ob_out();?>