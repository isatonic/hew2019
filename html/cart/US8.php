<?php
session_start();
if (!isset($_SESSION["id"])) {
    header("Location: ../login/login.php", true, 302);
}

if (!isset($_SESSION["isatonic_cart_list"])) {
    header("../controller/getCart.php", true, 302);
} else {
    $list = $_SESSION["isatonic_cart_list"];
}
unset($_SESSION["isatonic_cart_list"]);
?>
<html>
	<head>
      <?php
      // リロード(F5)した時に再度DBにアクセス
      if (is_null($list)) {
          echo <<<RD
      <script>
        window.location = "../controller/getCart.php";
      </script>
RD;
      }
      ?>
	<title>ショッピングカート | ISATONIC</title>
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
		<script src="js/Mypage.js"></script>
		<div class="font">
			<h2 class="Header">　　ショピングカート</h2>
				<div class="mype_main">
						<div class="cartbar">
							<p>　　　　　　　　 画像　　　　　　　　　　　　　　　　　　タイトル　　　　　　　　　　　　　　　　　価格　　　　　　　　　　　　　　　　 　削除ボタン　　　　</p>
						</div>
					<form action="../controller/detailCart.php" method="post" id="form301" name="form301">
						<div class="flex-container flexxxxxxxxx">

                <?php
                if ($list === false) {
                  echo <<<OUT
                    <div class="cart_flex flex-container">
                      <div class="msg">カートは空です。</div>
                    </div>
                    <div class="up_submit"><p>購入</p></div>
OUT;

                } else {
                    foreach ($list as $row) {
                        echo <<<OUT
                      <div class="cart_flex flex-container">
                          <div class="base_BOX_img flex-container flex_center">
                            <img src="../uploaded_files/{$row['fileName']}" alt="">
                          </div>

                          <div class="base_BOX flex-container flex_center">
                            <p class="nameeee">{$row["title"]}</p>
                          </div>

                          <div class="base_BOX2 flex-container flex_center">
                            <p class="tonic_PPP">{$row["price"]}TP</p>
                          </div>

                          <div class="base_BOX3 flex-container flex_center">
                            <input type="submit" form="delete_form" class="delete_B" value="削除">
                          </div>
                          <input type="hidden" name=item_checkes[] value="{$row["product"]}">
                          <input type="hidden" name=item_delete form="delete_form" value="{$row["product"]}">
                      </div>
OUT;

                    }
                    echo <<<BUTTON
                        <div class="up_submit" onclick="submit_itemsGO()"><p>購入</p></div>
BUTTON;


                }
                ?>

						
<!--						<div class="up_submit" onClick="submit_itemsGO()">-->
<!--								<p>購入</p>-->
<!--						</div>-->
						
							</form>	
						
						
						
						
						
						
						
						
						
						
						
						<form action="../controller/removeCart.php" id="delete_form" method="POST"></form>
					
					
					
					
				</div>
<!-- フローティング操作ボタン -->
			<a id="fab" href="US8.php">
				<i class="fas fa-home"></i>
			</a>
			
			
			

		</div>
	</body>
</html>

