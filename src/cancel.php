<?php
	session_start();
	$conn = pg_connect("host=localhost dbname=j121613y user=j121613y");
	$get_jid = $_GET["id"];
	
	$query1 = "select * from jobs where jobs.id=$1";
	$result = pg_prepare($conn, "query1", $query1);
	$result = pg_execute($conn, "query1", array($get_jid));
	$row = pg_fetch_assoc($result, 0);
	
	$query2 = "select distinct t.id, t.tag_name from jobs j, tagged tg, tag t where j.id=$1 and tg.j_id=j.id and tg.t_id=t.id";
	$result_tag = pg_prepare($conn, "query2", $query2);
	$result_tag = pg_execute($conn, "query2", array($get_jid));
	$num_tag = pg_num_rows($result_tag);
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
			print "<li><a href=\"./mypage.php\">マイページ</a></li>";
			print "<li><a href=\"./logout.php\">ログアウト</a></li>";	
			?>
			<li><a href="./workpage.php">アルバイト</a></li>
			<li><a href="http://www.saenai.tv/">サイト案内</a></li>
		</ul>
	</div>
		<div id="main">
			<br>
			<?php print "<form action=\"./cancel_check.php?id=".$get_jid."\" method=\"POST\" id=\"inquiry2\" name=\"form4\">"; ?>
			<table border="border" cellspacing="0">
				<tr>
					<th scope="row"><label>仕事内容</label></th>
				<td>
					<?php print "<div style=\"text-align:center\">".$row["jobs_name"]."</div>"; ?>
				</td>
				</tr>
								
				<tr>
					<th scope="row"><label>時給</label></th>
				<td>
					<?php print "<div style=\"text-align:center\">".$row["payment"]."円</div>"; ?>
				</td>
				</tr>												
				
				<tr>
					<th scope="row"><label>カテゴリ</label></th>
				<td>
					<?php print "<div style=\"text-align:center\">".$row["category"]."</div>"; ?>
				</td>
				</tr>		
				
				<tr>
					<th scope="row"><label>登録会社</label></th>
				<td>
					<?php print "<div style=\"text-align:center\">".$row["company"]."</div>"; ?>
				</td>
				</tr>	
				
				<tr>
					<th scope="row"><label>仕事場所</label></th>
				<td>
					<?php print "<div style=\"text-align:center\">".$row["address_p"]." ".$row["address_c"]."</div>"; ?>
				</td>
				</tr>
				
				<tr>
					<th scope="row"><label>応募可能年齢</label></th>
				<td>
					<?php print "<div style=\"text-align:center\">".$row["limit_old_up"]."歳～".$row["limit_old_down"]."歳</div>"; ?>
				</td>
				</tr>

				<tr>
					<th scope="row"><label>応募開始日</label></th>
				<td>
					<?php print "<div style=\"text-align:center\">".$row["sign_year"]."/".$row["sign_month"]."/".$row["sign_day"]."</div>"; ?>
				</td>
				</tr>

				<tr>
					<th scope="row"><label>応募締切日</label></th>
				<td>
					<?php print "<div style=\"text-align:center\">".$row["limit_year"]."/".$row["limit_month"]."/".$row["limit_day"]."</div>"; ?>
				</td>
				</tr>
				
				
				<tr>
					<th scope="row"><label for="tag">条件</label></th>
				<td>				
				<?php	
				if($num_tag == 1){
				$row = pg_fetch_assoc($result_tag, 0);
				print "<div style=\"float:left \">";
				print "<label><input id=\"tag\" type=\"checkbox\" name=\"".$row["tag_name"]."\" value=\"".$row["tag_name"]."\" checked disabled=\"disabled\"/>".$row["tag_name"]."</label>";
				print "</div>";
				
				}else{
				$num_left =($num_tag) / 2;
				$i = 0;
				print "<div style=\"float:left \">";
				$row = pg_fetch_assoc($result_tag, $i);
				print "<label><input id=\"tag\" type=\"checkbox\" name=\"".$row["tag_name"]."\" value=\"".$row["tag_name"]."\" checked disabled=\"disabled\"/>".$row["tag_name"]."</label>";
				for($i = 1; $i < $num_left; $i++){
					$row = pg_fetch_assoc($result_tag, $i);
					print "<br>";
					print "<label><input id=\"tag\" type=\"checkbox\" name=\"".$row["tag_name"]."\" value=\"".$row["tag_name"]."\" checked disabled=\"disabled\"/>".$row["tag_name"]."</label>";
				}
				print "</div>";
				print "<div style=\"float:right \">";
				$row = pg_fetch_assoc($result_tag, $i);
				print "<label><input id=\"tag\" type=\"checkbox\" name=\"".$row["tag_name"]."\" value=\"".$row["tag_name"]."\" checked disabled=\"disabled\"/>".$row["tag_name"]."</label>";
				for($i++; $i < $num_tag; $i++){
					$row = pg_fetch_assoc($result_tag, $i);
					print "<br>";
					print "<label><input id=\"tag\" type=\"checkbox\" name=\"".$row["tag_name"]."\" value=\"".$row["tag_name"]."\" checked disabled=\"disabled\"/>".$row["tag_name"]."</label>";
				}
				print "</div>";
				
				}
				?>				
				</td>
				</tr>
				
			</table>
			<p class="submit"><input type="submit" name="キャンセル" value="キャンセル" /></p>
			</form>
		</div>
		<hr>
	<div id="footer">
		<p>Copyright (c) 2015 keio</p>
	</div>
</div>
</body>
</html>