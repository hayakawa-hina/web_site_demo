<?php
	session_start();
	$conn = pg_connect("host=localhost dbname=j121613y user=j121613y");
	
	$login_mid = $_SESSION["id"];
	
?>
<html>
	<head>
		<meta http-equiv="Content-type" content="text/html" ; charset="utf-8">
		<title>情報工学科実験2　WEBアプリ（情報工学実験）</title>
		<meta http-equiv="Content-Style-Type" content="text/css">
		<link href="stylet.css" rel="stylesheet" type="text/css">
	
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
		<?php
		print "<p class=\"form-title\">".$_SESSION["login_name"]."さんのマイページ</p>";
		?>
		<br>
		<div align="center">
		<a class="button blue" href="./reset.php">ユーザー情報変更</a>
		<br>
		<a class="button blue" href="./reset_pwd.php">パスワード変更</a>
		<br>
		<a class="button blue" href="./delete.php">退会</a>
		<br>
		<a class="button blue" href="./mypage_apply.php">応募状況・キャンセル</a>
		<br>
		<a class="button blue" href="./history.php">閲覧履歴</a>
		<br>
		<a class="button blue" href="./favorite_jobs.php">おすすめのアルバイト</a>
		</div>
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