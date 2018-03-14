<?php
		$zhuce_id = $_POST["zhuce_id"];
		$zhuce_password = $_POST["zhuce_password"];
		$zhuce_phone = $_POST["zhuce_phone"];
		
//		print_r($zhuce_id);
//		print_r($zhuce_password);
//		print_r($zhuce_phone);
//		die;
		//连接到本地mysql数据库
    $myconn=mysqli_connect('192.168.187.110:3306',"root","");
//  mysqli_query("set names 'utf8'");
     //选择my_2048user为操作库
    mysqli_select_db($myconn,"my_2048user");
    $strSql = "insert into user(user_id,user_password,phone,user_create_time) values('".$zhuce_id."','".$zhuce_password."','".$zhuce_phone."','".date('Y-m-d H:i:s')."')";
//  echo $strSql;
//  die;
    $result=mysqli_query($myconn,$strSql);
    setcookie("user_name",$zhuce_id,time()+3600*24);
    if($result){
    	echo 'ok';
    }else{
    	echo 'no';
    }
//  var_dump($result);
//////  $result=mysqli_fetch_row($result);
// 
?>