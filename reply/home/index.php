<?php
/*
	[UCenter Home] (C) 2007-2008 Comsenz Inc.
	$Id: index.php 13003 2009-08-05 06:46:06Z liguode $
*/

include_once('./common.php');


if($_SGLOBAL['supe_uid']) {
	//已登录，直接跳转个人首页
	showmessage('enter_the_space', 'space.php?do=home', 0);
} else {
	$a=rand(1,2);
	if($a=='1'){
	include_once template("replyindex");
	}else{
	include_once template("3dreplyindex");
	}
	
}

?>