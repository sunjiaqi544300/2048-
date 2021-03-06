<?php
		//连接到本地mysql数据库
    $myconn=mysqli_connect('192.168.187.110:3306',"root","");
    //选择my_2048user为操作库
    mysqli_select_db($myconn,"my_2048user");
    
    $strSql="select * from user where user_id='".$_COOKIE['user_name']."'";
    //用mysql_query函数从user表里读取数据
    $result=mysqli_query($myconn,$strSql);
    $result=mysqli_fetch_array($result);
   

//  print_r($result)
?>
<!DOCTYPE html>
<html>
 <head>
  <title>2048</title>
  	<meta id="viewport" name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1; user-scalable=no;"> 
  	<meta content="yes" name="apple-mobile-web-app-capable">
		<meta content="black" name="apple-mobile-web-app-status-bar-style">
		<meta content="telephone=no" name="format-detection">
  	<meta charset="utf-8" />
  <script src="zepto.js" type="text/javascript" charset="utf-8"></script>
	<script src="2048.js"></script>
	<script src="animation.js"></script>
	<script src="touch.js"></script>
  <style>
  	*{
  		margin: 0;
  		padding: 0;
  	}
  	html{
  		font-size: 86px;
  	}
	#gridPanel{
		width:4.8rem;
		height:4.8rem;
		margin:0 auto;
		background-color:#bbada0;
		border-radius:.1rem;
		position:relative;
	}
	.grid,.cell{
		width:1rem; height:1rem;
		border-radius:6%;
	}
	.grid{
	    float:left;
		margin:.16rem 0 0 .16rem;
	    background-color:#ccc0b3;
	}
	.cell{
		text-align:center;
		line-height:1rem;
		color:#776e65;
		font-size:.6rem;
		position:absolute;
	}
	/*每行拥有相同的top*/
	/*每列拥有相同的left*/
	#c00,#c01,#c02,#c03{top:.16rem;  }
	#c00,#c10,#c20,#c30{left:.16rem; }
	#c10,#c11,#c12,#c13{top:1.32rem; }
	#c01,#c11,#c21,#c31{left:1.32rem;}
	#c20,#c21,#c22,#c23{top:2.48rem; }
	#c02,#c12,#c22,#c32{left:2.48rem;}
	#c30,#c31,#c32,#c33{top:3.64rem; }
	#c03,#c13,#c23,#c33{left:3.64rem;}
	.n2{background-color:#eee3da}
	.n4{background-color:#ede0c8}
	.n8{background-color:#f2b179}
	.n16{background-color:#f59563}
	.n32{background-color:#f67c5f}
	.n64{background-color:#f65e3b}
	.n128{background-color:#edcf72}
	.n256{background-color:#edcc61}
	.n512{background-color:#9c0}
	.n1024{background-color:#33b5e5}
	.n2048{background-color:#09c}
	.n4096{background-color:#a6c}
	.n8192{background-color:#93c}
	.n8,.n16,.n32,.n64,.n128,.n256,.n512,.n1024,.n2048,.n4096,.n8192{color:#fff}
.n1024,.n2048,.n4096,.n8192{font-size:40px}
	/*显示分数的p元素*/
    p{width:4.8rem; margin:0 auto;
		font-family:Arial; font-weight:bold;
		font-size:.4rem;text-align: right;
	}
	/*GameOver界面样式*/
	#gameOver{display: none;
		/*width:1rem; height:1rem;*/
		/*position:absolute; top:0px; left:0px;*/
	}
	#gameOver div{width:100%; height:100%;
		background-color:#555; opacity:0.5;
	}
	#gameOver p{border-radius:.01rem;
		position:absolute;top:50%;left:50%;
		transform: translate(-50%,-50%);
		width:3rem; height:2rem;
		border:1px solid #edcf72;
		line-height:1.6em;
		text-align:center;
		background-color:#fff;
	}
	.button{padding:.01rem; border-radius:6%;
		background-color:#9f8b77;
		color:#fff; cursor:pointer;
	}
	.One_sore{
		height: .4rem;
		line-height: .4rem;
		font-size: .26rem;
		color: #404040;
	}
  </style>
 </head>

 <body>
  <div class="One_sore">最高记录:<?php echo $result['sore']; ?></div>
	<p>Score:<span id="score"></span></p>
	<div id="gridPanel" >
		<!--背景单元格-->
		<div id="g00" class="grid"></div>
		<div id="g01" class="grid"></div>
		<div id="g02" class="grid"></div>
		<div id="g03" class="grid"></div>

		<div id="g10" class="grid"></div>
		<div id="g11" class="grid"></div>
		<div id="g12" class="grid"></div>
		<div id="g13" class="grid"></div>

		<div id="g20" class="grid"></div>
		<div id="g21" class="grid"></div>
		<div id="g22" class="grid"></div>
		<div id="g23" class="grid"></div>

		<div id="g30" class="grid"></div>
		<div id="g31" class="grid"></div>
		<div id="g32" class="grid"></div>
		<div id="g33" class="grid"></div>
		<!--前景单元格-->
		<div id="c00" class="cell"></div>
		<div id="c01" class="cell"></div>
		<div id="c02" class="cell"></div>
		<div id="c03" class="cell"></div>

		<div id="c10" class="cell"></div>
		<div id="c11" class="cell"></div>
		<div id="c12" class="cell"></div>
		<div id="c13" class="cell"></div>

		<div id="c20" class="cell"></div>
		<div id="c21" class="cell"></div>
		<div id="c22" class="cell"></div>
		<div id="c23" class="cell"></div>

		<div id="c30" class="cell"></div>
		<div id="c31" class="cell"></div>
		<div id="c32" class="cell"></div>
		<div id="c33" class="cell"></div>
		<!--Game Over界面-->
	<div id="gameOver">
		<div><!--灰色半透明背景--></div>
		<!--前景小窗-->
		<p>Game Over!<br>
Score:<span id="finalScore"></span><br>
<a class="button" id="restart" onclick="game.start()">Try again!</a>
		</p>
	</div>
	</div>
	
 </body>
 <script type="text/javascript">
   	$(function() {
// 		alert($(window).height());
// 		alert($(window).width());
   		
   		 var target = $("#gridPanel");
	   		target.on("swipeRight",function(){
//	   		 	alert("向左");
	   		 	game.moveRight();
	   		 });
	   		target.on("swipeLeft",function(){
//	   		 	alert("向右");
	   		 	game.moveLeft();
	   		 });
	   		target.on("swipeUp",function(){
//	   		 	alert("向上");
	   		 	game.moveUp();
	   		 });
	   		target.on("swipeDown",function(){
//	   		 	alert("向下");
	   		 	game.moveDown();
	   		 });
   		}) 
 </script>
</html>
