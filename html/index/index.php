<?php
session_start();
if (isset($_SESSION["username"])) {
  $username = $_SESSION["username"];
} else {
  $username = "ログイン";
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <title>トップページ | ISATONIC</title>
  <meta name="viewport"
        content="width=device-width, initial-scale=1, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
  <meta charset="UTF-8">
  <script type="text/javascript" src="js/modernizr.js"></script>
  <script type="text/javascript" src="js/jquery-2.1.3.min.js"></script>
  <script type="text/javascript" src="js/gooey.min.js"></script>
  <script>
      // 左下のリンクが出てくるボタン
      $(function ($) {
          $("#gooey-v").gooeymenu({
              bgColor: "#333",
              contentColor: "white",
              style: "vertical",
              horizontal: {
                  menuItemPosition: "glue"
              },
              vertical: {
                  menuItemPosition: "spaced",
                  direction: "up"
              },
              circle: {
                  radius: 90
              },
              margin: "small",
              size: 50,
              bounce: true,
              bounceLength: "small",
              transitionStep: 100,
              hover: "#68d099"
          });

      });
  </script>

  <script src="js/jquery.min.js"></script>
  <script src="js/three.js"></script>
  <script src="js/tween.min.js"></script>
  <script src="js/TrackballControls.js"></script>
  <script src="js/CSS3DRenderer.js"></script>
  <link rel="stylesheet" href="css/ozawa.css">
  <link rel="stylesheet" href="css/index.css">
</head>
<body>
<main>

  <!----------------------------- header ------------------------------------>
  <header class="cd-main-header animate-search">
    <nav class="cd-main-nav-wrapper">
      <img src="img/LOGO/LOGO%20W.png" alt="" class="logooooo" onClick="location.href='index.php'">
      <a href="../product_list/US23_productList.php" class="cd-search-trigger cd-text-replace">Search</a>
			
			<ul class="cd-main-nav">
				<li><a href="../login/login.php"><?php echo $username;?></a></li>
				<li><h4 style="color: #FFF;position: relative;top: -5%;">&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;</h4></li>
				<li><a href="../SNS/SN1.php">SNS</a></li>
				<li><h4 style="color: #FFF;position: relative;top: -5%;">&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;</h4></li>
				<li><a href="../cart/US8.php">カート</a></li>
      </ul>
    </nav>
    <a href="" class="cd-nav-trigger cd-text-replace">Menu<span></span></a>
    <div id="search" class="cd-main-search">
      <form action="../controller/search.php" method="post">
        <input type="search" placeholder="入力してください">
      </form>

      <a href="#0" class="close cd-text-replace">Close Form</a>
    </div>
  </header>

  <div id="container"></div>
  <div id="info"></div>

  <!---------------------- menu button (left bottom) ------------------------>
  <div class="row">
    <div class="col-md-5 col-xs-12 vertical-example">
      <nav id="gooey-v">
        <input type="checkbox" class="menu-open" name="menu-opeen4" id="menu-open4">
        <label class="open-button" for="menu-open4">
          <span class="burger burger-1"></span>
          <span class="burger burger-2"></span>
          <span class="burger burger-3"></span>
        </label>
        <a href="../help/US15.php" class="gooey-menu-item">help</a>
        <a href="../My Page/US20.php" class="gooey-menu-item">MyPage</a>
		<a href="../controller/logout.php" class="gooey-menu-item">Logout</a>
      </nav>
    </div>
    <!--<div class="col-md-7 col-xs-12 code-example"></div>-->
  </div>

  <!-------------------- bottom menu ------------------------------------------>
  <div class="menu">
    <div class="topfoot"><img src="img/line.png" alt=""></div>
    <!--<a href="privacy_policy.html" data-type="page-transition">プライバシーポリシー</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;-->
    <a href="privacy_policy.html" class="prifont">プライバシーポリシー</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
    <!--<a href="rules.html" data-type="page-transition">利用規約</a>-->
    <a href="rules.html" class="prifont">利用規約</a>
  </div>

  <script>

      let newArray = [];
      let make_for_limudi = 0;
      let _in = ['bounceIn', 'bounceInDown', 'bounceInLeft',
          'bounceInRight', 'bounceInUp', 'fadeIn', 'fadeInDown',
          'fadeInDownBig', 'fadeInLeft', 'fadeInLeftBig',
          'fadeInRight', 'fadeInRightBig', 'fadeInUp',
          'fadeInUpBig', 'rotateIn', 'rotateInDownLeft',
          'rotateInDownRight', 'rotateInUpLeft', 'rotateInUpRight',
          'slideInDown', 'slideInLeft', 'slideInRight'];
      let _out = ['bounceOut', 'bounceOutDown', 'bounceOutLeft',
          'bounceOutRight', 'bounceOutUp', 'fadeOut', 'fadeOutDown',
          'fadeOutDownBig', 'fadeOutLeft', 'fadeOutLeftBig',
          'fadeOutRight', 'fadeOutRightBig', 'fadeOutUp', 'fadeOutUpBig',
          'rotateOut', 'rotateOutDownLeft', 'rotateOutDownRight',
          'rotateOutUpLeft', 'rotateOutUpRight', 'slideOutDown',
          'slideOutLeft', 'slideOutRight'];

      setInterval(function () {
          let limudi = parseInt(Math.random() * _in.length, 10);
          let limudi_out = parseInt(Math.random() * _out.length, 10);
          if (make_for_limudi >= newArray.length) {
              make_for_limudi = 0;
          }
          $('.show_info').show();
          $('.show_info').addClass(_in[limudi]);
          setTimeout(function () {
              $('.show_info').removeClass(_in[limudi]);
              setTimeout(function () {
                  $('.show_info').addClass(_out[limudi_out]);
                  setTimeout(function () {
                      $('.show_info').removeClass(_out[limudi_out]);
                      $('.show_info').hide();
                  }, 1000);
              }, 1500);
          }, 1000);
      }, 4500);

      // set image
      for (let i = 1; i < 176; i++) {
          newArray.push({
              image: "../testimage_forIndex/" + i + ".png"
          });
      }


      let tb = [];
      for (let i = 0; i < newArray.length; i++) {
          tb[i] = {};
          if (i < newArray.length) {
              tb[i] = newArray[i];
              tb[i].src = newArray[i].thumb_image;
          }
          tb[i].p_x = i % 20 + 1;
          tb[i].p_y = Math.floor(i / 20) + 1;
      }
      let camera, scene, renderer;
      let controls;

      let objects = [];
      let targets = {tb: [], sphere: [], grid: []};

      figurate();
      animate();

      function figurate() {

          camera = new THREE.PerspectiveCamera(40, window.innerWidth / window.innerHeight, 1, 10000);
          camera.position.z = 3000;

          scene = new THREE.Scene();


          for (let i = 0; i < tb.length; i++) {
              let element = document.createElement('div');
              element.className = 'element';
              element.style.backgroundColor = +(Math.random() * 0.5 + 0.25) + ')';
              let img = document.createElement('img');
              img.src = tb[i].image;
              element.appendChild(img);
              let object = new THREE.CSS3DObject(element);
              object.position.x = Math.random() * 4000 - 2000;
              object.position.y = Math.random() * 4000 - 2000;
              object.position.z = Math.random() * 4000 - 2000;
              scene.add(object);

              objects.push(object);
              let object1 = new THREE.Object3D();
              object1.position.x = (tb[i].p_x * 140) - 1330;
              object1.position.y = -(tb[i].p_y * 180) + 990;

              targets.tb.push(object1);

          }


          let vector = new THREE.Vector3();
          let spherical = new THREE.Spherical();

          let l = objects.length;
          for (let i = 0; i < l; i++) {

              let phi = Math.acos(-1 + (2 * i) / l);
              let theta = Math.sqrt(l * Math.PI) * phi;

              let object = new THREE.Object3D();

              spherical.set(800, phi, theta);

              object.position.setFromSpherical(spherical);

              vector.copy(object.position).multiplyScalar(2);

              object.lookAt(vector);

              targets.sphere.push(object);

          }


          for (let i = 0; i < l; i++) {

              let object = new THREE.Object3D();

              object.position.x = ((i % 5) * 400) - 800;
              object.position.y = (-(Math.floor(i / 5) % 5) * 300) + 500;
              object.position.z = (Math.floor(i / 25)) * 200 - 800;
              targets.grid.push(object);

          }

          renderer = new THREE.CSS3DRenderer();
          renderer.setSize(window.innerWidth, window.innerHeight);
          renderer.domElement.style.position = 'absolute';
          document.getElementById('container').appendChild(renderer.domElement);

          controls = new THREE.TrackballControls(camera, renderer.domElement);
          controls.rotateSpeed = 5;
          controls.minDistance = 500;
          controls.maxDistance = 5000;
          controls.addEventListener('change', render);

          let ini = 0;
          setInterval(function () {
              ini = ini >= 2 ? 0 : ini;
              ++ini;
              switch (ini) {
                  case 1:
                      transform(targets.sphere, 3000);
                      break;
                  case 2:
                      transform(targets.grid, 3000);
                      break;
              }
          }, 8000);

          transform(targets.tb, 2000);

          window.addEventListener('resize', onWindowResize, false);

      }

      function transform(targets, duration) {

          TWEEN.removeAll();

          for (let i = 0; i < objects.length; i++) {

              let object = objects[i];
              let target = targets[i];

              new TWEEN.Tween(object.position)
                  .to({
                      x: target.position.x,
                      y: target.position.y,
                      z: target.position.z
                  }, Math.random() * duration + duration)
                  .easing(TWEEN.Easing.Exponential.InOut)
                  .start();

              new TWEEN.Tween(object.rotation)
                  .to({
                      x: target.rotation.x,
                      y: target.rotation.y,
                      z: target.rotation.z
                  }, Math.random() * duration + duration)
                  .easing(TWEEN.Easing.Exponential.InOut)
                  .start();

          }

          new TWEEN.Tween(this)
              .to({}, duration * 2)
              .onUpdate(render)
              .start();

      }

      function onWindowResize() {

          camera.aspect = window.innerWidth / window.innerHeight;
          camera.updateProjectionMatrix();

          renderer.setSize(window.innerWidth, window.innerHeight);

          render();

      }

      function animate() {

          scene.rotation.y += 0.005;

          requestAnimationFrame(animate);

          TWEEN.update();

          controls.update();

          render();

      }

      function render() {

          renderer.render(scene, camera);

      }
  </script>
</main>
<div class="cd-cover-layer"></div>
<div class="cd-loading-bar"></div>

<script src="js/jquery-2.1.4.js"></script>
<script src="js/main.js"></script>
<script src="js/jquery-2.1.1.js"></script>
<script src="js/main-j.js"></script>
</body>
</html>
