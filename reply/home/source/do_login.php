<?php
header("Content-Type: text/html; charset=utf8");
/*
	[UCenter Home] (C) 2007-2008 Comsenz Inc.
	$Id: do_login.php 13210 2009-08-20 07:09:06Z liguode $
*/
/** 
 *@一个完整的POST调用API的过程 百度知道 
 *@author: bo.xiao   
 */ $code=$_GET['code']; 
    $url = 'http://api.duoshuo.com/oauth2/access_token';  
    $data = array(  
        'code'=>$code   
    );  
  	if($code){
  	$json_data = postData($url, $data);  
    $array = json_decode($json_data,true);  
    echo '<pre>';print_r($array);  
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


    include_once template("do_login");
?>