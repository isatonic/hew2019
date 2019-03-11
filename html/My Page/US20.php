<?php
session_start();
if (isset($_SESSION["username"])) {
  $username = $_SESSION["username"];
} else {
  $username = "ログイン";
}
if (!isset($_SESSION["id"]) or is_null($_SESSION["id"])) {
    // login required
    header("Location: ../login/login.php", true, 302);
}
$user = $_SESSION["id"];
if (isset($_SESSION["isatonic_home_data"]) and !is_null($_SESSION["isatonic_home_data"])) {
    $homeData = $_SESSION["isatonic_home_data"];
    unset($_SESSION["isatonic_home_data"]);
} else {
    header("../controller/userHome.php", true, 302);
}
// 作品を格納するディレクトリ
$upload_dir = "../uploaded_files/";
// アイコンを格納するディレクトリ
$icon_dir = "./icon/";
if (file_exists($icon_dir . $user . ".png")) {
    $icon = $icon_dir . $user . ".png";
} else {
    $icon = $icon_dir . "icon_default.png";
}
?>
<html>
<head>
  <title>My Page | ISATONIC</title>
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
  <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
  <script src="js/Mypage.js"></script>
  <script src="js/ozawa.js"></script>
  <script type="text/javascript">
      <?php
      if (isset($_SESSION["isatonic_pass_change_err"])) {
          $err_msg = $_SESSION["isatonic_pass_change_err"];
          unset($_SESSION["isatonic_pass_change_err"]);
          echo "alert('$err_msg');";
      }
      ?>
  </script>
    <?php
    // リロード(F5)した時に再度DBにアクセス
    if (is_null($homeData)) {
        echo <<<RD
      <script>
        window.location = "../controller/userHome.php";
      </script>
RD;
    }
    ?>
</head>
<body>

<div class="cd-main-content">
  <header class="cd-main-header animate-search">
    <nav class="cd-main-nav-wrapper">
      　　 <img src="img/LOGO/LOGO W.png" class="logo" alt="" onClick="location.href='../index/index.php'">
      <a href="javascript:searchForm.submit()" class="cd-search-trigger cd-text-replace">Search</a>

      <ul class="cd-main-nav">
        <li><a href="../login/login.php"><?php echo $username;?></a></li>
        <li><h4 style="color: #FFF;position: relative;top: -5%;">&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;</h4>
        </li>
        <li><a href="../SNS/SN1.php">SNS</a></li>
        <li><h4 style="color: #FFF;position: relative;top: -5%;">&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;</h4>
        </li>
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
  <h2 class="Header">　　My Page</h2>
  <div class="mype_main">
    <div class="mype_name">
      <div class="photo">
        <img src="<?php echo $icon; ?>" alt="アイコン"> <!-- ユーザのアイコン -->
      </div>
      <div class="tonic_name">
        <p class="simei">
            <?php
            $sei = $homeData["user_info"]["lastName"];
            $mei = $homeData["user_info"]["firstName"];
            echo "$sei $mei";
            ?>
          <!-- ユーザ名 --> 様</p>
      </div>
      <div class="nicname">
        <p class="user_name">
            <?php
            echo $homeData["user_detail"];
            ?>
        </p>
      </div>
      <!-- 三種ボタン -->
      <div class="messeage_aleat">
        <p>新着メッセージ：
            <?php
            echo '○件';
            ?></p>
      </div>
      <a href="../SNS/SN1.php">
        <div class="messeage_gogo flat_button">
          <p>メッセージ作成</p>
        </div>
      </a>
      <a href="../SNS/SN1.php">
        <div class="friend_search_go flat_button">
          <p>フレンド検索</p>
        </div>
      </a>
    </div>
    <div class="mype_tonicG">
      <div class="t-grade">
        <p>T-Grade</p>
        <img src="img/6th.png" alt="グレード">
        <!-- TODO: グレード 1st~5th の画像を追加してコメントアウト -->
        <!--                --><?php
          //                $grade = (int)$homeData["grade"];
          //                switch ($grade) {
          //                    case 1:
          //                      $grade = "{$grade}st";
          //                      break;
          //                    case 2:
          //                        $grade = "{$grade}nd";
          //                        break;
          //                    case 3:
          //                        $grade = "{$grade}rd";
          //                        break;
          //                    default:
          //                      $grade = "{$grade}th";
          //                }
          //                echo "<img src='./img/{$grade}.png' alt='グレード'>"
          //                ?>
      </div>
    </div>
    <div class="mype_tonicP">
      <div class="tonic_point">
        <p>TONIC POINT</p>
      </div>
      <div class="inner_tonic_point">
        <p>
            <?php
            echo $homeData["point"];
            ?>
          P
        </p>
      </div>
      <a href="../TONIC%20POINT%20Charge/US12.php">
        <div class="tonic_point_charge flat_button">
          <p>チャージする</p>
        </div>
      </a>
    </div>


    <div class="profile flat_button2" id="openModal">
      <p>｜プロフィール設定・変更</p>
      <i class="fas fa-users fa-fw imafont"></i>
    </div>

    <div class="pass flat_button2" id="openModal2">
      <p>｜パスワード変更</p>
      <i class="fas fa-key fa-fw imafont"></i>
    </div>

    <div class="push_cre flat_button2" id="openModal3">
      <p>｜投稿作品一覧・アップロード</p>
      <i class="fas fa-images fa-fw imafont3"></i><i class="fas fa-upload fa-fw imafont2"></i>
    </div>

    <div class="buy_cre flat_button2" id="openModal4">
      <p>｜購入作品一覧</p>
      <i class="far fa-images fa-fw imafont"></i>
    </div>

    <div class="money_check flat_button2" id="openModal5">
      <p>｜売上確認</p>
      <i class="fas fa-money-check-alt fa-fw imafont"></i>
    </div>

    <div class="byebye flat_button2" id="openModal6">
      <p>｜退会</p>
      <i class="fas fa-thumbs-down fa-fw imafont"></i>
    </div>

    <!-- モダールウィンドウ -->

    <!-- プロフィール設定・モーダルエリアここから -->
    <section id="modalArea" class="modalArea">
      <div id="modalBg" class="modalBg"></div>
      <div class="modalWrapper">
        <div class="modalContents">

          <!-- ユーザアイコンアップロード -->
          <div class="user_imageee">
            <h1 class="icon_change">ユーザアイコン変更</h1>
            <form action="../controller/changeIcon.php" method="post" enctype="multipart/form-data" id="form01"
                  name="form01">
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
              <div class="up_submit" onClick="submits()">
                <p>進む</p>
              </div>
            </form>
          </div>


          <!-- ユーザ名 -->
          <div class="user_nameee">
            <h1 class="username_change">ユーザ名変更</h1>
            <form action="../controller/userNameChange.php" method="post" id="form0001">
              <input type="text" name="name_change" required maxlength="20">
              <div class="up_submit2" onClick="submits_id()">
                <p>変更</p>
              </div>
            </form>
          </div>
          <!-- ユーザーID -->
          <div class="user_iddd">
            <h1 class="userid">ユーザーID</h1>
            <p>
                <?php
                echo "{$_SESSION['id']}";
                ?>
            </p>
          </div>
        </div>
        <div id="closeModal" class="closeModal">
          ×
        </div>
      </div>
    </section>
    <!-- モーダルエリアここまで -->
    <!-- パスワード変更・モーダルエリアここから -->
    <section id="modalArea2" class="modalArea2">
      <div id="modalBg2" class="modalBg2"></div>
      <div class="modalWrapper2">
        <div class="modalContents2">

          <!-- ユーザ名 -->
          <h1 class="password_change">パスワード変更</h1>
          <form name="form1" id="form1" action="../controller/userPassChange.php" method="post"
                onSubmit="return check()">


            <div class="passgroup">
              <div class="form-group">
                <label>旧パスワード：</label>
                <input type="password" class="form-control" name="password_old" id="password_old" required>
              </div>
              <br>
              <div class="form-group">
                <label>新パスワード：</label>
                <input type="password" class="form-control" name="password" id="password" required>
              </div>
              <br>
              <div class="form-group">
                <label>新パスワード (再確認)：</label>
                <input type="password" class="form-control" name="confirm" required>
              </div>
            </div>
            <div class="up_submit3" onClick="submits_pass()">
              <p>変更</p>
            </div>
          </form>

        </div>
        <div id="closeModal" class="closeModal">
          ×
        </div>
      </div>
    </section>
    <!-- モーダルエリアここまで -->
    <!-- 投稿作品一覧・モーダルエリアここから -->
    <section id="modalArea3" class="modalArea3">
      <div id="modalBg3" class="modalBg3"></div>
      <div class="modalWrapper3">
        <div class="modalContents3">
          <div class="upload_pagego flat_button" onClick="location.href='../Upload/US21.php'">
            <p>アップロード</p>
          </div>
          <div class="imgimg">
              <?php
              if (is_null($homeData["product"])) {
                  echo "投稿された作品はありません。";
              } else {
                  foreach ($homeData["product"] as $row) {
                      echo "<img src='${upload_dir}{$row['fileName']}' alt='' class='imageee1'>";
                  }
              }
              ?>
          </div>
        </div>
        <div id="closeModal" class="closeModal">
          ×
        </div>
      </div>
    </section>
    <!-- モーダルエリアここまで -->
    <!-- 購入作品一覧・モーダルエリアここから -->
    <section id="modalArea4" class="modalArea4">
      <div id="modalBg4" class="modalBg4"></div>
      <div class="modalWrapper4">
        <div class="modalContents4">
            <?php
            if (is_null($homeData["buyHistory"])) {
                echo "購入した商品はありません。";
            } else {
                foreach ($homeData["buyHistory"] as $row) {
                    echo <<<IMG
                        <img src="${upload_dir}{$row['productData'][0]['fileName']}" alt="" class="imageee">
IMG;
                }
            }
            ?>
        </div>
        <div id="closeModal" class="closeModal">
          ×
        </div>
      </div>
    </section>
    <!-- モーダルエリアここまで -->
    <!-- 売上確認・モーダルエリアここから -->
    <section id="modalArea5" class="modalArea5">
      <div id="modalBg5" class="modalBg5"></div>
      <div class="modalWrapper5">
        <div class="modalContents5">
          <div class="buybuybuy">
            <p class="buycheck">画像　　　　　　　素材タイトル　　　　　　　販売額　　　　　　　売上額</p>
          </div>
          <div class="buybuyimage">
            <img src="img/placeholder.png" alt="" class="imageee">
            <img src="img/placeholder.png" alt="" class="imageee">
            <img src="img/placeholder.png" alt="" class="imageee">
          </div>
          <div class="buybuytitle">
            <p class="buyname">あああ</p>
            <p class="buyname2">ああああああ</p>
            <p class="buyname3">ああだだだあ</p>
          </div>

          <div class="buybuyyen">
            <p class="buyyen">￥600</p>
            <p class="buyyen2">￥1000</p>
            <p class="buyyen3">￥400</p>
          </div>

          <div class="buybuygetyen">
            <p class="buyyenyen">￥60</p>
            <p class="buyyenyen2">￥100</p>
            <p class="buyyenyen3">￥40</p>
          </div>


        </div>
        <div id="closeModal" class="closeModal">
          ×
        </div>
      </div>
    </section>
    <!-- モーダルエリアここまで -->
    <!-- 退会・モーダルエリアここから -->
    <section id="modalArea6" class="modalArea6">
      <div id="modalBg6" class="modalBg6"></div>
      <div class="modalWrapper6">
        <div class="modalContents6">
          <p>退会をすると、T-Grade・TONIC POINTともにすべてが失われます。<br><br>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;退会しますか？
          </p>

          <div class="goodbye_yes" id="openModal7">
            <p>はい</p>
          </div>
          <div class="goodbye_no down_the_button">
            <p>いいえ</p>
          </div>

        </div>
        <div id="closeModal" class="closeModal">
          ×
        </div>
      </div>
    </section>
    <!-- モーダルエリアここまで -->


    <!-- 退会さいかくにーーーーん・モーダルエリアここから -->
    <section id="modalArea7" class="modalArea7">
      <div id="modalBg7" class="modalBg6"></div>
      <div class="modalWrapper7">
        <div class="modalContents7">
          <p>本当に退会しますか？</p>

          <div class="goodbye_yesyes" onClick="location.href='US20_goodbye.php'">
            <p>はい</p>
          </div>
          <div class="goodbye_nono down_the_button2">
            <p>いいえ</p>
          </div>

        </div>
        <div id="closeModal2" class="closeModal2">
          ×
        </div>
      </div>
    </section>
    <!-- モーダルエリアここまで -->


  </div>
  <!-- フローティング操作ボタン -->
  <a id="fab" href="US20.php">
    <i class="fas fa-home"></i>
  </a>


</body>
</html>

