<?php
	session_start();
	$conn = pg_connect("host=localhost dbname=j121613y user=j121613y");
	
	$query = "select * from member where member.id=$1";
	$result = pg_prepare($conn, "query", $query);
	$result = pg_execute($conn, "query", array($_SESSION["id"]));
	$row = pg_fetch_assoc($result, 0);
	
	$address_p[0] = $row["address_p"];
	$address_p = json_encode($address_p);
	$pwd[0] = $row["pwd"];
	$pwd = json_encode($pwd);
?>
<html>
	<head>
		<meta http-equiv="Content-type" content="text/html" ; charset="utf-8">
		<title>情報工学科実験2　WEBアプリ（情報工学実験）</title>
		<meta http-equiv="Content-Style-Type" content="text/css">
		<link href="stylet.css" rel="stylesheet" type="text/css">
	
	<script type="text/javascript" src="./jquery-1.11.2.min.js"></script>
	<script type="text/javascript" src="./md5.js"></script>
	<script type='text/javascript' src='http://code.jquery.com/jquery-git2.js'></script>
	<script type="text/javascript" src="http://jpostal.googlecode.com/svn/trunk/jquery.jpostal.js"></script>
	<script type="text/javascript">
	<!--
		var pwd_input = "";
		var form_flag = [0, 0, 0, 0, 0, 0, 0, 0, 0];
		//0: ユーザーID
		//1: パスワード,パスワード再入力
		//2: 姓,名
		//3: 性別
		//4: 誕生年誕生月誕生日
		//5: メール
		//6: 都道府県
		//7: 市区町村
		
		function onlyNum(){
			var m = String.fromCharCode(event.keyCode);
			if("0123456789\b\r".indexOf(m, 0) < 0)
				return false;
			return true;
		}
		function pwdInput(pwd){
			pwd_input = pwd;
		}
		
		$(window).ready( function() {
			$('#postcode1').jpostal({
				postcode : [
					'#postcode1',
					'#postcode2'
				],
				address : {
					'#address_p'  : '%3',
					'#address_c'  : '%4',
					'#address_l'  : '%5'
				}
			});
		});

		function mailCheck(mail){
			if(!mail.match(/.+@.+\..+/)){
				form_flag[5] = 1;
				var target = document.getElementById("output3");
				target.style.color = "#ff0000";
				target.innerHTML = " ×　メールアドレスが正しくありません";
			}else{
				form_flag[5] = 0;
				var target = document.getElementById("output3");
				target.innerHTML = "";
			}
		
		}
	
		function check(){
			var row_pwd = JSON.parse('<?php echo $pwd; ?>');
			var md5_pwd_input = CybozuLabs.MD5.calc(pwd_input);
			if(pwd_input == ""　|| row_pwd[0] != md5_pwd_input){
				form_flag[1] = 1;
				var target = document.getElementById("output_13");
				target.style.color = "#ff0000";
				target.innerHTML = "パスワードの入力に誤りがあります";
			}else{
				form_flag[1] = 0;
				var target = document.getElementById("output_13");
				target.innerHTML = "";
			}
			
		
			if(document.form1.first_name.value == "" || document.form1.second_name.value == ""){
				form_flag[2] = 1;
				var target = document.getElementById("output_34");
				target.style.color = "#ff0000";
				target.innerHTML = "姓名の入力がされていません";
			}else{
				form_flag[2] = 0;
				var target = document.getElementById("output_34");
				target.innerHTML = "";
			}
			if(document.form1.email.value == "" || form_flag[5] == 1){
				form_flag[5] = 1;
				var target = document.getElementById("output_9");
				target.style.color = "#ff0000";
				target.innerHTML = "メールアドレスの入力に誤りがあります";
			}else{
				form_flag[5] = 0;
				var target = document.getElementById("output_9");
				target.innerHTML = "";
			}				
			if(document.form1.address_p.value == ""){
				form_flag[6] = 1;
				var target = document.getElementById("output_10");
				target.style.color = "#ff0000";
				target.innerHTML = "都道府県の入力がされていません";
			}else{
				form_flag[6] = 0;
				var target = document.getElementById("output_10");
				target.innerHTML = "";
			}
			if(document.form1.address_c.value == ""){
				form_flag[7] = 1;
				var target = document.getElementById("output_11");
				target.style.color = "#ff0000";
				target.innerHTML = "市区町村の入力がされていません";
			}else{
				form_flag[7] = 0;
				var target = document.getElementById("output_11");
				target.innerHTML = "";
			}
			var flag = 0;
			for(var i = 0; i < 8; i++){
				flag += form_flag[i];
			}				
			
			if(flag == 0){
				return true;
			}else{
				return false;
			}
		}
		
		$(window).ready(function(){
			var row_address_p = JSON.parse('<?php echo $address_p; ?>');
			for(var i = 0; i < 48; i++){
				if(row_address_p[0] == document.form1.address_p.options[i].value){
					document.form1.address_p.options[i].selected= true;
				}
			}
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
		<p class="form-title">ユーザー情報変更</p>
			<form action="./reset_check.php" method="POST" id="inquiry" name="form1" onSubmit="return check()">
				<table border="border" cellspacing="0">
				<tr>
				<th scope="row"><label for="name">ユーザーID</label>
				</th>
				<td>
					<?php print "<input type=\"text\" name=\"login_name\" size=\"8\" maxlength=\"8\" id=\"name\" class=\"text5\" onFocus=\"focusColor(this)\" onBlur=\"blurColor(this)\" disabled=\"disabled\" value=\"".$row["login_name"]."\"/>"; ?>
				</td>
				</tr>				
				
				<tr>
				<th scope="row" class="must"><label for="name">氏名<em>（必須）</em></label>
				<div id="output_34"></div>
				</th>
				<td>
					<?php print "<input type=\"text\" name=\"first_name\" size=\"12\" id=\"name\" class=\"text1\" onFocus=\"focusColor(this)\" onBlur=\"blurColor(this)\"  value=\"".$row["first_name"]."\"/>"; ?>
					<?php print "<input type=\"text\" name=\"second_name\" size=\"12\" id=\"name\" class=\"text1\" onFocus=\"focusColor(this)\" onBlur=\"blurColor(this)\" value=\"".$row["second_name"]."\"/>"; ?>
				</td>
				</tr>
				
				<tr>
				<th scope="row">性別</th>
				<td>
				<?php
				if($row["sex"] == "男"){				
					print "<input name=\"category\" type=\"radio\" value=\"男\" id=\"category1\" disabled=\"disabled\" checked>";
					print "<label for=\"category1\">男 </label>";
					print "<input name=\"category\" type=\"radio\" value=\"女\" id=\"category3\" disabled=\"disabled\">";
					print "<label for=\"category3\">女</label>";
				}else{
					print "<input name=\"category\" type=\"radio\" value=\"男\" id=\"category1\" disabled=\"disabled\">";
					print "<label for=\"category1\">男 </label>";
					print "<input name=\"category\" type=\"radio\" value=\"女\" id=\"category3\" disabled=\"disabled\" checked>";
					print "<label for=\"category3\">女</label>";
				}
				?>
				</td>
				</tr>
				
				<tr>
					<th scope="row"><label for="prefecture">生年月日</label>
					</th>
				<td>
					<select name="birth_year" id="prefecture" disabled="disabled">
						<option value="" selected="selected">---- 年</option>
							<?php
							$year = date('Y');
							$year_min = $year - 18;
							for($i = 0; $i < 60; $i++){
								$year_print = $year_min - $i;
								if($row["birth_year"] == $year_print)
									print "<option value=\"$year_print\" selected>".$year_print."年</option>";
								else
									print "<option value=\"$year_print\">".$year_print."年</option>";
							}							
							?>
					</select>
					<select name="birth_month" id="prefecture" disabled="disabled">
						<option value="" selected="selected">-- 月</option>
							<?php
							for($i = 1; $i <= 12; $i++){
								$i_str = $i;
								$i_str = ($i_str < 10) ? '0'.$i_str : $i_str;
								if($row["birth_month"] == $i_str)
									print "<option value=\"$i_str\" selected>".$i."月</option>";
								else
									print "<option value=\"$i_str\">".$i."月</option>";
							}							
							?>
					</select>
					<select name="birth_day" id="prefecture" disabled="disabled">
						<option value="" selected="selected">-- 日</option>
							<?php
							for($i = 1; $i <= 31; $i++){
								$i_str = $i;
								$i_str = ($i_str < 10) ? '0'.$i_str : $i_str;
								if($row["birth_day"] == $i_str)
									print "<option value=\"$i_str\" selected>".$i."日</option>";
								else
									print "<option value=\"$i_str\">".$i."日</option>";
							}							
							?>
					</select>
				</td>
				</tr>
				
				<tr>
				<th scope="row"><label for="tell">電話番号</label></th>
				<td>
					<?php print "<input type=\"text\" name=\"tell\" onKeyDown=\"return onlyNum()\" size=\"11\" maxlength=\"11\" id=\"tell\" class=\"text5\" onFocus=\"focusColor(this)\" onBlur=\"blurColor(this)\" value=\"".$row["tell"]."\">"; ?>
				</td>
				</tr>
				
				<tr>
				<th scope="row" class="must"><label for="email">Mailアドレス<em>（必須）</em></label>
				<div id="output_9"></div>
				</th>
				<td>
					<?php print "<input type=\"text\" name=\"email\" onchange=\"mailCheck(this.value)\" size=\"30\" id=\"email\" class=\"text3\" onFocus=\"focusColor(this)\" onBlur=\"blurColor(this)\" value=\"".$row["mail"]."\">"; ?>
					<div id="output3"></div>
				</td>
				</tr>
				
				<tr>
				<th scope="row"><label for="postcode1">郵便番号</label></th>
				<td>
					<?php print "<input type=\"text\" name=\"postcode1\" onKeyDown=\"return onlyNum()\" size=\"3\" maxlength=\"3\" id=\"postcode1\" class=\"text2\" onFocus=\"focusColor(this)\" onBlur=\"blurColor(this)\" value=\"".$row["postal_code1"]."\">"; ?>
				-
					<?php print "<input type=\"text\" name=\"postcode2\" onKeyDown=\"return onlyNum()\" size=\"4\" maxlength=\"4\" id=\"postcode2\" class=\"text2\" onFocus=\"focusColor(this)\" onBlur=\"blurColor(this)\" value=\"".$row["postal_code2"]."\">"; ?>
				</td>
				</tr>
				
				<tr>
					<th scope="row" class="must"><label for="address_p">都道府県<em>（必須）</em></label>
					<div id="output_10"></div>
					</th>
				<td>
					<select name="address_p" id="address_p">
						<optgroup label="北海道・東北地方">
							<option value="北海道">北海道</option>
							<option value="青森県">青森県</option>
							<option value="岩手県">岩手県</option>
							<option value="宮城県">宮城県</option>
							<option value="秋田県">秋田県</option>
							<option value="山形県">山形県</option>
							<option value="福島県">福島県</option>
						</optgroup>
						<optgroup label="関東地方">
							<option value="茨城県">茨城県</option>
							<option value="栃木県">栃木県</option>
							<option value="群馬県">群馬県</option>
							<option value="埼玉県">埼玉県</option>
							<option value="千葉県">千葉県</option>
							<option value="東京都">東京都</option>
							<option value="神奈川県">神奈川県</option>
						</optgroup>
						<optgroup label="中部地方">
							<option value="新潟県">新潟県</option>
							<option value="富山県">富山県</option>
							<option value="石川県">石川県</option>
							<option value="福井県">福井県</option>
							<option value="山梨県">山梨県</option>
							<option value="長野県">長野県</option>
							<option value="岐阜県">岐阜県</option>
							<option value="静岡県">静岡県</option>
							<option value="愛知県">愛知県</option>
						</optgroup>
						<optgroup label="近畿地方">
							<option value="三重県">三重県</option>
							<option value="滋賀県">滋賀県</option>
							<option value="京都府">京都府</option>
							<option value="大阪府">大阪府</option>
							<option value="兵庫県">兵庫県</option>
							<option value="奈良県">奈良県</option>
							<option value="和歌山県">和歌山県</option>
						</optgroup>
						<optgroup label="中国地方">
							<option value="鳥取県">鳥取県</option>
							<option value="島根県">島根県</option>
							<option value="岡山県">岡山県</option>
							<option value="広島県">広島県</option>
							<option value="山口県">山口県</option>
						</optgroup>
						<optgroup label="四国地方">
							<option value="徳島県">徳島県</option>
							<option value="香川県">香川県</option>
							<option value="愛媛県">愛媛県</option>
							<option value="高知県">高知県</option>
						</optgroup>
						<optgroup label="九州地方">
							<option value="福岡県">福岡県</option>
							<option value="佐賀県">佐賀県</option>
							<option value="長崎県">長崎県</option>
							<option value="熊本県">熊本県</option>
							<option value="大分県">大分県</option>
							<option value="宮崎県">宮崎県</option>
							<option value="鹿児島県">鹿児島県</option>
							<option value="沖縄県">沖縄県</option>
						</optgroup>
						<option value="日本国外">日本国外</option>
					</select>
				</td>
				</tr>
				
				<tr>
				<th scope="row" class="must"><label for="address_c">市区町村<em>（必須）</em></label>
				<div id="output_11"></div>
				</th>
				<td>
					<?php print "<input type=\"text\" name=\"address_c\" size=\"30\" id=\"address_c\" class=\"text3\" onFocus=\"focusColor(this)\" onBlur=\"blurColor(this)\" value=\"".$row["address_c"]."\">"; ?>
				</td>
				</tr>
				
				<tr>
				<th scope="row"><label for="adress_l">町域・番地</label>
				</th>
				<td>
					<?php print "<input type=\"text\" name=\"address_l\" size=\"30\" id=\"address_l\" class=\"text3\" onFocus=\"focusColor(this)\" onBlur=\"blurColor(this)\" value=\"".$row["address_l"]."\">"; ?>
				</td>
				</tr>				
				</table>
				
				<p class="regist-title">確認パスワード</p>
				<table border="border" cellspacing="0">
				<tr>
				<th scope="row" class="must"><label for="pwd">パスワード</label></th>
				<td>
					<input type="password" name="pwd" size="12" id="pwd" class="text5" onchange="pwdInput(this.value)" onFocus="focusColor(this)" onBlur="blurColor(this)"/>
				</td>
				</tr>
				</table>
				<div id="output_13"></div>
				<div class="submit"><input type="submit" value="更新"></div>
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