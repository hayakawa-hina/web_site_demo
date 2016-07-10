<?php
	session_start();
	$conn = pg_connect("host=localhost dbname=j121613y user=j121613y");	

	$query1 = "delete from apply where m_id=".$_SESSION["id"];
	$result = pg_query($conn, $query1);
	
	$query3 = "delete from history where m_id=".$_SESSION["id"];
    $result = pg_query($conn, $query3);
	
	$query2 = "delete from member where id=".$_SESSION["id"];
    $result = pg_query($conn, $query2);
	session_destroy();
?>
<html>
	<head>
		<meta http-equiv="Content-type" content="text/html" ; charset="utf-8">
		<title>情報工学科実験2　WEBアプリ（情報工学実験）</title>
		<meta http-equiv="Content-Style-Type" content="text/css">
		<link href="stylet.css" rel="stylesheet" type="text/css">
		<meta http-equiv="refresh" content="5;URL=./top.php">
		
	<script type="text/javascript" src="./jquery-1.11.2.min.js"></script>
	<script type='text/javascript' src='http://code.jquery.com/jquery-git2.js'></script>
	<script type="text/javascript" src="http://jpostal.googlecode.com/svn/trunk/jquery.jpostal.js"></script>
	<script type="text/javascript">
	<!--
		
	// -->
	</script>
		
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
			print "<li><a href=\"./login.php\">ログイン</a></li>";
			print "<li><a href=\"./input.php\">新規登録</a></li>";
			?>
			<li><a href="./workpage.php">アルバイト</a></li>
			<li><a href="http://www.saenai.tv/">サイト案内</a></li>
		</ul>
	</div>
		<div id="main">
		<br>
		<p class="form-title">退会しました</p>
		<p class="regist-title">5秒後に自動的にホーム画面に移行します</p>
		<br>
		<br>
		</div>
		<hr>
	<div id="footer">
		<p>Copyright (c) 2015 keio</p>
	</div>
</div>
</body>
</html>