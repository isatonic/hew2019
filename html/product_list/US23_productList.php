<?php
session_start();
if (isset($_SESSION["username"])) {
  $username = $_SESSION["username"];
} else {
  $username = "ログイン";
}
if (!isset($_SESSION["isatonic_searchResult"])) {
//  echo "debug: 検索なし。 ../controller/search.php にリダイレクトを推奨。";
    header("Location: ../controller/search.php", true, 302);
} else {
  $searchResult = $_SESSION["isatonic_searchResult"];
  unset($_SESSION["isatonic_searchResult"]);
}
?>
<!DOCTYPE html>
<html amp lang="ja">
<head>
  <meta charset="utf-8">
  <script async src="https://cdn.ampproject.org/v0.js"></script>
  <title>検索結果 | ISATONIC</title>
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
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
  <link rel="canonical" href="./US23_productList.php">
  <style amp-boilerplate>body{-webkit-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-moz-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-ms-animation:-amp-start 8s steps(1,end) 0s 1 normal both;animation:-amp-start 8s steps(1,end) 0s 1 normal both}@-webkit-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-moz-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-ms-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-o-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}</style><noscript><style amp-boilerplate>body{-webkit-animation:none;-moz-animation:none;-ms-animation:none;animation:none}</style></noscript>
  <link rel="stylesheet" href="./css/product_list.css">
  <script src="./js/modal.js"></script>
  <script type="text/javascript">
    var phpjson = <?php echo $searchResult;?>;
    console.table(phpjson);
  </script>
  <script type="text/javascript" defer>
      <?php
      if (isset($_SESSION["isatonic_addCart_err"])) {
          $err_msg = $_SESSION["isatonic_addCart_err"];
          unset($_SESSION["isatonic_addCart_err"]);
          echo "alert('$err_msg');";
      }
      ?>
  </script>
  <script src="./js/addCart.js"></script>
  <script src="./js/setModal.js"></script>
</head>
<body>

<div class="cd-main-content">
  <header class="cd-main-header animate-search">
    <nav class="cd-main-nav-wrapper">
　　 <img src="img/LOGO/LOGO W.png" class="logo" alt="" onClick="location.href='../index/index.php'">

      <!--------------------- 検索ボタン ----------------------------->
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

<div class="main-content">

  <!----------------------- ボタン ---------------------------->
  <!--<div class="button-wrap flex-container">
      <button class="controll-button">ジャンル検索</button>
      <button class="controll-button" id="sortNew">新作順</button>
      <button class="controll-button">ランキング順</button>
  </div>-->
  <!----------------------------------------------------------->

  <!------------------------- 一覧 ---------------------------->
  <div class="product-list flex-container" id="product-list">
    <script src="js/productListing.js"></script>
<!--    <div class="product-container">-->
<!--      <amp-img class="product openModal" layout="fill" src="./img/クレジットカードブランド.jpg" alt=""></amp-img>-->
<!--    </div>-->
  </div>
  <!----------------------------------------------------------->

  <section id="modalArea" class="modalArea">
    <div id="modalBg" class="modalBg"></div>
    <div class="modalWrapper">
      <div class="modalContents flex-container">
        <div class="image">
          <div class="image-container flex-container">
            <img class="thumbnail" id="detail-thumbnail" src="./img/placeholder.png" alt="">
          </div>
          <button class="report">この作品を通報する</button>
        </div>
        <div class="detail">
          <div class="title" id="detail-title">
            あああ。このタイトルは二十文字までです。
          </div>
          <div class="comment" id="detail-comment">
            コメントは六十文字までです。あああああああああああああああああああああああああああああああああああああああああああああ。
          </div>
          <div class="price">
            <div class="display-area" id="detail-price">
              販売金額: 1000 P
            </div>
          </div>
          <div class="submit"><button id="cartButton" value="" onclick="addCart(this);">カートに入れる</button></div>
        </div>
      </div>
      <div id="closeModal" class="closeModal">
        ×
      </div>
    </div>
  </section>

</div>

</body>
</html>
