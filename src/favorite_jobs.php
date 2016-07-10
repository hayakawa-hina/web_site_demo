<?php
	session_start();
	$conn = pg_connect("host=localhost dbname=j121613y user=j121613y");
	$login_mid = $_SESSION["id"];
	
	$query4 = "select j.id, j.address_p, j.address_c, j.category, j.company from history h, jobs j where h.m_id=$1 and j.id=h.j_id";
	$result_h = pg_prepare($conn, "query4", $query4);
	$result_h = pg_execute($conn, "query4", array($login_mid));
	$num_h = pg_num_rows($result_h);
	$new_flag= array(0, 0, 0, 0);
	//print($num_h);
	for($i = 0; $i < $num_h; $i++){
		$row_h = pg_fetch_assoc($result_h, $i);
		$query = "select * from tagged, tag where tagged.t_id=tag.id and tagged.j_id=".$row_h["id"];
		$result_t = pg_query($conn, $query);
		$num_t = pg_num_rows($result_t);
		
			if($i == 0){	
				$array_ad[] = array('address_p'=>$row_h["address_p"],  'address_c'=>$row_h["address_c"], 'count'=>1);
				$array_ca[] = array('category'=>$row_h["category"],  'count'=>1);
				$array_co[] = array('company'=>$row_h["company"],  'count'=>1);
				for($j = 0; $j < $num_t; $j++){
					$row_t = pg_fetch_assoc($result_t, $j);
					$array_tg[] = array('tag'=>$row_t["id"],  'count'=>1);
				}
			}else{
				$c = 0;
				foreach($array_ad as $data){
					if($data['address_p'] === $row_h["address_p"] && $data['address_c'] === $row_h["address_c"]){
						$array_ad[$c]['count']++;
						$new_flag[0] = 1;
					}
					$c++;
				}
				$c = 0;
				foreach($array_ca as $data){
					if($data['category'] === $row_h["category"] ){
						$array_ca[$c]['count']++;
						$new_flag[1] = 1;
					}
					$c++;
				}
				$c = 0;
				foreach($array_co as $data){
					if($data['company'] === $row_h["company"] ){
						$array_co[$c]['count']++;
						$new_flag[2] = 1;
					}
					$c++;
				}
				if($new_flag[0] == 0){
					$array_ad[] = array('address_p'=>$row_h["address_p"],  'address_c'=>$row_h["address_c"], 'count'=>1);
				}else{
					$new_flag[0] = 0;
				}
				if($new_flag[1] == 0){
					$array_ca[] = array('category'=>$row_h["category"],  'count'=>1);
				}else{
					$new_flag[1] = 0;
				}
				if($new_flag[2] == 0){
					$array_co[] = array('company'=>$row_h["company"],  'count'=>1);
				}else{
					$new_flag[2] = 0;
				}
				for($k = 0; $k < $num_t; $k++){
					$row_t = pg_fetch_assoc($result_t, $k);
					$c = 0;
					foreach($array_tg as $data){
						if($data['tag'] === $row_t["id"] ){
						$array_tg[$c]['count']++;
						$new_flag[3] = 1;
						}
						$c++;
					}
					if($new_flag[3] == 0){
						$array_tg[] = array('tag'=>$row_t["id"],  'count'=>1);
					}else{
						$new_flag[3] = 0;
					}
				}
			}
		}
		
		$query = "select * from jobs";
		$result = pg_query($conn, $query);
		$num = pg_num_rows($result);
		for($i = 0; $i < $num; $i++){
			$row = pg_fetch_assoc($result, $i);
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
							'point'=>0
							);
		}
		if($num_h > 0){
		/*
		print_r($array_ad);
		print '<br><br>';
		print_r($array_ca);
		print '<br><br>';
		print_r($array_co);
		print '<br><br>';
		print_r($array_tg);
		*/
			//address
			print '<br>';
			for($i = 0; $i < count($array); $i++){
					$c = 0;
					foreach($array_ad as $data){
						if(($data['address_p'] === $array[$i]["address_p"])&&($data['address_c'] === $array[$i]["address_c"])){
							$array[$i]['point'] += $data['count'];
						}
					}
			}
			//print_r($array);
			//category
			for($i = 0; $i < count($array); $i++){
					$c = 0;
					foreach($array_ca as $data){
						if($data['category'] === $array[$i]["category"] ){
							$array[$i]['point'] += $data['count'];
						}
					}
			}
			//print '<br><br>';
			//print_r($array);
			//company
			for($i = 0; $i < count($array); $i++){
					foreach($array_co as $data){
						if($data['company'] === $array[$i]["company"] ){
							$array[$i]['point'] += $data['count'];
						}
					}
			}
			//print '<br><br>';
			//print_r($array);
			//tag
			
			for($i = 0; $i < count($array); $i++){
				$query = "select * from tagged t where t.j_id=".$array[$i]["id"];
				$result_t2 = pg_query($conn, $query);
				$num_t2 = pg_num_rows($result_t2);
				for($j = 0; $j < $num_t2; $j++){
					$row_t2 = pg_fetch_assoc($result_t2, $j);
						foreach($array_tg as $data){
							if($data['tag'] === $row_t2["t_id"] ){
								$array[$i]['point'] += $data['count'];
							}
						}
					}
			}
			
			//print '<br><br>';
			//print_r($array);
			//point 0を消す
			$empty_flag = 0;
			$num = count($array);
			for($i = 0; $i < $num; $i++){
				if($array[$i]['point'] == 0)
					unset($array[$i]);
			}
			$array = array_merge($array);
			if(empty($array))
				$empty_flag = 1;
			
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
			
			$sort_flag = 0;
			$sort_type = 'point';
			if($empty_flag != 1){
				foreach($array as $key => $val){
				$new_array[$key] = $val[$sort_type];
				}
				if($sort_flag == 0)
					array_multisort($new_array, SORT_DESC, $array);
				else
					array_multisort($new_array, SORT_ASC, $array);
			}
			/*
			print '<br><br>';
			print_r($array);
			*/
		}
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
		<?php print "<p class=\"form-title\">".$_SESSION["login_name"]."さんへのおすすめのアルバイト</p>"; ?>
			<br>
			<div id="work" align="center">
			<table>
			<?php
			if(count($array) == 0 || $num_h == 0){
				print "<p class=\"regist-title\">おすすめアルバイトはありません（アルバイトを検索してください）</p>";
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

				for($i = 0; $i < count($array); $i++){					
					print '<tr data-href=./work_detail.php?id='.$array[$i]["id"].'>';
						print '<td>'.$array[$i]["jobs_name"].'</td>';
						print '<td>'.$array[$i]["payment"].'円</td>';
						print '<td>'.$array[$i]["company"].'</td>';
						//print '<td>'.$array[$i]["limit_old_up"].'歳～'.$array[$i]["limit_old_down"].'歳</td>';
						print '<td>'.$array[$i]["category"].'</td>';
						print '<td>'.$array[$i]["address_p"].' '.$array[$i]["address_c"].'</td>';
						print '<td>'.$array[$i]["sign"].'</td>';
						print '<td>'.$array[$i]["limit"].'</td>';
					print '</tr>';
					if($i == 20)
						break;					
				}
			}
			?>
			</table>
		<br>		
		</div>
		<hr>
	<div id="footer">
		<p>Copyright (c) 2015 keio</p>
	</div>
</div>
</body>
</html>