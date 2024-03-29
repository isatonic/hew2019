<?php
session_start();
if (isset($_SESSION["username"])) {
  $username = $_SESSION["username"];
} else {
  $username = "ログイン";
}
if (!isset($_SESSION["id"])) {
  header("Location: ../login/login.php");
}
?>
<!DOCTYPE html>
<html>
	<head>
	<title>TONIC POINTチャージ | ISATONIC</title>
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
        　　 <img src="img/LOGO/LOGO W.png" class="logo" alt="" onClick="location.href='../index/index.php'">
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
      <input type="search" name="word" placeholder="入力してください">

		</form>

		<a href="#0" class="close cd-text-replace">Close Form</a>
	</div>  
        </div>
        <script src="js/jquery-2.1.4.js"></script>
        <script src="js/main.js"></script>
		<script src="js/TONICP.js"></script>
		<div class="font">
			<h2 class="Header">　　TONIC POINTチャージ</h2>
			<img src="img/クレジットカードブランド.jpg" alt="クレジットカートブランド" class="creditB">
			<form action="US13.php" method="POST" id="form01" name="form1" onSubmit="return check()">
			<div class="TONICarea">
					<h3 class="chargeP">チャージポイント数:</h3>
					<div class="TP">
						<div class="tp100" id="100" onclick="get1()">100</div>
						<div class="tp500" id="500" onclick="get2()">500</div>
						<div class="tp1000" id="1000" onclick="get3()">1000</div>
						<div class="tp2000" id="2000" onclick="get4()">2000</div>
						<div class="tp5000" id="5000" onclick="get5()">5000</div>
					</div>
					
					<div class="POINThand">
						チャージ数1POINT単位での変更:
						<input type="text" class="pointform" name="pointtp" id="count" value="" maxlength="10" required>
					</div>
				
				<h3 class="credit">クレジットカード番号:</h3>
					<div class="CK">
						<input type="text" class="c1 mar" name="cre1" maxlength="4" required>
						<input type="text" class="c2 mar" name="cre2" maxlength="4" required>
						<input type="text" class="c3 mar" name="cre3" maxlength="4" required>
						<input type="text" class="c4" name="samplecredit" maxlength="4" required>
					</div>
					
				<h3 class="rimit">期限:</h3>
					<div class="CK2">
						<input type="text" class="d1 mar" name="cre11" maxlength="2" placeholder="MONTH" required>
						<input type="text" class="d2" name="cre12" maxlength="2" placeholder="YEAR" required>
					</div>
				
				<h3 class="security">セキュリティコード:</h3>
					<div class="CK3">
						<input type="text" class="e1" name="cresequ" maxlength="3" required>
					</div>
				<div class="nextpage_ok" onClick="check()"><h3>&nbsp;&nbsp;次へ&nbsp;&nbsp;</h3></div><br>
			</div>
			
			<h3 class="jump_ok">次へをクリック後、TONIC POINTチャージ確認画面に遷移します。</h3>
			</form>
		</div>
	</body>
</html>

