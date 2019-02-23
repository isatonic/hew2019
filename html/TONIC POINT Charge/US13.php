<html>
	<head>
	<title>TONIC POINTチャージ確認画面</title>
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
	<link rel="stylesheet" href="css/style_TONICP.css">
	</head>	
	<body>
    
    <div class="cd-main-content">
       <header class="cd-main-header animate-search">
		<nav class="cd-main-nav-wrapper">
        　　 <img src="img/LOGO/LOGO W.png" class="logo" alt="" onClick="location.href='../index/index.html'">
			<a href="" class="cd-search-trigger cd-text-replace">Search</a>
			
			<ul class="cd-main-nav">
				<li><a href="" data-type="page-transition">ログイン&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|</a></li>
				<li><a href="">一覧&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|</a></li>
				<li><a href="../SNS/SN1.php">SNS&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|</a></li>
				<li><a href="">カート</a></li>
			</ul> 
		</nav>

		<a href="" class="cd-nav-trigger cd-text-replace">Menu<span></span></a>
	</header>
	
    

	<div id="search" class="cd-main-search">
		<form action="" method="post">
			<input type="search" placeholder="入力してください">

		</form>

		<div class="cd-search-suggestions">
			<div class="news">
				<h3>News</h3>
				<ul>
					<li>
						<a class="image-wrapper" href=""><img src="img/placeholder.png" alt=""></a>
						<h4><a class="cd-nowrap" href="">1</a></h4>
					</li>

					<li>
						<a class="image-wrapper" href=""><img src="img/placeholder.png" alt=""></a>
						<h4><a class="cd-nowrap" href="">2</a></h4>
					</li>

					<li>
						<a class="image-wrapper" href=""><img src="img/placeholder.png" alt=""></a>
						<h4><a class="cd-nowrap" href="">3</a></h4>
					</li>
   					<li>
						<a class="image-wrapper" href=""><img src="img/placeholder.png" alt=""></a>
						<h4><a class="cd-nowrap" href="">4</a></h4>
					</li>
                    <li>
						<a class="image-wrapper" href=""><img src="img/placeholder.png" alt=""></a>
						<h4><a class="cd-nowrap" href="">5</a></h4>
					</li>

				</ul>
			</div> 
		</div>

		<a href="#0" class="close cd-text-replace">Close Form</a>
	</div>  
        </div>
        <script src="js/jquery-2.1.4.js"></script>
        <script src="js/main.js"></script>
		<script src="js/TONICP.js"></script>
		<div class="font">
			<h2 class="Header">　　TONIC POINTチャージ確認画面</h2>
			<img src="img/クレジットカードブランド.jpg" alt="クレジットカートブランド" class="creditB">
			<div class="TONICarea">
				<h3 class="Confirmation">&nbsp;&nbsp;&nbsp;入力内容をご確認ください。&nbsp;&nbsp;</h3>
        <form action="">
					<h3 class="chargeP2">チャージポイント数:</h3>
					<div class="TP2">
						<div class="tpshow">
							<?php
								echo $_POST['pointtp'];
							?>	
						</div>
					</div>
				
				<h3 class="credit">クレジットカード番号:</h3>
					<div class="CK">
						<div class="c1">****</div>
						<div class="c2">****</div>
						<div class="c3">****</div>
						<div class="c4">
							<?php
								echo $_POST['samplecredit'];
							?>
						</div>
					</div>
					
				<h3 class="rimit">期限:</h3>
					<div class="CK2">
						<div class="d1 mar">
							<?php
								echo $_POST['cre11'];
								echo '<h2>月</h2>';
							?>
						</div>
						<div class="d2">
							<?php
								echo $_POST['cre12'];
								echo '<h2>年</h2>';
							?>
						</div>
					</div>
				
				<h3 class="security">セキュリティコード:</h3>
					<div class="CK3">
						<div class="e1">
							<?php
								echo $_POST['cresequ'];
							?>
						</div>
					</div>
				<div class="nextpage_okok" onClick="location.href='US14.php?bk=1'" ><h3>&nbsp;&nbsp;決済する&nbsp;&nbsp;</h3></div><br>
				<div class="nextpage_no" onClick="back()"><h3>&nbsp;&nbsp;戻る&nbsp;&nbsp;</h3></div><br>
        </form>
			</div>

			
			<h3 class="jump_ok">決済するをクリック後、決済が完了します。</h3>

		</div>
	</body>
</html>

