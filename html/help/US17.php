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
			<h2 class="Header">　　お問い合わせ</h2>
				<div class="mype_main">
					
					<form action="./US18.php" method="POST" id="form001">
						<div class="fooooorm1">
							<p>
								氏名（姓）：&nbsp;<input type="text" name="name_s" required>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								氏名（名）：&nbsp;<input type="text" name="name_m" required>
							</p>
						</div>
						<div class="fooooorm2">
							<p>
								メールアドレス：&nbsp;<input type="text" name="mail" required>
								&nbsp;＠&nbsp;
								<select name="mail_af" size="1">
									<option value="@gmail.com">gmail.com</option>
									<option value="@yahoo.co.jp">yahoo.co.jp</option>
									<option value="@docomo.ne.jp">docomo.ne.jp</option>
									<option value="@ezweb.ne.jp">ezweb.ne.jp</option>
									<option value="@softbank.ne.jp">softbank.ne.jp</option>
								</select>
							</p>
						</div>
						<div class="fooooorm3">
							<p>
								メールアドレス（確認）：&nbsp;
								<input type="text" name="mail" required>
								&nbsp;＠&nbsp;
								<select name="mail_af2" size="1">
									<option value="@gmail.com">gmail.com</option>
									<option value="@yahoo.co.jp">yahoo.co.jp</option>
									<option value="@docomo.ne.jp">docomo.ne.jp</option>
									<option value="@ezweb.ne.jp">ezweb.ne.jp</option>
									<option value="@softbank.ne.jp">softbank.ne.jp</option>
								</select>
							</p>
						</div>
						<div class="fooooorm4">
							<p>
								カテゴリ：&nbsp;
								<select name="category" size="1">
									<option value="K_1">動作環境</option>
									<option value="K_2">作品について</option>
									<option value="K_3">退会</option>
									<option value="K_4">ログイン</option>
									<option value="K_5">購入</option>
									<option value="K_6">その他</option>
								</select>
							</p>
						</div>
						<div class="fooooorm5">
							<p>タイトル：&nbsp;<input type="text" name="title" required</p>
						</div>
						<div class="fooooorm6">
							<p>本文：&nbsp;<input type="text" name="main_text" required></p>
						</div>
						<div class="fooooorm7"  onClick="submiiiit()">
							<p>確認</p>
						</div>
						
						
					</form>
					
				</div>
<!-- フローティング操作ボタン -->
			<a id="fab" href="US15.php">
				<i class="fas fa-home"></i>
			</a>
			
			
			

		</div>
	</body>
</html>

