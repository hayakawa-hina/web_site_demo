<?php
	$conn = pg_connect("host=localhost dbname=j121613y user=j121613y");
	
	$login_name = htmlspecialchars($_POST["login_name"]);
	$md5pwd = md5($_POST["pwd"]);
	$first_name = htmlspecialchars($_POST["first_name"]);
	$second_name = htmlspecialchars($_POST["second_name"]);
	$sex = $_POST["category"];
	$birth_year = $_POST["birth_year"];
	$birth_month = $_POST["birth_month"];
	$birth_day = $_POST["birth_day"];
	$mail = $_POST["email"];
	$address_p = htmlspecialchars($_POST["address_p"]);
	$address_c = htmlspecialchars($_POST["address_c"]);
	
	$address_l = htmlspecialchars($_POST["address_l"]);
	$tell = $_POST["tell"];
	$postal_code1 = $_POST["postcode1"];
	$postal_code2 = $_POST["postcode2"];
	
	$query = "insert into member (login_name, 
									pwd, 
									first_name, 
									second_name, 
									sex, 
									birth_year, 
									birth_month, 
									birth_day, 
									tell, 
									postal_code1, 
									postal_code2, 
									mail, 
									address_p, 
									address_c, 
									address_l) 
				values($1, $2, $3, $4, $5, $6, $7, $8, $9, $10, $11, $12, $13, $14, $15)";
    $result = pg_prepare($conn, "my_query", $query);
    $result = pg_execute($conn, "my_query", array($login_name,
													$md5pwd,
													$first_name,
													$second_name,
													$sex,
													$birth_year,
													$birth_month,
													$birth_day,
													$tell,
													$postal_code1,
													$postal_code2,
													$mail,
													$address_p,
													$address_c,
													$address_l));
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
		<p class="form-title">登録が完了しました</p>
		<p class="regist-title">5秒後に自動的にログイン画面に移行します</p>
			<div id="inquiry">
				<table border="border" cellspacing="0">
				
				<tr>
					<th scope="row" class="must">ユーザーID</th>
				<td>
					<?php print '<div id=\"regist_veiw\">'.$login_name.'</div>'; ?>
				</td>
				</tr>
				
				<tr>
					<th scope="row" class="must">氏名</th>
				<td>
					<?php print '<div id=\"regist_veiw\">'.$first_name.' '.$second_name.'</div>'; ?>
				</td>
				</tr>
				
				<tr>
					<th scope="row" class="must">性別</th>
				<td>
					<?php print '<div id=\"regist_veiw\">'.$sex.'</div>'; ?>
				</td>
				</tr>
				
				<tr>
					<th scope="row" class="must">生年月日</th>
				<td>
					<?php print '<div id=\"regist_veiw\">'.$birth_year.'年'.$birth_month.'月'.$birth_day.'日</div>'; ?>
				</td>
				</tr>
				
				<tr>
					<th scope="row">電話番号</th>
				<td>
					<?php print '<div id=\"regist_veiw\">'.$tell.'</div>'; ?>
				</td>
				</tr>
				
				<tr>
					<th scope="row" class="must">Mailアドレス</th>
				<td>
					<?php print '<div id=\"regist_veiw\">'.$mail.'</div>'; ?>
				</td>
				</tr>				
				
				<tr>
					<th scope="row" class="must">住所</th>
				<td>
					<?php print '<div id=\"regist_veiw\">'.$address_p.' '.$address_c.' '.$address_l.'</div>'; ?>
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