<?php
$_CACHE['apps'] = array (
  1 => 
  array (
    'appid' => '1',
    'type' => 'UCHOME',
    'name' => '个人家园',
    'url' => 'http://localhost/upload/home',
    'authkey' => 'O1s3weh2s2n926f2ubj275p7w3J3w9QcA4lfH4C8uaXa8dG2Z9D0X5bfx8y0B4L7',
    'ip' => '',
    'viewprourl' => '',
    'apifilename' => 'uc.php',
    'charset' => 'utf-8',
    'dbcharset' => 'utf8',
    'synlogin' => '1',
    'recvnote' => '1',
    'extra' => '',
    'tagtemplates' => '<?xml version="1.0" encoding="ISO-8859-1"?>
<root>
	<item id="template"><![CDATA[<a href="{url}" target="_blank">{subject}</a>]]></item>
	<item id="fields">
		<item id="subject"><![CDATA[日志标题]]></item>
		<item id="uid"><![CDATA[用户 ID]]></item>
		<item id="username"><![CDATA[用户名]]></item>
		<item id="dateline"><![CDATA[日期]]></item>
		<item id="spaceurl"><![CDATA[空间地址]]></item>
		<item id="url"><![CDATA[日志地址]]></item>
	</item>
</root>',
  ),
  2 => 
  array (
    'appid' => '2',
    'type' => 'DISCUZ',
    'name' => 'Discuz!',
    'url' => 'http://localhost/upload/bbs',
    'authkey' => '1bccCf64p8b9ua0bIbx8je2fKa7949KdGbP356pbZacei9afC5W56fCa74h2q0k3',
    'ip' => '',
    'viewprourl' => '',
    'apifilename' => 'uc.php',
    'charset' => 'utf-8',
    'dbcharset' => 'utf8',
    'synlogin' => '1',
    'recvnote' => '1',
    'extra' => '',
    'tagtemplates' => '<?xml version="1.0" encoding="ISO-8859-1"?>
<root>
	<item id="template"><![CDATA[<a href="{url}" target="_blank">{subject}</a>]]></item>
	<item id="fields">
		<item id="subject"><![CDATA[标题]]></item>
		<item id="uid"><![CDATA[用户 ID]]></item>
		<item id="username"><![CDATA[发帖者]]></item>
		<item id="dateline"><![CDATA[日期]]></item>
		<item id="url"><![CDATA[主题地址]]></item>
	</item>
</root>',
  ),
);

?>