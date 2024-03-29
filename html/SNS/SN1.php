<?php
session_start();
if (isset($_SESSION["username"])) {
  $username = $_SESSION["username"];
} else {
  $username = "ログイン";
}
require_once "../../vendor/autoload.php";
if (!isset($_SESSION["id"])) {
    header("Location: ../login/login.php", true, 302);
}
//if (!isset($_SESSION["id"])) {
//  // ログインページのurl
//    $url = "";
////    header("Location: $url");
//
//    // debug
//    $user_id = "U123456";
//} else {
//    $user_id = $_SESSION["id"];
//}
//$pdo = new model\myPDO();
//$check = new model\physical\MessageCheck($pdo->getPDO());
//
//// 未読数
////$notice = $check->check($user_id);
?>
<!DOCTYPE html>
<html>
	<head>
	<title>SNSトップページ | ISATONIC</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
	<meta name="viewport" content="width=device-width,initial-scale=1">
 
	<link rel="stylesheet" href="css/style-j.css">    
	<script src="js/modernizr.js"></script> 
	<link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
	<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
    <script src="js/gooey.min.js"></script>
	<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<link rel="stylesheet" href="css/style_SNS.css">
	<link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
	</head>
	<body>
    
    <div class="cd-main-content">
       <header class="cd-main-header animate-search">
		<nav class="cd-main-nav-wrapper">
			<a href="../index/index.php"><img src="img/LOGO/LOGO W.png" class="logo" alt=""></a>
			<a href="javascript:searchForm.submit()" class="cd-search-trigger cd-text-replace">Search</a>
			
			<ul class="cd-main-nav">
				<li><a href="../login/login.php"><?php echo $username;?></a></li>
				<li><h4 style="color: #FFF;position: relative;top: -5%;">&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;</h4></li>
				<li><a href="../SNS/SN1.php">SNS</a></li>
				<li><h4 style="color: #FFF;position: relative;top: -5%;">&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;</h4></li>
				<li><a href="../cart/US8.php">カート</a></li>
			</ul>
		</nav>

		<a href="" class="cd-nav-trigger cd-text-replace">Menu<span></span></a>
	</header>
	
    

	<div id="search" class="cd-main-search">
    <form name="searchForm" action="../controller/search.php" method="post">
      <input type="search" placeholder="入力してください">

		</form>

		<a href="#0" class="close cd-text-replace">Close Form</a>
	</div>  
        </div>
        <script src="js/jquery-2.1.4.js"></script>
        <script src="js/main.js"></script>
		<div class="font">
        <h2 class="Header">　　SNSトップページ</h2>
		
		<script src="js/popup.js"></script>
		<div class="box_wrap">
			
			<div class="boxmini">
				<div id="openModal">
				<h2>&nbsp;&nbsp;メッセージへ&nbsp;&nbsp;</h2>
				</div>
			</div>
<!-- モーダルエリアここから -->
		<section id="modalArea" class="modalArea">
			<div id="modalBg" class="modalBg"></div>
			<div class="modalWrapper">
				<h2 class="Header2">　　Messeage List</h2><br>
				<div id="closeModal" class="closeModal">
						×
					</div>
				<div class="modalWrapper2">
						<!-- 内容記述 -->
						<div class="inbox">
							<img src="img/SNSアイコン.png" alt="アイコン" class="sns_top_image"><!-- トプ画のこと -->
							<h3  class="sns_name">NAME HOGEGOHE</h3><!-- ユーザ名 -->
							<a href="../SNS/SN3.php"><div class="go_messeage"><h3>&nbsp;&nbsp;メッセージ画面へ&nbsp;&nbsp;</h3></div></a><br><!-- メッセージへのボタン -->
						</div>
						<!-- 内容記述終わり -->
				</div>
			</div>
		</section>
		<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!-- モーダルエリアここまで -->

			
			<div class="box">
				<div class="messeage">
				</div>
			<h1 class="newmesseages">新着：　<?php echo "---" ?>　件　｜</h1>
			</div>
			
			<div id="openModal_Friend_List" class="circle">
			<i class="fas fa-book"></i>
			<h1>フレンド一覧</h1>
			</div>
<!-- モーダルエリアここから -->
			<section id="modalArea_Friend_List" class="modalArea">
				<div id="modalBg_Friend_List" class="modalBg"></div>
					<div class="modalWrapper">
						<h2 class="Header2">　　Friend List</h2>
						<div id="closeModal_Friend_List" class="closeModal">
							×
						</div>
						<div class="modalWrapper3">
							<!-- 内容記述 -->
							<div class="tab_wrap">
								<input id="tab1" type="radio" name="tab_btn" checked>
								<input id="tab2" type="radio" name="tab_btn">
								<div class="tab_area">
									<label class="tab1_label" for="tab1">フレンド一覧</label>
									<label class="tab2_label" for="tab2">フレンド申請承認待ち一覧</label>
								</div>
								<div class="panel_area">
									<div id="panel1" class="tab_panel">
										<div class="inbox5">
											<form name="param" action="#">
												<img src="img/SNSアイコン.png" alt="アイコン" class="sns_top_image5"><!-- トプ画のこと -->
													<input type="hidden" id="num" value="POSTTTT"><!-- Block画面でのユーザ名 -->
											</form>
											<h3 class="sns_name5">NAMEHGRGRG</h3>
											<!-- 表示されるユーザ名 -->
											<div class="create_messeage" onClick="location.href='./SN3.php'"><h3>&nbsp;&nbsp;メッセージ作成&nbsp;&nbsp;</h3></div><!-- メッセージへのボタン -->
											<div class="block openModal_block" onClick="func()"><h3>&nbsp;&nbsp;ブロック&nbsp;&nbsp;</h3></div><br><!-- ブロックのボタン -->
										</div>
									</div>								
									<div id="panel2" class="tab_panel tab_panel2">
										<div class="inbox6">
											<img src="img/SNSアイコン.png" alt="アイコン" class="sns_top_image6"><!-- トプ画のこと -->
											<h3  class="sns_name6">AWAWAWAWAD</h3><!-- ユーザ名 -->
											<div class="ok"><h3>&nbsp;&nbsp;承認する&nbsp;&nbsp;</h3></div><!-- 承認のボタン -->
											<div class="no"><h3>&nbsp;&nbsp;拒否する&nbsp;&nbsp;</h3></div><br><!-- 拒否のボタン -->
										</div>
									</div>
								</div>
							</div>
							<!-- 内容記述終わり -->
						</div>
					</div>
			</section>
			<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!-- モーダルエリアここまで -->
							<!-- Block -->		
								<!-- モーダルエリアここから -->
										<section id="modalArea_block" class="modalArea">
											<div id="modalBg_block" class="modalBg"></div>
												<div class="modalWrapper_block">
													<h2 class="Header2">　　Block</h2>
													<div id="closeModal_block" class="closeModal">
														×
													</div>
													<div class="modalWrapper6">
														<!-- 内容記述 -->
													<div class="inbox7">
														<img src="img/SNSアイコン.png" alt="アイコン" class="sns_top_image7"><!-- トプ画のこと -->
														<h3 class="sns_name7"><div id="answer"></div></h3><!-- ユーザ名 -->
														<br>
														<h3 class="Are_you_ok">このユーザをブロックしますか？</h3>
														<div class="block_ok" onClick="location.href='SN1.php'"><h3>&nbsp;&nbsp;はい&nbsp;&nbsp;</h3></div><br><!-- ブロックのボタン -->
														<div class="block_no"><h3>&nbsp;&nbsp;いいえ&nbsp;&nbsp;</h3></div><br><!-- ブロック撤回のボタン -->
													</div>
														<!-- 内容記述終わり -->
													</div>
												</div>
										</section>
										<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
							<!-- モーダルエリアここまで -->
			
				
			</div>
			<div class="box2" id="openModal_Friend_Select">
				<i class="far fa-envelope"></i>
				<h1>新規メッセージ作成</h1>
			</div>
<!-- モーダルエリアここから -->
			<section id="modalArea_Friend_Select" class="modalArea">
				<div id="modalBg_Friend_Select" class="modalBg"></div>
					<div class="modalWrapper size_change">
						<h2 class="Header2">　　新規メッセージ作成</h2>
						<div id="closeModal_Friend_Select" class="closeModal">
							×
						</div>
						<div class="modalWrapper4 flex-container">
							<!-- 内容記述 -->　　　 <!---------------------------デザイン後で変更します、とりあえずこれで。--------------------------------->
						<div class="inbox3">
							<img src="img/SNSアイコン.png" alt="アイコン" class="sns_top_image3"><!-- トプ画のこと -->
							<h3  class="sns_name3">NAME HOGEHGOE</h3><!-- ユーザ名 -->
							<div class="go_chat" onClick="location.href='./SN3.php'"><h3>&nbsp;&nbsp;　 　選択　 　&nbsp;&nbsp;</h3></div><br><!-- メッセージへのボタン -->
						</div>	
						
						<div class="inbox3">
							<img src="img/SNSアイコン.png" alt="アイコン" class="sns_top_image3"><!-- トプ画のこと -->
							<h3  class="sns_name3">NAME HOGEHGOE</h3><!-- ユーザ名 -->
							<div class="go_chat" onClick="location.href='./SN3.php'"><h3>&nbsp;&nbsp;　 　選択　 　&nbsp;&nbsp;</h3></div><br><!-- メッセージへのボタン -->
						</div>	
						
						<div class="inbox3">
							<img src="img/SNSアイコン.png" alt="アイコン" class="sns_top_image3"><!-- トプ画のこと -->
							<h3  class="sns_name3">NAME HOGEHGOE</h3><!-- ユーザ名 -->
							<div class="go_chat" onClick="location.href='./SN3.php'"><h3>&nbsp;&nbsp;　 　選択　 　&nbsp;&nbsp;</h3></div><br><!-- メッセージへのボタン -->
						</div>
							<!-- 内容記述終わり -->
						</div>
					</div>
			</section>
			<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!-- モーダルエリアここまで -->
			
			
			<div class="box3" id="openModal_Friend_Search">
				<i class="fas fa-user-friends"></i>
				<h1>フレンド検索</h1>
			</div>
<!-- モーダルエリアここから -->
			<section id="modalArea_Friend_Search" class="modalArea">
				<div id="modalBg_Friend_Search" class="modalBg"></div>
					<div class="modalWrapper">
						<h2 class="Header2">　　Friend Search</h2>
						<div id="closeModal_Friend_Search" class="closeModal">
							×
						</div>
						<div class="search_friend">
							<div class="search_content">
							  <form action="">				
								<input type="text" value="" placeholder="IDまたはユーザ名を入力してください">
								<button type="submit">Search</button>
							  </form>
							</div>
						</div>
						<h2 class="Header3">　　Search Results</h2>
						<div class="modalWrapper5">
							<!-- 内容記述 -->
						<div class="inbox4">
							<img src="img/SNSアイコン.png" alt="アイコン" class="sns_top_image4"><!-- トプ画のこと -->
							<h3  class="sns_name4">NAME FEOMF</h3><!-- ユーザ名 -->
							<div class="friend_request"><h4>&nbsp;&nbsp;フレンド申請&nbsp;&nbsp;</h4></div><!-- フレンド申請のボタン -->
							<div class="send_messeage" onClick="location.href='./SN3.php'"><h4>&nbsp;&nbsp;メッセージ送信&nbsp;&nbsp;</h4></div><br><!-- メッセージ送信のボタン -->
						</div>
							<!-- 内容記述終わり -->
						</div>
					</div>
			</section>
			<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!-- モーダルエリアここまで -->
			
			
		</div>
	</body>
</html>

