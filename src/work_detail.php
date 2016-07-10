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
	
	$query3 = "select * from member where member.id=$1";
	$result_n = pg_prepare($conn, "query3", $query3);
	$result_n = pg_execute($conn, "query3", array($_SESSION["id"]));
	$row_n = pg_fetch_assoc($result_n, 0);
	
	$birth = $row_n["birth_year"].$row_n["birth_month"].$row_n["birth_month"];
	$old_year = (int) ((date('Ymd')-$birth)/10000);
	
	
	$query4 = "select distinct * from apply where apply.m_id=$1 and apply.j_id=$2";
	$result_a = pg_prepare($conn, "query4", $query4);
	$result_a = pg_execute($conn, "query4", array($_SESSION["id"], $get_jid));
	$num_a = pg_num_rows($result_a);
	
	//閲覧カウント
	$query_j = "insert into history (j_id, m_id) values($1, $2)";
    $result_j = pg_prepare($conn, "query_j", $query_j);
    $result_j = pg_execute($conn, "query_j", array($get_jid, $_SESSION["id"]));
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
		function check(){
			var flag_year = 0;
			var flag_already = 0;
			
			var old_year = <?php echo $old_year; ?>;
			var limit_old_up = <?php echo $row["limit_old_up"]; ?>;
			var limit_old_down = <?php echo $row["limit_old_down"]; ?>;
			if(limit_old_up <= old_year && limit_old_down >= old_year){
				var target = document.getElementById("output1");
				target.innerHTML = "";
				 flag_year = 0;
			}else{
				var target = document.getElementById("output1");
				target.style.color = "#ff0000";
				target.innerHTML = " ×　応募可能年齢ではありません";
				 flag_year = 1;
			}
			
			var check_already = <?php echo $num_a; ?>;
			if(check_already == 0){
				var target = document.getElementById("output_13");
				target.innerHTML = "";
				flag_already = 0;
			}else{
				var target = document.getElementById("output_13");
				target.style.color = "#ff0000";
				target.innerHTML = " 既に応募しています";
				flag_already = 1;
			}
			
			if(flag_year == 0 && flag_already == 0)
				return true;
			else
				return false;
		}
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
			<?php print "<form action=\"./apply.php?id=".$get_jid."\" method=\"POST\" id=\"inquiry2\" name=\"form4\" onSubmit=\"return check()\">"; ?>
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
					<div id="output1"></div>
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
			<div id="output_13"></div>
			<br>
			<p class="submit"><input type="submit" name="応募" value="応募" /></p>
			</form>
		</div>
		<hr>
	<div id="footer">
		<p>Copyright (c) 2015 keio</p>
	</div>
</div>
</body>
</html>