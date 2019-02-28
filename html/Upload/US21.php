<html>
	<head>
	<title>アップロード | ISATONIC</title>
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
	<script src="js/ozawa.js"></script>
	</head>	
	<body>
    
    <div class="cd-main-content">
       <header class="cd-main-header animate-search">
		<nav class="cd-main-nav-wrapper">
        　　 <img src="img/LOGO/LOGO W.png" class="logo" alt="" onClick="location.href='../index/index.html'">
			<a href="javascript:searchForm.submit()" class="cd-search-trigger cd-text-replace">Search</a>
			
			<ul class="cd-main-nav">
<<<<<<< HEAD
				<li><a href="" data-type="page-transition">ログイン&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|</a></li>
				<li><a href="">一覧&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|</a></li>
				<li><a href="../SNS/SN1.php">SNS&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|</a></li>
				<li><a href="">カート</a></li>
=======
				<li><a href="">ログイン</a></li>
				<li><h4 style="color: #FFF;position: relative;top: -5%;">&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;</h4></li>
				<li><a href="../Genre/US27.php">ジャンル検索</a></li>
				<li><h4 style="color: #FFF;position: relative;top: -5%;">&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;</h4></li>
				<li><a href="../SNS/SN1.html">SNS</a></li>
				<li><h4 style="color: #FFF;position: relative;top: -5%;">&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;</h4></li>
				<li><a href="../cart/US8.php">カート</a></li>
>>>>>>> 652632ab34d4b29246dd37f0b5ba53762a7f188c
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
			<h2 class="Header">　　アップロード</h2>
				<div class="mype_main">
					
				<form action="US21_upload.php" method="post" enctype="multipart/form-data" id="form01" name="form01">
					<div class="category_1">
						<p>カテゴリ選択：&nbsp;&nbsp;
							
							<select name="cate_1" size="1" class="borderr2">
								<option value="" selected>-選択してください-</option>
								<option value="写真">写真</option>
								<option value="イラスト">イラスト</option>
							</select>
							&nbsp;/&nbsp;
							<select name="cate_2" size="1" class="borderr2">
								<option value="" selected>-選択してください-</option>
								<option value="ビジネス">ビジネス</option>
								<option value="スポーツ">スポーツ</option>
								<option value="イベント">イベント</option>
								<option value="動物">動物</option>
								<option value="魚">魚</option>
								<option value="植物">植物</option>
								<option value="虫">虫</option>
								<option value="鳥">鳥</option>
								<option value="SF">SF</option>
								<option value="料理">料理</option>
								<option value="野菜">野菜</option>
								<option value="楽器">楽器</option>
								<option value="ファッション">ファッション</option>
								<option value="風景">風景</option>
								<option value="雑貨">雑貨</option>
								<option value="文房具">文房具</option>
								<option value="乗り物">乗り物</option>
								<option value="家具">家具</option>
								<option value="宇宙">宇宙</option>
								<option value="空">空</option>
								<option value="建物">建物</option>
								<option value="人">人</option>
							</select>
						</p>
					</div>
					<div class="category_2">
						<div id="btn">
							<p><i class="fas fa-file-upload"></i>&nbsp;写真を選択</p>
						</div>
						<div class="view_box">
							<input type="file" id="files" class="file" name="files">
							<div class="placeholder">
								<input type="text" id="filename" class="filename" placeholder="選択すると名前が表示されます..." readonly>
							</div>
						</div>
						<div class="img_position">
							<p>画像がここにプレビューされます...</p>
						</div>
						
						
							&nbsp;&nbsp;
					</div>
					<div class="category_3">
						<div class="title_img">
							<p>タイトル：&nbsp;<input type="text" name="title" required maxlength="20" placeholder=" 20文字以内で記入してください"></p>
						</div>
						<div class="main_img">
							<p>紹介テキスト：&nbsp;<textarea name="main_text" rows="3" cols="30" required maxlength="60" placeholder=" 60文字以内で記入してください"></textarea></p>
						</div>
						<div class="moneeeey">
							<p>販売金額：&nbsp;<select name="cate_3" size="1" class="borderr">
								<option value="" selected>-選択してください-</option>
								<option value="600TP">６００TP</option>
								<option value="700TP">７００TP</option>
								<option value="800TP">８００TP</option>
								<option value="900TP">９００TP</option>
								<option value="1000TP">１０００TP</option>
								</select></p>
						</div>
					</div>
							<div class="up_submit" onClick="submits()">
								<p>進む</p>
							</div>
				</form>
					
					
					
					
				</div>
<!-- フローティング操作ボタン -->
			<a id="fab" href="US21.php">
				<i class="fas fa-home"></i>
			</a>
			
			
			

		</div>
	</body>
</html>

