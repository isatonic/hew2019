<?php
session_start();
if (isset($_SESSION["username"])) {
  $username = $_SESSION["username"];
} else {
  $username = "ログイン";
}
if (isset($_POST["regist_err"])) {
  $msg = $_POST["regist_err"];
} else {
  $msg = "";
}
?>
<html>
	<head>
	<title>新規会員登録 | ISATONIC</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
	<meta name="viewport" content="width=device-width,initial-scale=1">

	<link rel="stylesheet" href="css/style-j.css">
	<script src="js/modernizr.js"></script>
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
	<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
    <script src="js/gooey.min.js"></script>
	<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<link rel="stylesheet" href="css/style_MyPage.css">
	<link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
	<script src="js/Mypage.js"></script>
	<script src="js/ozawa.js"></script>
	</head>
	<body>

    <div class="cd-main-content">
       <header class="cd-main-header animate-search">
		<nav class="cd-main-nav-wrapper">
        　　 <img src="img/LOGO/LOGO W.png" class="logo" alt="" onClick="location.href='../index/index.php'">
			<a href="javascript:searchForm.submit()" class="cd-search-trigger cd-text-replace">Search</a>

			<ul class="cd-main-nav">
				<li><a href="./login.php"><?php echo $username;?></a></li>
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

					<div class="wrap2">
						<div class="container font_center">
							<h1>新規会員登録</h1>
							<br>

              <div class="error_message">
                <p>
                    <?php
                    echo $msg;
                    ?>
                </p>
              </div>
						<form method="post" action="../controller/regist.php">
							<input type="text" name="userName" placeholder="ニックネーム(2文字以上)" required />
									<input type="text" name="lastName" placeholder="姓" max="10" class="name_1" required>
									<input type="text" name="firstName" placeholder="名" max="10" class="name_2" required>

							<select name="gender" style="color:#666666;text-align: center;" required>
								  <option value="">-- 性別 --</option>
								  <option value="m">男性</option>
								  <option value="f">女性</option>
								</select>
								<input type="text" name="year" class="ll" placeholder="誕生年" required/>

								<select name="month" style="color:#666666;text-align: center;" class="name_1" required>
								  <option value="">-- 誕生月 --</option>
								  <option value="1">1</option>
								  <option value="2">2</option>
								  <option value="3">3</option>
								  <option value="4">4</option>
								  <option value="5">5</option>
								  <option value="6">6</option>
								  <option value="7">7</option>
								  <option value="8">8</option>
								  <option value="9">9</option>
								  <option value="10">10</option>
								  <option value="11">11</option>
								  <option value="12">12</option>
								</select>
								<select name="day" style="color:#666666;text-align: center;" class="name_2" required>
								  <option value="">-- 誕生日 --</option>
								  <option value="1">1</option>
								  <option value="2">2</option>
								  <option value="3">3</option>
								  <option value="4">4</option>
								  <option value="5">5</option>
								  <option value="6">6</option>
								  <option value="7">7</option>
								  <option value="8">8</option>
								  <option value="9">9</option>
								  <option value="10">10</option>
								  <option value="11">11</option>
								  <option value="12">12</option>
								  <option value="13">13</option>
								  <option value="14">14</option>
								  <option value="15">15</option>
								  <option value="16">16</option>
								  <option value="17">17</option>
								  <option value="18">18</option>
								  <option value="19">19</option>
								  <option value="20">20</option>
								  <option value="21">21</option>
								  <option value="22">22</option>
								  <option value="23">23</option>
								  <option value="24">24</option>
								  <option value="25">25</option>
								  <option value="26">26</option>
								  <option value="27">27</option>
								  <option value="28">28</option>
								  <option value="29">29</option>
								  <option value="30">30</option>
								  <option value="31">31</option>
								  </select>
								<input type="text" name="email" placeholder="メールアドレス" required/>
								<input type="password" name="pass" placeholder="パスワード(8文字以上~16文字以下)" required/>
								<input type="password" name="pass_confirm" placeholder="パスワード(確認)" required/>
              <input type="hidden" name="type" value="user">
								<input type="submit" value="登録"/>
            </form>
						</div>


					</div>



	</body>
</html>

