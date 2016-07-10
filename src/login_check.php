<?php
	session_start();
	$conn = pg_connect("host=localhost dbname=j121613y user=j121613y");
?>
<html>
	<head>
		<meta http-equiv="Content-type" content="text/html" ; charset="utf-8">
		<title>情報工学科実験2　WEBアプリ（情報工学実験）</title>
		<meta http-equiv="Content-Style-Type" content="text/css">
		<link href="stylet.css" rel="stylesheet" type="text/css">
		<meta http-equiv="refresh" content="5;URL=./top.php">
	</head>
<body>
<div id="page">
	<div id="header">
		<div id="headerimg"></div>
	</div>
	<div id="menu">
		<ul class="menu_f01">
			<li><a href="./top.php">Home</a></li>
			<?php
			print "<li><a href=\"./mypage.php\">マイページ</a></li>";
			print "<li><a href=\"./logout.php\">ログアウト</a></li>";		
			?>
			<li><a href="./workpage.php">アルバイト</a></li>
			<li><a href="http://www.saenai.tv/">サイト案内</a></li>
		</ul>
	</div>
		<div id="main">
			<br>
			<?php
			$login_name = $_POST["login_name"];
			$pwd = md5($_POST["pwd"]);
			$query = "select * from member where login_name=$1 and pwd=$2";
			$result = pg_prepare($conn, "my_query", $query);
			$result = pg_execute($conn, "my_query", array($login_name, $pwd));
 
			if(pg_num_rows($result) == 1){
			$row = pg_fetch_assoc($result, 0);
			print "<p class=\"form-title\">ようこそ".$row["login_name"]."さん</p>";
			print "<p class=\"regist-title\">5秒後に自動的にホーム画面に移行します</p>";
			$_SESSION["login_name"] = $login_name;
			$_SESSION["id"] = $row["id"];
			}else{
			print "ログインＩＤかパスワードが違います<br>";
			}
			?>
		</div>
		<hr>
	<div id="footer">
		<p>Copyright (c) 2015 keio</p>
	</div>
</div>
</body>
</html>
