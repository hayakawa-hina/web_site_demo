<?php
	session_start();
	$conn = pg_connect("host=localhost dbname=j121613y user=j121613y");
	
	$first_name = htmlspecialchars($_POST["first_name"]);
	$second_name = htmlspecialchars($_POST["second_name"]);
	$mail = $_POST["email"];
	$address_p = htmlspecialchars($_POST["address_p"]);
	$address_c = htmlspecialchars($_POST["address_c"]);
	
	$address_l = htmlspecialchars($_POST["address_l"]);
	$tell = $_POST["tell"];
	$postal_code1 = $_POST["postcode1"];
	$postal_code2 = $_POST["postcode2"];	
	
	$query = "update member set first_name = $1, 
								second_name = $2, 
								tell = $3, 
								postal_code1 = $4, 
								postal_code2 = $5, 
								mail = $6, 
								address_p = $7, 
								address_c = $8, 
								address_l = $9 where id = $10";
    $result = pg_prepare($conn, "my_query", $query);
    $result = pg_execute($conn, "my_query", array($first_name,
													$second_name,
													$tell,
													$postal_code1,
													$postal_code2,
													$mail,
													$address_p,
													$address_c,
													$address_l, 
													$_SESSION["id"]));
													
													
	$query4 = "select distinct * from member where member.id=$1";
	$result = pg_prepare($conn, "query4", $query4);
	$result = pg_execute($conn, "query4", array($_SESSION["id"]));
	$row = pg_fetch_assoc($result, 0);
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
		<p class="form-title">変更が完了しました</p>
		<p class="regist-title">5秒後に自動的にマイページに移行します</p>
			<div id="inquiry">
				<table border="border" cellspacing="0">
				
				<tr>
					<th scope="row" class="must">ユーザーID</th>
				<td>
					<?php print '<div id=\"regist_veiw\">'.$row["login_name"].'</div>'; ?>
				</td>
				</tr>
				
				<tr>
					<th scope="row" class="must">氏名</th>
				<td>
					<?php print '<div id=\"regist_veiw\">'.$row["first_name"].' '.$row["second_name"].'</div>'; ?>
				</td>
				</tr>
				
				<tr>
					<th scope="row" class="must">性別</th>
				<td>
					<?php print '<div id=\"regist_veiw\">'.$row["sex"].'</div>'; ?>
				</td>
				</tr>
				
				<tr>
					<th scope="row" class="must">生年月日</th>
				<td>
					<?php print '<div id=\"regist_veiw\">'.$row["birth_year"].'年'.$row["birth_month"].'月'.$row["birth_day"].'日</div>'; ?>
				</td>
				</tr>
				
				<tr>
					<th scope="row">電話番号</th>
				<td>
					<?php print '<div id=\"regist_veiw\">'.$row["tell"].'</div>'; ?>
				</td>
				</tr>
				
				<tr>
					<th scope="row" class="must">Mailアドレス</th>
				<td>
					<?php print '<div id=\"regist_veiw\">'.$row["mail"].'</div>'; ?>
				</td>
				</tr>				
				
				<tr>
					<th scope="row" class="must">住所</th>
				<td>
					<?php print '<div id=\"regist_veiw\">'.$row["address_p"].' '.$row["address_c"].' '.$row["address_l"].'</div>'; ?>
				</td>
				</tr>
				</table>
				
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