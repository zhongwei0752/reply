<?php
/*
	[UCenter Home] (C) 2007-2008 Comsenz Inc.
	$Id: space_reply.php 13208 2009-08-20 06:31:35Z liguode $
*/

if(!defined('IN_UCHOME')) {
	exit('Access Denied');
}
//登录处理函数
		$code=$_GET['code']; 
		    $url = 'http://api.duoshuo.com/oauth2/access_token';  
		    $data = array(  
		        'code'=>$code   
		    );  
		  	if($code){
		  	require_once "./source/siteUserRegister.class.php";
		  	require_once "./source/jtee.inc.php";
		  	$json_data = postData($url, $data);  
		    $array = json_decode($json_data,true);
		    if($array['code']=='0'){
		    	 	$id=$array['user_id'];
				    $file_contents = file_get_contents("http://api.duoshuo.com/users/profile.json?user_id=$id");
					$file_contents = json_decode($file_contents,true);
					$file_contents=$file_contents['response'];
				    $query = $_SGLOBAL['db']->query("SELECT * FROM ".tname('space')."  WHERE username='$id'");
					$value = $_SGLOBAL['db']->fetch_array($query);
					if(!$value){
						$username =$id;
                        $password = "123456";
                        $email = isemail($_REQUEST['email']) ? $_REQUEST['email'] : $username."@reply.com.cn";
                        $data = array(); 
                              $regClass = new siteUserRegister();
                              $uid = $regClass->reg($username, $email, $password);
                                      $setarr = array(
                                        'duoshuoid' => $id,
                                        'name'=>$file_contents['name'],
                                        'namestatus' => '1',
                                        'avatar_url' => $file_contents['avatar_url'],
                                        'social_uid'=>serialize($file_contents['social_uid']),
                                        'dateline'=>$_SGLOBAL['timestamp'],
                                        'connected_services'=>serialize($file_contents['connected_services']),
                                        'access_token'=>$array['access_token']
                                      );
                                      updatetable('space', $setarr, array('uid'=>$uid ));
                                      loaducenter();
                                      $user = uc_get_user($uid, 1); 
                                      uc_user_synlogin($uid);  
                                      $auth = setSession($user[0],$user[1]);
						
									}else{
								      $uid=$value['uid'];
									  loaducenter();	
									  $user = uc_get_user($uid, 1); 
									  uc_user_synlogin($uid);
									  $auth = setSession($user[0],$user[1]);
								} 
				    //echo '<pre>';print_r($array); 
		    }else{
		    	echo '<script language="javascript">alert(123)</script>';
		    }
		    
		  	}
		    
		      
		    function postData($url, $data)  
		    {  
		        $ch = curl_init();  
		        $timeout = 300;   
		        curl_setopt($ch, CURLOPT_URL, $url);  
		        curl_setopt($ch, CURLOPT_POST, true);  
		        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);  
		        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);  
		        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);  
		        $handles = curl_exec($ch);  
		        curl_close($ch);  
		        return $handles;  
		    }  
$status=$_GET['status'];
if($status){
$handle = fopen("http://api.duoshuo.com/sites/listTopThreads.json?short_name=zhongwei&num_items=10&range=monthly","rb");
$content = "";
while (!feof($handle)) {
    $content .= fread($handle, 10000);
}
fclose($handle);
$content = json_decode($content);
foreach ($content->response as $key) {
		if($status=="hotreply"){
			$comment=$key->comments;
			if($comment>'1'){
				$duoshuoid[]=$key->thread_key;
			}
		}elseif($status=="like"){
			$like=$key->likes;
			if($like>'0'){
				$duoshuoid[]=$key->thread_key;	
			}
		}
		
		
		/*if($duoshuoid){
		$query1 = $_SGLOBAL['db']->query("SELECT bf.*, b.* FROM ".tname('reply')." b LEFT JOIN ".tname('replyfield')." bf ON bf.replyid=b.replyid WHERE b.replyid='$duoshuoid' AND b.uid='$space[uid]'");
		$reply1 = $_SGLOBAL['db']->fetch_array($query1);
		}*/	
		
}	
$query1 = $_SGLOBAL['db']->query("SELECT bf.*, b.* FROM ".tname('reply')." b LEFT JOIN ".tname('replyfield')." bf ON bf.replyid=b.replyid WHERE b.replyid IN (".simplode($duoshuoid).")");
				while ($value1 = $_SGLOBAL['db']->fetch_array($query1)) {
				$zhong=getspace($value1['uid']);
				$value1['avatar_url']=$zhong['avatar_url'];	
				$list[]=$value1;
				}
				$count=count($duoshuoid);
				if($count>10){
					$count=10;
				}
				include_once template("space_reply_list");
		}else{

$minhot = $_SCONFIG['feedhotmin']<1?3:$_SCONFIG['feedhotmin'];

$page = empty($_GET['page'])?1:intval($_GET['page']);
if($page<1) $page=1;
$id = empty($_GET['id'])?0:intval($_GET['id']);
$classid = empty($_GET['classid'])?0:intval($_GET['classid']);

//±íÌ¬·ÖÀà
@include_once(S_ROOT.'./data/data_click.php');
$clicks = empty($_SGLOBAL['click']['replyid'])?array():$_SGLOBAL['click']['replyid'];

if($id) {
	$query = $_SGLOBAL['db']->query("SELECT bf.*, b.* FROM ".tname('reply')." b LEFT JOIN ".tname('replyfield')." bf ON bf.replyid=b.replyid WHERE b.replyid='$id'");
	$reply = $_SGLOBAL['db']->fetch_array($query);
	include_once template("space_reply_view");
} else {
	//·ÖÒ³
	$perpage = 2;
	$perpage = mob_perpage($perpage);
	
	$start = ($page-1)*$perpage;

	//¼ì²é¿ªÊ¼Êý
	ckstart($start, $perpage);

	//ÕªÒª½ØÈ¡
	$summarylen = 300;

	$classarr = array();
	$list = array();
	$userlist = array();
	$count = $pricount = 0;

	$ordersql = 'b.dateline';

	if(empty($_GET['view']) && ($space['friendnum']<$_SCONFIG['showallfriendnum'])) {
		$_GET['view'] = 'all';//Ä¬ÈÏÏÔÊ¾
	}

	//´¦Àí²éÑ¯
	$f_index = '';
	if($_GET['view'] == 'click') {
		//²È¹ýµÄÈÕÖ¾
		$theurl = "space.php?uid=$space[uid]&do=$do&view=click";
		$actives = array('click'=>' class="active"');

		$clickid = intval($_GET['clickid']);
		if($clickid) {
			$theurl .= "&clickid=$clickid";
			$wheresql = " AND c.clickid='$clickid'";
			$click_actives = array($clickid => ' class="current"');
		} else {
			$wheresql = '';
			$click_actives = array('all' => ' class="current"');
		}

		$count = $_SGLOBAL['db']->result($_SGLOBAL['db']->query("SELECT COUNT(*) FROM ".tname('clickuser')." c WHERE c.uid='$space[uid]' AND c.idtype='replyid' $wheresql"),0);
		if($count) {
			$query = $_SGLOBAL['db']->query("SELECT b.*, bf.message, bf.target_ids, bf.magiccolor FROM ".tname('clickuser')." c
				LEFT JOIN ".tname('reply')." b ON b.replyid=c.id
				LEFT JOIN ".tname('replyfield')." bf ON bf.replyid=c.id
				WHERE c.uid='$space[uid]' AND c.idtype='replyid' $wheresql
				ORDER BY c.dateline DESC LIMIT $start,$perpage");
		}
	} else {
		
		if($_GET['view'] == 'all') {
			//´ó¼ÒµÄÈÕÖ¾
			$wheresql = '1';

			$actives = array('all'=>' class="active"');

			//ÅÅÐò
			$orderarr = array('dateline','replynum','viewnum','hot');
			foreach ($clicks as $value) {
				$orderarr[] = "click_$value[clickid]";
			}
			if(!in_array($_GET['orderby'], $orderarr)) $_GET['orderby'] = '';

			//Ê±¼ä
			$_GET['day'] = intval($_GET['day']);
			$_GET['hotday'] = 7;

			if($_GET['orderby']) {
				$ordersql = 'b.'.$_GET['orderby'];

				$theurl = "space.php?uid=$space[uid]&do=reply&view=all&orderby=$_GET[orderby]";
				$all_actives = array($_GET['orderby']=>' class="current"');

				if($_GET['day']) {
					$_GET['hotday'] = $_GET['day'];
					$daytime = $_SGLOBAL['timestamp'] - $_GET['day']*3600*24;
					$wheresql .= " AND b.dateline>='$daytime'";

					$theurl .= "&day=$_GET[day]";
					$day_actives = array($_GET['day']=>' class="active"');
				} else {
					$day_actives = array(0=>' class="active"');
				}
			} else {

				$theurl = "space.php?uid=$space[uid]&do=$do&view=all";

				$wheresql .= " AND b.hot>='$minhot'";
				$all_actives = array('all'=>' class="current"');
				$day_actives = array();
			}


		} else {
			
			if(empty($space['feedfriend']) || $classid) $_GET['view'] = 'me';
			
			if($_GET['view'] == 'me') {
				//²é¿´¸öÈËµÄ
				$wheresql = "b.uid='$space[uid]'";
				$theurl = "space.php?uid=$space[uid]&do=$do&view=me";
				$actives = array('me'=>' class="active"');
				//ÈÕÖ¾·ÖÀà
				$query = $_SGLOBAL['db']->query("SELECT classid, classname FROM ".tname('class')." WHERE uid='$space[uid]'");
				while ($value = $_SGLOBAL['db']->fetch_array($query)) {
					$classarr[$value['classid']] = $value['classname'];
				}
			} else {
				$wheresql = "b.uid IN ($space[feedfriend])";
				$theurl = "space.php?uid=$space[uid]&do=$do&view=we";
				$f_index = 'USE INDEX(dateline)';
	
				$fuid_actives = array();
	
				//²é¿´Ö¸¶¨ºÃÓÑµÄ
				$fusername = trim($_GET['fusername']);
				$fuid = intval($_GET['fuid']);
				if($fusername) {
					$fuid = getuid($fusername);
				}
				if($fuid && in_array($fuid, $space['friends'])) {
					$wheresql = "b.uid = '$fuid'";
					$theurl = "space.php?uid=$space[uid]&do=$do&view=we&fuid=$fuid";
					$f_index = '';
					$fuid_actives = array($fuid=>' selected');
				}
	
				$actives = array('we'=>' class="active"');
	
				//ºÃÓÑÁÐ±í
				$query = $_SGLOBAL['db']->query("SELECT * FROM ".tname('friend')." WHERE uid='$space[uid]' AND status='1' ORDER BY num DESC, dateline DESC LIMIT 0,500");
				while ($value = $_SGLOBAL['db']->fetch_array($query)) {
					realname_set($value['fuid'], $value['fusername']);
					$userlist[] = $value;
				}
			}
		}

		//·ÖÀà
		if($classid) {
			$wheresql .= " AND b.classid='$classid'";
			$theurl .= "&classid=$classid";
		}

		//ÉèÖÃÈ¨ÏÞ
		$_GET['friend'] = intval($_GET['friend']);
		if($_GET['friend']) {
			$wheresql .= " AND b.friend='$_GET[friend]'";
			$theurl .= "&friend=$_GET[friend]";
		}

		//ËÑË÷
		if($searchkey = stripsearchkey($_GET['searchkey'])) {
			$wheresql .= " AND b.subject LIKE '%$searchkey%'";
			$theurl .= "&searchkey=$_GET[searchkey]";
			cksearch($theurl);
		}

		$count = $_SGLOBAL['db']->result($_SGLOBAL['db']->query("SELECT COUNT(*) FROM ".tname('reply')." b "),0);
		//¸üÐÂÍ³¼Æ
		if($wheresql == "b.uid='$space[uid]'" && $space['replynum'] != $count) {
			updatetable('space', array('replynum' => $count), array('uid'=>$space['uid']));
		}
		if($count) {
			$query = $_SGLOBAL['db']->query("SELECT bf.message, bf.target_ids, bf.magiccolor, b.* FROM ".tname('reply')." b $f_index
				LEFT JOIN ".tname('replyfield')." bf ON bf.replyid=b.replyid
				
				ORDER BY $ordersql DESC LIMIT $start,$perpage");
		}
	}

	if($count) {
		while ($value = $_SGLOBAL['db']->fetch_array($query)) {
			if(ckfriend($value['uid'], $value['friend'], $value['target_ids'])) {
				realname_set($value['uid'], $value['username']);
				if($value['friend'] == 4) {
					$value['message'] = $value['pic'] = '';
				} else {
					$value['message'] = getstr($value['message'], $summarylen, 0, 0, 0, 0, -1);
				}
				if($value['pic']) $value['pic'] = pic_cover_get($value['pic'], $value['picflag']);
				$zhong=getspace($value['uid']);
				$value['avatar_url']=$zhong['avatar_url'];
				$list[] = $value;
			} else {
				$pricount++;
			}
		}
	}

	//·ÖÒ³
	$multi = multi($count, $perpage, $page, $theurl);

	//ÊµÃû
	realname_get();

	$_TPL['css'] = 'reply';
	include_once template("space_reply_list");
	}
}
?>