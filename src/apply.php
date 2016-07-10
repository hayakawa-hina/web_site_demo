<?php
	session_start();
	$conn = pg_connect("host=localhost dbname=j121613y user=j121613y");
	
	$login_mid = $_SESSION["id"];
	$get_jid = $_GET["id"];	
	
	$query = "insert into apply (j_id, m_id) values($1, $2)";
    $result = pg_prepare($conn, "my_query", $query);
    $result = pg_execute($conn, "my_query", array($get_jid, $login_mid));
?>
<html>
	<head>
		<meta http-equiv="Content-type" content="text/html" ; charset="utf-8">
		<title>情報工学科実験2　WEBアプリ（情報工学実験）</title>
		<meta http-equiv="Content-Style-Type" content="text/css">
		<link href="stylet.css" rel="stylesheet" type="text/css">
		<meta http-equiv="refresh" content="5;URL=./mypage.php">
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
			if(!isset($_SESSION["login_name"])){			
			print "<li><a href=\"./login.php\">ログイン</a></li>";
			print "<li><a href=\"./input.php\">新規登録</a></li>";
			}else{
			print "<li><a href=\"./mypage.php\">マイページ</a></li>";
			print "<li><a href=\"./logout.php\">ログアウト</a></li>";
			}			
			?>
			<li><a href="./workpage.php">アルバイト</a></li>
			<li><a href="http://www.saenai.tv/">サイト案内</a></li>
		</ul>
	</div>
		<div id="main">
		<br>
		<p class="form-title">応募が完了しました</p>
		<p class="regist-title">5秒後に自動的にマイページに移行します</p>
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