<?php
	session_start();
	$conn = pg_connect("host=localhost dbname=j121613y user=j121613y");
	
	$login_mid = $_SESSION["id"];
	
	$query4 = "select distinct * from apply where apply.m_id=$1";
	$result = pg_prepare($conn, "query4", $query4);
	$result = pg_execute($conn, "query4", array($_SESSION["id"]));
	$apply_num = pg_num_rows($result);
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
		jQuery( function($) {
			$('tbody tr[data-href]').addClass('clickable').click( function() {
				window.location = $(this).attr('data-href');
			}).find('a').hover( function() {
				$(this).parents('tr').unbind('click');
			}, function() {
				$(this).parents('tr').click( function() {
					window.location = $(this).attr('data-href');
				});
			});
		});
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
		<p class="form-title">応募中のアルバイト</p>
			<br>
			<div id="work" align="center">
			<table>
			<?php
			if($apply_num == 0){
				print "<p class=\"regist-title\">応募しているアルバイトはありません</p>";
			}else{
				print '<tr>';
					print '<th>仕事内容</th>';
					print '<th>時給</th>';
					print '<th>依頼会社</th>';
					//print '<th>年齢制限</th>';
					print '<th>カテゴリ</th>';
					print '<th>仕事場所</th>';
					print '<th>募集開始日</th>';
					print '<th>募集締切日</th>';
				print '</tr>';

				for($i = 0; $i < $apply_num; $i++){					
					$row = pg_fetch_assoc($result, $i);
					$j_id = $row["j_id"];
					
					$query = "select distinct * from jobs where jobs.id=".$j_id;
					$result_j = pg_query($conn, $query);

					$row_j = pg_fetch_assoc($result_j, 0);
					print '<tr data-href=./cancel.php?id='.$row_j["id"].'>';
						print '<td>'.$row_j["jobs_name"].'</td>';
						print '<td>'.$row_j["payment"].'円</td>';
						print '<td>'.$row_j["company"].'</td>';
						//print '<td>'.$array[$i]["limit_old_up"].'歳～'.$array[$i]["limit_old_down"].'歳</td>';
						print '<td>'.$row_j["category"].'</td>';
						print '<td>'.$row_j["address_p"].' '.$row_j["address_c"].'</td>';
						print '<td>'.$row_j["sign_year"].'-'.$row_j["sign_month"].'-'.$row_j["sign_day"].'</td>';
						print '<td>'.$row_j["limit_year"].'-'.$row_j["limit_month"].'-'.$row_j["limit_day"].'</td>';
					print '</tr>';
				}
			}
			?>
			</table>
			</div>
		
		<br>		
		</div>
		<hr>
	<div id="footer">
		<p>Copyright (c) 2015 keio</p>
	</div>
</div>
</body>
</html>