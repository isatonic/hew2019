<html>
	<head>
	<title>購入 | ISATONIC</title>
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
	<link rel="stylesheet" href="css/style_MyPage.css">
	<link rel="stylesheet" href="css/help_ozawa.css">
	<link rel="stylesheet" href="css/cart.css">
	<link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
	<script src="js/Mypage.js"></script>
	<script src="js/ozawa.js"></script>
	<script src="js/cart.js"></script>
	</head>	
	<body>
    
    <div class="cd-main-content">
       <header class="cd-main-header animate-search">
		<nav class="cd-main-nav-wrapper">
        　　 <img src="img/LOGO/LOGO W.png" class="logo" alt="" onClick="location.href='../index/index.html'">
			<a href="javascript:searchForm.submit()" class="cd-search-trigger cd-text-replace">Search</a>
			
			<ul class="cd-main-nav">
				<li><a href="../login/login.php">ログイン</a></li>
				<li><h4 style="color: #FFF;position: relative;top: -5%;">&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;</h4></li>
				<li><a href="../SNS/SN1.html">SNS</a></li>
				<li><h4 style="color: #FFF;position: relative;top: -5%;">&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;</h4></li>
				<li><a href="../cart/US8.php">カート</a></li>
			</ul> 
		</nav>

		<a href="" class="cd-nav-trigger cd-text-replace">Menu<span></span></a>
	</header>
	
    

	<div id="search" class="cd-main-search">
    <form name="searchForm" action="" method="post">
      <input type="search" placeholder="入力してください">
	</form>

		<a href="#0" class="close cd-text-replace">Close Form</a>
	</div>  
        </div>
        <script src="js/jquery-2.1.4.js"></script>
        <script src="js/main.js"></script>
		<script src="js/Mypage.js"></script>
		<div class="font">
			<h2 class="Header">　　購入画面</h2>
				<div class="mype_main">

					<div class="flex-container flexxxxxxxxx">
							<!----------------------------------- 画像 ------------------------------------------->
							<div class="flex-container2 margin_1">
							<img src="img/1st.png" alt="">
							<img src="img/1st.png" alt="">
							</div>
							<!----------------------------------- 画像 ------------------------------------------->

					</div>
					
					<div class="exshow">
						<div class="point_have">
							<div class="point_have_2">
								<p>　所持ポイント　</p>
							</div>
							<div class="point_have_3">
							<p>
								<?php
								echo "50000TP";
								?>
							</p>
							</div>
						</div>
						<div class="goukei">
							<div class="goukei_2">
								<p>　　　合計　　　</p>
							</div>
							<div class="goukei_3">
							<p>
								<?php
								echo "1300TP";
								?>
							</p>
							</div>
						</div>
						
						<p class="under_bar">　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　</p>
						
						<div class="zandaka">
							<div class="zandaka_2">
								<p>　　　残高　　　</p>
							</div>
							<div class="zandaka_3">
							<p>
								<?php
								echo "48700TP";
								?>
							</p>
							</div>
						</div>
					</div>
						
						
						
						
						
						
						
						
						<form action="US11.php" method="POST" id="form401" name="form401">
							<?php
								$item_c = $_POST['item_checkes']; 
								print_r($item_c) ; //配列の中のデータを表示したいなあああああああああああああああ
							?>
							<input type="hidden" name="item_checkes2[]" value="<?php print_r($item_c) ; ?>">
						</form>
							<div class="up_submit_2" onClick="buybuy_items()">
								<p>購入する</p>
							</div>
							<div class="tonic_point_c_2" onClick="location.href='../TONIC POINT Charge/US12.html'">
								<p>TONIC POINT チャージ</p>
							</div>
					
					
					
					
				</div>
<!-- フローティング操作ボタン -->
			<a id="fab" href="US8.php">
				<i class="fas fa-home"></i>
			</a>
			
			
			

		</div>
	</body>
</html>

