<?php

if(!defined('IN_UCHOME')) {
	exit('Access Denied');
}
$id=$_GET['id'];
$query = $_SGLOBAL['db']->query("SELECT bf.*, b.* FROM ".tname('reply')." b LEFT JOIN ".tname('replyfield')." bf ON bf.replyid=b.replyid WHERE b.replyid='$id'");
$reply = $_SGLOBAL['db']->fetch_array($query);
$replyjson['title']=$reply['subject'];
$replyjson['author']=$reply['username'];
$replyjson['date']=date('Y-m-d H:i:s',$reply['dateline']);
$replyjson['image']="http://4dream.duapp.com/codrops-medium-style-page-transitions-master/images/3.jpg";
$replyjson['title_secondary']="";
$replyjson['content']=$reply['message'];
$replyjson['id']=$reply['replyid'];


capi_showmessage_by_data('rest_success',  0, $replyjson);
?>
