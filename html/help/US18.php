<html>
	<head>
	<title>お問い合わせ | ISATONIC</title>
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
	<link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
	<script src="js/Mypage.js"></script>
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
				<li><a href="../SNS/SN1.html">SNS&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|</a></li>
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
		<script src="js/Mypage.js"></script>
		<div class="font">
			<h2 class="Header">　　お問い合わせ内容確認</h2>
				<div class="mype_main">
					
					<form action="./US19.php" method="POST" id="form001">
						<div class="fooooorm1_2">
							<p class="nameee">
								氏名：&nbsp;
							</p>
							<p class="otoiawase">
								<?php
									echo $_POST['name_s'];
								?>
								&nbsp;&nbsp;&nbsp;&nbsp;
								<?php
									echo $_POST['name_m'];
								?>
								&nbsp;&nbsp;様
							</p>
						</div>
						<div class="fooooorm2_2">
							<p class="nameee">
								メールアドレス：&nbsp;
							</p>
							<p class="otoiawase">
								<?php
									echo $_POST['mail'];
								?>
							</p>
						</div>
						<div class="fooooorm4_3">
							<p class="nameee">
								カテゴリ：&nbsp;
							</p>
							<p class="otoiawase">
								<?php
									echo $_POST['category'];
								?>
							</p>
						</div>
						<div class="fooooorm5_4">
							<p class="nameee">
								タイトル：&nbsp;
							</p>
							<p class="otoiawase">
								<?php
									echo $_POST['title'];
								?>
							</p>
						</div>
						<div class="fooooorm6_5">
							<p class="nameee">
								本文：&nbsp;
							</p>
							<p class="otoiawase otoiawase_h">
								<?php
									$data_main = $_POST['main_text'];
									echo nl2br($data_main);
								?>
							</p>
						</div>
						<div class="fooooorm7_6"  onClick="submiiiit_s()">
							<p>送信</p>
						</div>
						<div class="fooooorm8" onClick="javascript:history.back();">
							<p>戻る</p>
						</div>
						
						<input type="hidden" name="name_s_K" value="<?php echo $_POST['name_s'] ?>">
						<input type="hidden" name="name_m_K" value="<?php echo $_POST['name_m'] ?>">
						<input type="hidden" name="mail_K" value="<?php echo $_POST['mail'] ?>">
						<input type="hidden" name="category_K" value="<?php echo $_POST['category'] ?>">
						<input type="hidden" name="title_K" value="<?php echo $_POST['title'] ?>">
						<input type="hidden" name="main_text_K" value="<?php echo $_POST['main_text'] ?>">
						
					</form>
					
				</div>
<!-- フローティング操作ボタン -->
			<a id="fab" href="US15.php">
				<i class="fas fa-home"></i>
			</a>
			
			
			

		</div>
	</body>
</html>

