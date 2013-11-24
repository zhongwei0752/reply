<?php
/*
	神回复发布端
*/

if($_POST){
	$subject=$_POST['subject'];
	$message=$_POST['message'];
}	
	$uid=$_SGLOBAL['supe_uid'];
	$space=getspace($uid);
	if($subject){
	$replyid=inserttable("reply",array('subject'=>$subject,'uid'=>$uid,'username'=>$space['name'],'dateline'=>$_SGLOBAL['timestamp']),1);
	}
	if($message){
	inserttable("replyfield",array('message'=>$message,'replyid'=>$replyid));	
	}
	
	if($_POST['files']){
		include("./source/upload.class.php");
	  	$image= new upload;
	  	$image->upload_file($replyid,"reply");
	}
	
include_once template("cp_reply");

?>