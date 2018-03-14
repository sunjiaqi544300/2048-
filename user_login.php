		<?php
		$name_id = $_POST["name_id"];
		$name_password = $_POST["name_password"];
//		echo 1;die;
		//连接到本地mysql数据库
    $myconn=mysqli_connect('127.0.0.1:3306',"root","");
    //选择my_2048user为操作库
    mysqli_select_db($myconn,"my_2048user");
    $strSql="select * from user where user_id='".$name_id."'";
    //用mysql_query函数从user表里读取数据
    $result=mysqli_query($myconn,$strSql);
    $result=mysqli_fetch_row($result);
//  echo 1;die;
//  print_r($result);die;
    if(!$result){
    	echo 0;
    }else{
    	if($name_password==$result['2']){
   				echo 1;
   				setcookie("user_name",$name_id,time()+3600*24);
    	}else{
    		echo 3;
    	}
    }
		?>