<?php
	session_start();
	$conn = pg_connect("host=localhost dbname=j121613y user=j121613y");
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
		function onlyNum(){
			var m = String.fromCharCode(event.keyCode);
			if("0123456789\b\r".indexOf(m, 0) < 0)
				return false;
			return true;
		}
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
			<form action="./workpage.php" method="POST" id="inquiry2" name="form2">
			<table border="border" cellspacing="0">
				<tr>
					<th scope="row"><label for="word">検索ワード</label></th>
				<td>
					<input type="text" name="word" size="15" id="word" class="text5" onFocus="focusColor(this)" onBlur="blurColor(this)">
				</td>
				</tr>
				
				<tr>
					<th scope="row"><label for="category">職種</label></th>
				<td>
				<select name="category" id="category">
						<option value="" selected="selected">全カテゴリ</option>
						<option disabled="disabled">――――――――</option>
						<option value="教育">教育</option>
						<option value="エンジニア">エンジニア</option>
						<option value="清掃・警備">清掃・警備</option>
						<option value="飲食">飲食</option>
						<option value="販売・接客">販売・接客</option>
						<option value="医療・介護">医療・介護</option>
						<option value="配送・ドライバー">配送・ドライバー</option>
					</select>
				</td>
				</tr>
				
				<tr>
					<th scope="row"><label for="payment">時給指定</label></th>
				<td>
					<input type="text" name="payment_up" onKeyDown="return onlyNum()" size="6" id="payment" class="text2" onFocus="focusColor(this)" onBlur="blurColor(this)">
					円&nbsp;～&nbsp;
					<input type="text" name="payment_down" onKeyDown="return onlyNum()" size="6" id="payment" class="text2" onFocus="focusColor(this)" onBlur="blurColor(this)">
					円
				</tr>
				
				<tr>
					<th scope="row"><label for="address_p">場所</label></th>
				<td>
					<select name="address_p" id="address_p">
						<option value="" selected="selected">全エリア</option>
						<option disabled="disabled">――――――――</option>
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
					<th scope="row"><label for="tag">条件</label></th>
				<td>
				
				<?php
				
				$query = "select * from tag";
				$result_tag = pg_query($conn, $query);
				$num = pg_num_rows($result_tag);
				$num_left = ($num) / 2;
				$i = 0;
				print "<div style=\"float:left \">";
				$row = pg_fetch_assoc($result_tag, $i);
				print "<label><input id=\"tag\" type=\"checkbox\" name=\"".$row["tag_name"]."\" value=\"".$row["tag_name"]."\"/>".$row["tag_name"]."</label>";
				for($i = 1; $i < $num_left; $i++){
					$row = pg_fetch_assoc($result_tag, $i);
					print "<br>";
					print "<label><input id=\"tag\" type=\"checkbox\" name=\"".$row["tag_name"]."\" value=\"".$row["tag_name"]."\"/>".$row["tag_name"]."</label>";
				}
				print "</div>";
				print "<div style=\"float:right \">";
				$row = pg_fetch_assoc($result_tag, $i);
				print "<label><input id=\"tag\" type=\"checkbox\" name=\"".$row["tag_name"]."\" value=\"".$row["tag_name"]."\"/>".$row["tag_name"]."</label>";
				for($i++; $i < $num; $i++){
					$row = pg_fetch_assoc($result_tag, $i);
					print "<br>";
					print "<label><input id=\"tag\" type=\"checkbox\" name=\"".$row["tag_name"]."\" value=\"".$row["tag_name"]."\"/>".$row["tag_name"]."</label>";
				}
				print "</div>";
				?>
				
				</td>
				</tr>
				
				<tr>
					<th scope="row"><label for="sort">並び替え</label></th>
				<td>
					<select name="sort" id="sort">
						<option value="新着順" selected="selected">新着順</option>
						<option value="人気順">人気順</option>
						<option value="時給順">時給順</option>
						<option value="締切順">締切順</option>
					</select>
					&nbsp;
					&nbsp;
					<label><input id="sort" type="checkbox" name="all_list" value="all"/>&nbsp;全アルバイト表示</label>
				</td>
				</tr>
			</table>
			<p class="submit"><input type="submit" name="検索" value="検索" /></p>
			</form>
			<br><br><br>
			
			<div id="work" align="center">
			<table>
			<?php
			if(!isset($_POST["検索"])){
				;
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
				
				$sort = $_POST["sort"];
				if($sort == "新着順"){
					$sort_type = "sign";
					$sort_flag = 0;
				}else if($sort == "人気順"){
					$sort_type = "favorite";
					$sort_flag = 0;
				}else if($sort == "時給順"){
					$sort_type = "payment";
					$sort_flag = 0;
				}else if($sort == "締切順"){
					$sort_type = "limit";
					$sort_flag = 1;
				}
				
				//多次元連想配列に格納
				$query = "select * from jobs";
				$result = pg_query($conn, $query);
				$num = pg_num_rows($result);
				for($i = 0; $i < $num; $i++){
					$row = pg_fetch_assoc($result, $i);
					
					$query = "select * from history where j_id=".$row["id"];
					$result_f = pg_query($conn, $query);
					$num_f = pg_num_rows($result_f);
					
					$array[] = array('id'=>$row["id"],
									'jobs_name'=>$row["jobs_name"],
									'payment'=>$row["payment"],
									'company'=>$row["company"],
									'address_p'=>$row["address_p"],
									'address_c'=>$row["address_c"],
									'category'=>$row["category"],
									'limit_old_up'=>$row["limit_old_up"],
									'limit_old_down'=>$row["limit_old_down"],
									'sign'=>$row["sign_year"].'-'.$row["sign_month"].'-'.$row["sign_day"],
									'limit'=>$row["limit_year"].'-'.$row["limit_month"].'-'.$row["limit_day"],
									'favorite'=>$num_f
									);
				}
				
				$empty_flag = 0;//配列の空判定用
				if(isset($_POST["all_list"])){
					;
				}else{
				
					//検索ワード(OR検索)
					if($_POST["word"] != ""){
						$word = preg_split("/[\s,]+/", $_POST["word"]);						
						$num = count($array);
						for($j = 0; $j < $num; $j++){
							$flag = 0;
							for($i = 0; $i < count($word); $i++){
								if(strstr($array[$j]["jobs_name"], $word[$i]))
									$flag = 1;
								if(strstr($array[$j]["company"], $word[$i]))
									$flag = 1;
							}
							if($flag != 1)
								unset($array[$j]);
						}
						$array = array_merge($array);
						if(empty($array))
							$empty_flag = 1;
					}
					
					//カテゴリ
					if($_POST["category"] != ""){
						$num = count($array);
						for($i = 0; $i < $num; $i++){
							if($_POST["category"] == $array[$i]["category"]){
								;
							}else{
								unset($array[$i]);
							}
						}
						$array = array_merge($array);
						if(empty($array))
							$empty_flag = 1;
					}
					
					//時給指定
					if($_POST["payment_up"] == "" && $_POST["payment_down"] == ""){
						;
					}else{
						$payment_up = ($_POST["payment_up"] != "") ? $_POST["payment_up"] : 0;
						$payment_down = ($_POST["payment_down"] != "") ? $_POST["payment_down"] : 99999;
						$num = count($array);
						for($i = 0; $i < $num; $i++){
							if($payment_up <= $array[$i]["payment"] && $payment_down >= $array[$i]["payment"]){
								;
							}else{
								unset($array[$i]);
							}
						}
						$array = array_merge($array);
						if(empty($array))
							$empty_flag = 1;
					}
					
					//エリア
					if($_POST["address_p"] != ""){
						$num = count($array);
						for($i = 0; $i < $num; $i++){
							if($_POST["address_p"] == $array[$i]["address_p"]){
								;
							}else{
								unset($array[$i]);
							}
						}
						$array = array_merge($array);
						if(empty($array))
							$empty_flag = 1;
					}
					
					//条件
					$flag_tag = 0;
					$num = pg_num_rows($result_tag);
					$query = "select tg.j_id from tag t, tagged tg where tg.t_id=t.id and (";
					for($i = 0; $i < $num; $i++){
						$row = pg_fetch_assoc($result_tag, $i);
						if(isset($_POST[$row["tag_name"]])){
							if($flag_tag++ != 0)
								$query .= " or ";
							$query .= "t.id=".$row["id"];
						}
					}
					$query .= ")";
					if($flag_tag != 0){
						$result_tag = pg_query($conn, $query);
						$num = count($array);
						$num_tag = pg_num_rows($result_tag);
						for($j = 0; $j < $num; $j++){
							$flag = 0;
							for($i = 0; $i < $num_tag; $i++){
								$row = pg_fetch_assoc($result_tag, $i);
								if($array[$j]["id"] == $row["j_id"])
									$flag = 1;						
							}
							if($flag != 1)
								unset($array[$j]);
						}
						$array = array_merge($array);
						if(empty($array))
							$empty_flag = 1;
					}
					
					//応募開始前、締切日過ぎの募集を表示させない
					$today = date('Y-m-d');
					$num = count($array);
					for($j = 0; $j < $num; $j++){
						if(strtotime($today) >= strtotime($array[$j]["sign"]) && strtotime($today) <= strtotime($array[$j]["limit"])){
							;
						}else
							unset($array[$j]);
					}
					$array = array_merge($array);
						if(empty($array))
							$empty_flag = 1;
				}
				
				if($empty_flag != 1){
				//sort
					foreach($array as $key => $val){
						$new_array[$key] = $val[$sort_type];
					}
					if($sort_flag == 0)
						array_multisort($new_array, SORT_DESC, $array);
					else
						array_multisort($new_array, SORT_ASC, $array);
				
				//表示
					for($i = 0; $i < count($new_array); $i++){
						if(!isset($_SESSION["login_name"])){			
							print "<tr>";
						}else{
							print '<tr data-href=./work_detail.php?id='.$array[$i]["id"].'>';
						}
							print '<td>'.$array[$i]["jobs_name"].'</td>';
							print '<td>'.$array[$i]["payment"].'円</td>';
							print '<td>'.$array[$i]["company"].'</td>';
							//print '<td>'.$array[$i]["limit_old_up"].'歳～'.$array[$i]["limit_old_down"].'歳</td>';
							print '<td>'.$array[$i]["category"].'</td>';
							print '<td>'.$array[$i]["address_p"].' '.$array[$i]["address_c"].'</td>';
							print '<td>'.$array[$i]["sign"].'</td>';
							print '<td>'.$array[$i]["limit"].'</td>';
						print '</tr>';					
					}
				}
			}
			?>
			</table>
			</div>
		</div>
		<hr>
	<div id="footer">
		<p>Copyright (c) 2015 keio</p>
	</div>
</div>
</body>
</html>
