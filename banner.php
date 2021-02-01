<?php

include('logic/DB.php');
include('logic/User.php');
include('logic/Image.php');

$ip_addr = $_SERVER['HTTP_CLIENT_IP'] ? : ($_SERVER['HTTP_X_FORWARDED_FOR'] ? : $_SERVER['REMOTE_ADDR']);
$user_agent = $_SERVER['HTTP_USER_AGENT'];
$page_url = (@$_SERVER['HTTPS']&&($_SERVER['HTTPS'] === 'on')?"https":"http")."://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

$user = new User($ip_addr, $user_agent, $page_url);

$image = new Image();
$image->create_image();

$db_connect = DB::get_instance();
$user->ping($db_connect);