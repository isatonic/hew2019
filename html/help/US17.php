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
			<a href="javascript:searchForm.submit()" class="cd-search-trigger cd-text-replace">Search</a>
			
			<ul class="cd-main-nav">
				<li><a href="../login/login.php">ログイン</a></li>
				<li><h4 style="color: #FFF;position: relative;top: -5%;">&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;</h4></li>
				<li><a href="../Genre/US27.php">ジャンル検索</a></li>
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
					
					<form action="./US18.php" method="POST" id="form001" name="form1">
						<div class="fooooorm1">
							<p>
								氏名（姓）：&nbsp;<input type="text" name="name_s" required maxlength="10" autofocus>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								氏名（名）：&nbsp;<input type="text" name="name_m" required maxlength="10">
							</p>
						</div>
						<div class="fooooorm2">
							<p>
								メールアドレス：&nbsp;<input type="text" name="mail" required maxlength="60" pattern="^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$">
							</p>
						</div>
						<div class="fooooorm3">
							<p>
								メールアドレス（確認）：&nbsp;
								<input type="text" name="mail2" required maxlength="30" pattern="^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$">
							</p>
						</div>
						<div class="fooooorm4">
							<p>
								カテゴリ：&nbsp;
								<select name="category" size="1" class="borderr2">
									<option value="">-選択してください-</option>
									<option value="動作環境">動作環境</option>
									<option value="作品について">作品について</option>
									<option value="退会">退会</option>
									<option value="ログイン">ログイン</option>
									<option value="購入">購入</option>
									<option value="その他">その他</option>
								</select>
							</p>
						</div>
						<div class="fooooorm5">
							<p>タイトル：&nbsp;<input type="text" name="title" required maxlength="20"></p>
						</div>
						<div class="fooooorm6">
							<p class="main_Bunshou">本文：&nbsp;</p><p class="textarea"><textarea name="main_text" rows="4" cols="70" required maxlength="100"></textarea></p>
						</div>
						<div class="fooooorm7" onClick="check_sub()">
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

