<?php
	$conn = pg_connect("host=localhost dbname=j121613y user=j121613y");
	
	$query = "select member.login_name, member.pwd from member";
	$result = pg_query($conn, $query);
	$num = pg_num_rows($result);
	for($i = 0; $i < $num; $i++){
		$row = pg_fetch_assoc($result, $i);
		$ln_list_php[$i] = htmlspecialchars($row["login_name"]);
		$pwd_list_php[$i] = $row["pwd"];
	}
	$jsonList1 = json_encode($ln_list_php);
	$jsonList2 = json_encode($pwd_list_php);
	
?>
<html>
	<head>
		<meta http-equiv="Content-type" content="text/html" ; charset="utf-8">
		<title>情報工学科実験2　WEBアプリ（情報工学実験）</title>
		<meta http-equiv="Content-Style-Type" content="text/css">
		
		<link href="stylet.css" rel="stylesheet" type="text/css">
		<script type="text/javascript" src="./md5.js"></script>
		<script type="text/javascript">
	<!--
		var ln_list_js = [];
		var pwd_list_js = [];
		var id_input = "";
		var pwd_input = "";
		
		function loadList(){
			var bar1 = JSON.parse('<?php echo $jsonList1; ?>');
			var bar2 = JSON.parse('<?php echo $jsonList2; ?>');
			var num = <?php echo $num; ?>;
			for(var i = 0; i < num; i++){
				ln_list_js.push(bar1[i]);
				pwd_list_js.push(bar2[i]);
			}
		}
		
		function idInput(id){
			id_input = id;
		}
		function pwdInput(pwd){
			pwd_input = pwd;
		}
		
		function check(){
			var num = ln_list_js.indexOf(id_input);
			if(num != -1){
				var md5_pwd_input = CybozuLabs.MD5.calc(pwd_input);
				if(pwd_list_js[num] == md5_pwd_input){
					return true;
				}else{
					var target = document.getElementById("output_13");
					target.style.color = "#ff0000";
					target.innerHTML = "パスワードが違います";
					return false;
				}			
			}else{
				var target = document.getElementById("output_13");
				target.style.color = "#ff0000";
				target.innerHTML = "入力したユーザーIDは存在しません";
				return false;
			}
		}

	// -->
	</script>
	</head>
<body onLoad="loadList()">
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
			<div id="form">
			<p class="form-title">ログイン</p>
			<form method="POST" action="./login_check.php" onSubmit="return check()">
				<p>ユーザーID</p>
				<p class="login"><input type="text" name="login_name" class="text_login_name" onchange="idInput(this.value)" /></p>
				<p>パスワード</p>
				<p class="pass"><input type="password" name="pwd" class="text_pwd" onchange="pwdInput(this.value)" /></p>
				<div id="output_13"></div>
				<br><br>
				<p class="submit"><input type="submit" value="Login" /></p>
			</form>
			</div>			
		</div>
		<hr>
	<div id="footer">
		<p>Copyright (c) 2015 keio</p>
	</div>
</div>
</body>
</html>
