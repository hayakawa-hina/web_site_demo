<?php
	session_start();	
	$conn = pg_connect("host=localhost dbname=j121613y user=j121613y");
	
	$query = "select * from member where member.id=$1";
	$result = pg_prepare($conn, "query", $query);
	$result = pg_execute($conn, "query", array($_SESSION["id"]));
	$row = pg_fetch_assoc($result, 0);

	$pwd[0] = $row["pwd"];
	$pwd = json_encode($pwd);
?>
<html>
	<head>
		<meta http-equiv="Content-type" content="text/html" ; charset="utf-8">
		<title>情報工学科実験2　WEBアプリ（情報工学実験）</title>
		<meta http-equiv="Content-Style-Type" content="text/css">
		<link href="stylet.css" rel="stylesheet" type="text/css">
	<script type="text/javascript" src="./md5.js"></script>
	<script type="text/javascript" src="./jquery-1.11.2.min.js"></script>
	<script type='text/javascript' src='http://code.jquery.com/jquery-git2.js'></script>
	<script type="text/javascript" src="http://jpostal.googlecode.com/svn/trunk/jquery.jpostal.js"></script>
	<script type="text/javascript">
	<!--
		var old_pwd_input = "";
		var pwd_input = "";
		var re_pwd_input = "";

		var form_flag = [0, 0];
		
		function pwdInput(pwd){
			pwd_input = pwd;
		}
		
		function old_pwdInput(pwd){
			old_pwd_input = pwd;
		}
		
		
		function pwdCheck(re_pwd){
			re_pwd_input = re_pwd;
			if(pwd_input == re_pwd){
				form_flag[1] = 0;
				var target = document.getElementById("output2");
				target.style.color = "#0bda51";
				target.innerHTML = " ○　パスワードが一致";
			}else{
				form_flag[1] = 1;
				var target = document.getElementById("output2");
				target.style.color = "#ff0000";
				target.innerHTML = " ×　パスワードが不一致";
			}			
		}
	
		function check(){
			var row_pwd = JSON.parse('<?php echo $pwd; ?>');
			var md5_pwd_input = CybozuLabs.MD5.calc(old_pwd_input);
			if(old_pwd_input == ""　|| row_pwd[0] != md5_pwd_input){
				form_flag[0] = 1;
				var target = document.getElementById("output_13");
				target.style.color = "#ff0000";
				target.innerHTML = "パスワードの入力に誤りがあります";
			}else{
				form_flag[0] = 0;
				var target = document.getElementById("output_13");
				target.innerHTML = "";
			}
		
		
			if(pwd_input == "" || form_flag[1] == 1　|| re_pwd_input == ""){
				form_flag[1] = 1;
				var target = document.getElementById("output_12");
				target.style.color = "#ff0000";
				target.innerHTML = "パスワードの入力に誤りがあります";
			}else{
				form_flag[1] = 0;
				var target = document.getElementById("output_12");
				target.innerHTML = "";
			}			

			var flag = 0;
			for(var i = 0; i < 2; i++){
				flag += form_flag[i];
			}				
			
			if(flag == 0){
				return true;
			}else{
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
		<br>
		<p class="form-title">パスワードの変更</p>
			<form action="./reset_pwd_check.php" method="POST" id="inquiry" name="form1" onSubmit="return check()">
				<table border="border" cellspacing="0">
				
				<tr>
				<th scope="row" class="must"><label for="pwd">新規パスワード<em>（必須）</em></label>
				<div id="output_12"></div>
				</th>
				<td>
					<input type="password" name="pwd" onchange="pwdInput(this.value)" size="12" id="pwd" class="text5" onFocus="focusColor(this)" onBlur="blurColor(this)"  placeholder="新規パスワード"/>
					<br><br>
					<input type="password" name="re_pwd" onchange="pwdCheck(this.value)" size="12" id="pwd" class="text5" onFocus="focusColor(this)" onBlur="blurColor(this)"  placeholder="新規パスワード再入力"/>
					<div id="output2"></div>
				</td>
				</tr>								
				
				</table>
				<p class="regist-title">旧パスワード</p>
				<table border="border" cellspacing="0">
				<tr>
				<th scope="row" class="must"><label for="old_pwd">旧パスワード</label></th>
				<td>
					<input type="password" name="old_pwd" size="12" id="pwd" class="text5" onchange="old_pwdInput(this.value)" onFocus="focusColor(this)" onBlur="blurColor(this)"/>
				</td>
				</tr>
				</table>
				<div id="output_13"></div>
				<div class="submit"><input type="submit" value="変更"></div>
			</form>
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