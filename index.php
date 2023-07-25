<!DOCTYPE html>
<html lang="ru">
<head>
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-VFKD3YV1YB"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-VFKD3YV1YB');
</script>
<meta data-n-head="ssr" name="viewport" content="width=device-width, initial-scale=0.55">
    <meta data-n-head="ssr" data-hid="og:title" property="og:title" content="ParadiseRP">
    <meta data-n-head="ssr" data-hid="og:image" property="og:image" content="plashka.png">
    <meta data-n-head="ssr" data-hid="description" name="description" content="ParadiseRP, это уникальный сервер Minecraft, посвященный Minecraft и сделан всего-лишь двумя лучшими друзьями">
    <meta data-n-head="ssr" data-hid="og:description" property="og:description" content="ParadiseRP, это уникальный сервер Minecraft, посвященный Minecraft и сделан всего-лишь двумя лучшими друзьями">
    <meta data-n-head="ssr" name="format-detection" content="telephone=no">
    <link data-n-head="ssr" rel="icon" type="image/x-icon" href="/logo.png">
    <link rel="shortcut icon" href="/logo.png" type="image/png">
<meta charset="utf-8">
<link rel="shortcut icon" href="/logo.png" type="image/png">
  <title>ParadiseRP</title>
  <style>

    .players_tab {
      margin-bottom: 30px;
    }

    body {
  background-image: url('backround.png');
  background-repeat: no-repeat;
  background-size:cover;
  position: relative;
  overflow-y:scroll; /* Заменяем hidden на scroll */
  scroll-behavior: smooth;
  z-index: -100;
}

.blur-background { /*   <div class="blur-background"></div> */
  position:fixed;
  transform: translateY(10px);
  top: -10px;
  width: 100%;
  height: 7000px;
  background-image: url('backround.png');
  background-repeat: no-repeat;
  background-size: cover;
  z-index: -1;
}
       
.content {
  padding-top: 200px;
      text-align: center;
      color: white;
      position: relative;
      z-index: 1;
      opacity: 0;
      transform: translateY(20px);
      animation: fade-in 0.5s ease 0.6s forwards;
      scroll-behavior: smooth;
      overflow-y: hidden;
     /* height: calc(100vh - 200px);
      --content-height: auto; */
}

    /* Добавляем стили для полосы прокрутки */
.content::-webkit-scrollbar {
  width: 8px;
}

.content::-webkit-scrollbar-thumb {
  background: white;
  border-radius: 10px;
}

.content::-webkit-scrollbar-track {
  background: transparent;
}

    /* Добавляем стили для полосы прокрутки */
    body::-webkit-scrollbar {
      width: 10px;
      background: #bfad0d;
      z-index: -100000;
    }

    body::-webkit-scrollbar-thumb {
      background: white;
      border-radius: 10px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
    }

    body::-webkit-scrollbar-track {
      background: transparent;
      z-index: -100000; /* Добавляем этот стиль для задания z-index для фона полосы прокрутки */
    }

    @keyframes fade-in {
      0% {
        opacity: 0;
        transform: translateY(20px);
      }
      100% {
        opacity: 1;
        transform: translateY(0);
      }
    }
    
    .button-main {
      margin-top: 20px;
      padding: 10px 20px;
      background-color: #4CAF50;
      color: white;
      border: none;
      text-decoration: none;
      font-size: 16px;
    }

    .header {
      left: 0px;
      position: fixed;
      top: 0;
      width: 100%;
      height: 60px;
      background-color: rgba(0, 0, 0, 0.7);
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
      z-index: 1000;
    }

    .header-content {
      margin-right: 25px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 0px 5px;
      color: white;
      font-family: Arial, sans-serif;
      
    }
    .logo {
      margin-top: 5px;
      width: 70px;
      height: 50px;
      background-image: url('logo.png');
      background-repeat: no-repeat;
      background-size:contain;
      cursor: pointer; /* добавляем стиль указателя при наведении */
    }

    h3 {
      left: 80px;
      position: absolute;
      font-size: 30px;
      font-family: Arial, Helvetica, sans-serif;
      cursor: pointer;
    }

    .buttons {
      display: flex;
      align-items: center;
      justify-content: flex-end;
      width: calc(100% - 50px);
    }

    .button {
margin-left: 20px;
padding: 5px 30px;
border-radius: 30px;
border: 1px solid white;
background-color: transparent;
font-weight: bold;
text-decoration: none;
font-size: 16px;
background-image: linear-gradient(to right, lightgray, white);
-webkit-background-clip: text;
-webkit-text-fill-color: transparent;
    }
    
    .button:hover {
      font-size: 19px;
    }

    h2 {
      margin-bottom: 2px;
    }

    .progress-bar {
      animation: fade-in 0.5s ease 0s forwards;
      display: none;
      left: calc(50% - 250px);
      position:relative;
            width: 500px;
            height: 30px;
            border: 2px solid grey;
            border-radius: 10px;
            overflow: hidden;
            background-color: grey;
        }
        
        .progress-fill {
          animation: fade-in 0.5s ease 0s forwards;
            height: 100%;
            background: linear-gradient(to right, #0eab99, #05a7b3);
            border-radius: 10px;
        }

        form[type=message_back]{
          position: fixed;
          background-color: rgba(0, 0, 0, 0.7);
          left: -4%;
          width: 115%;
          top: -6%;
          height: 115%;
          z-index: 900000;
          border-radius: 3vh;
          filter: blur(20px);
          
        }

        form[type=message]{
          position: fixed;
          background-color: white;
          width: 44vh;
          height: 34vh;
          top: calc(50% - 17vh);
          left: calc(50% - 22vh);
          z-index: 1000000;
          border-radius: 3vh;
        }

        .hidden {
  display: none;
}

   div[type=content_blur] {
  font-family: Arial, Helvetica, sans-serif;
}

.blur {
     filter: blur(15px);
   }

.not_blur {
  filter: blur(0px);
}

footer {
  background-color: rgba(0, 0, 0, 0.7);
  color: white;
  padding: 20px;
  font-family: Arial, Helvetica, sans-serif;
}

.footer-content {
  display: flex;
  justify-content: space-between;
  /* font-size: 2vw; */
}

.footer-info {
  width: 280px;
  /* font-size: 3vw; */
}

.social-media img {
  width: 30px;
  height: 30px;
  margin-right: 10px;
}

.footer-links ul {
  list-style: none;
  padding: 0;
  width: 30vw;
}

.footer-links li {
  margin-bottom: 10px;
  text-align: center;
  /* font-size: 3vw; */
}

.footer-bottom {
  margin-top: 20px;
  text-align: center;
}

.footer-bottom a {
  color: white;
}

.footer-bottom a:hover {
  text-decoration: underline;
}

iframe {
    width: 90vw;
    height: 50vw;
  }

  h4 {
    text-align: center;
  }

  .scroll-to-top {
  position: fixed;
  bottom: 20px;
  right: 20px;
  z-index: 1000;
  opacity: 0;
  transition: opacity 0.3s ease;
}

.scroll-to-top a {
  display: block;
  width: 80px;
  height: 80px;
  border-radius: 50%;
  background-color: rgba(255, 255, 255, 0.4);
  text-align: center;
  line-height: 40px;
  text-decoration: none;
  color: white;
}

.scroll-to-top img {
  width: 80px;
  height: 80px;
  vertical-align: middle;
}

.scroll-to-top:hover {
  opacity: 1;
}
  </style>
      <script>

    </script>

</head>

<body>
  <!-- <form id="messageBackForm" class="hidden" type="message_back" onclick="removeForms()"></form> -->
<!-- <form id="messageForm" class="hidden" type="message"> -->
  <!-- <h2>dwdwdwdddw</h2> -->
  <!-- <button type="button" onclick="removeForms()">Удалить формы</button> -->
<!-- </form> -->

<div class="scroll-to-top">
  <a href="#header">
    <img src="/img/up.png" alt="Scroll to top">
  </a>
</div>

<div class="header">
    <div class="header-content">
      <div class="logo"></div>
      <h3>ParadiseRP</h3>
      <div class="buttons">
        <a href="#" class="button">Донат</a>
        <a href="#" class="button">Информация</a>
        <a href="authorization/login.php" class="button">Войти</a>
      </div>
    </div>
  </div>

  <div id="ContentBlur" type="content_blur">
  <div class="content">
    <div id="players_tab">
  <div id="online-players"></div>
    <div class="progress-bar">
        <div class="progress-fill"></div>
    </div>
    </div>
    <h2>Этот сайт относится к Minecraft серверу и находится на этапе разработки, и домен временный (в скором времени домен будет: www.paradiserp.fun), весь интерфейс и все функции дорабатываются нашей командой на локальном сервере, а в случае если понадобятся доказательства, до запуска сайта, я вам продемонстрирую работу сайта каким-нибудь способом</h2>
    <h1>Сегодня завершилась разработка Авторизации и Регистрации (посмотрите в видео)</h1>
    <iframe src="https://www.youtube.com/embed/MZGM1CXQjRY" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
<h1>Это сайт по Minecraft</h1>
    <a href="#" class="button-main">Войти</a><h1>Это сайт по Minecraft</h1>
    <a href="#" class="button-main">Войти</a><h1>Это сайт по Minecraft</h1>
    <a href="#" class="button-main">Войти</a><h1>Это сайт по Minecraft</h1>
    <a href="#" class="button-main">Войти</a><h1>Это сайт по Minecraft</h1>
    <a href="#" class="button-main">Войти</a>    <a href="#" class="button-main">Войти</a><h1>Это сайт по Minecraft</h1>
    <a href="#" class="button-main">Войти</a><h1>Это сайт по Minecraft</h1>
    <a href="#" class="button-main">Войти</a><h1>Это сайт по Minecraft</h1>
    <a href="#" class="button-main">Войти</a><h1>Это сайт по Minecraft</h1>
    <a href="#" class="button-main">Войти</a><h1>Это сайт по Minecraft</h1>
    <a href="#" class="button-main">Войти</a><h1>Это сайт по Minecraft</h1>
    <a href="#" class="button-main">Войти</a><h1>Это сайт по Minecraft</h1>
    <a href="#" class="button-main">Войти</a><h1>Это сайт по Minecraft</h1>
    <a href="#" class="button-main">Войти</a><h1>Это сайт по Minecraft</h1>
    <a href="#" class="button-main">Войти</a><h1>Это сайт по Minecraft</h1>
    <a href="#" class="button-main">Войти</a><h1>Это сайт по Minecraft</h1>
    <a href="#" class="button-main">Войти</a><h1>Это сайт по Minecraft</h1>
    <a href="#" class="button-main">Войти</a><h1>Это сайт по Minecraft</h1>
    <a href="#" class="button-main">Войти</a><h1>Это сайт по Minecraft</h1>
    <a href="#" class="button-main">Войти</a><h1>Это сайт по Minecraft</h1>
    <a href="#" class="button-main">Войти</a><h1>Это сайт по Minecraft</h1>
    <a href="#" class="button-main">Войти</a><h1>Это сайт по Minecraft</h1>
    <a href="#" class="button-main">Войти</a>    <a href="#" class="button-main">Войти</a><h1>Это сайт по Minecraft</h1>
    <a href="#" class="button-main">Войти</a><h1>Это сайт по Minecraft</h1>
    <a href="#" class="button-main">Войти</a><h1>Это сайт по Minecraft</h1>
    <a href="#" class="button-main">Войти</a><h1>Это сайт по Minecraft</h1>
    <a href="#" class="button-main">Войти</a><h1>Это сайт по Minecraft</h1>
    <a href="#" class="button-main">Войти</a><h1>Это сайт по Minecraft</h1>
    <a href="#" class="button-main">Войти</a><h1>Это сайт по Minecraft</h1>
    <a href="#" class="button-main">Войти</a><h1>Это сайт по Minecraft</h1>
    <a href="#" class="button-main">Войти</a><h1>Это сайт по Minecraft</h1>
    <a href="#" class="button-main">Войти</a><h1>Это сайт по Minecraft</h1>
    <a href="#" class="button-main">Войти</a><h1>Это сайт по Minecraft</h1>
    <a href="#" class="button-main">Войти</a><h1>Это сайт по Minecraft</h1>
    <a href="#" class="button-main">Войти</a><h1>Это сайт по Minecraft</h1>
    <a href="#" class="button-main">Войти</a><h1>Это сайт по Minecraft</h1>
    <a href="#" class="button-main">Войти</a><h1>Это сайт по Minecraft</h1>
    <a href="#" class="button-main">Войти</a><h1>Это сайт по Minecraft</h1>
    <a href="#" class="button-main">Войти</a><h1>Это сайт по Minecraft</h1>
    <a href="#" class="button-main">Войти</a>    <a href="#" class="button-main">Войти</a><h1>Это сайт по Minecraft</h1>
    <a href="#" class="button-main">Войти</a><h1>Это сайт по Minecraft</h1>
    <a href="#" class="button-main">Войти</a><h1>Это сайт по Minecraft</h1>
    <a href="#" class="button-main">Войти</a><h1>Это сайт по Minecraft</h1>
    <a href="#" class="button-main">Войти</a><h1>Это сайт по Minecraft</h1>
    <a href="#" class="button-main">Войти</a><h1>Это сайт по Minecraft</h1>
    <a href="#" class="button-main">Войти</a><h1>Это сайт по Minecraft</h1>
    <a href="#" class="button-main">Войти</a><h1>Это сайт по Minecraft</h1>
    <a href="#" class="button-main">Войти</a><h1>Это сайт по Minecraft</h1>
    <a href="#" class="button-main">Войти</a><h1>Это сайт по Minecraft</h1>
    <a href="#" class="button-main">Войти</a><h1>Это сайт по Minecraft</h1>
    <a href="#" class="button-main">Войти</a><h1>Это сайт по Minecraft</h1>
    <a href="#" class="button-main">Войти</a><h1>Это сайт по Minecraft</h1>
    <a href="#" class="button-main">Войти</a><h1>Это сайт по Minecraft</h1>
    <a href="#" class="button-main">Войти</a><h1>Это сайт по Minecraft</h1>
    <a href="#" class="button-main">Войти</a><h1>Это сайт по Minecraft</h1>
    <a href="#" class="button-main">Войти</a><h1>Это сайт по Minecraft</h1>
    <a href="#" class="button-main">Войти</a>
  </div>
  </div>

  <footer>
  <div class="footer-content">
    <div class="footer-info">
      <h4>Информация о сервере:</h4>
      <p>Название сервера: ParadiseRP</p>
      <p>Авторы: SnrKryak и Snr_RoSHkam</p>
      <p>Присоеденяйся к нам:</p>
      <div class="social-media">
        <a href="https://facebook.com" target="_blank"><img src="/img/discord-icon.png" alt="Discord"></a>
        <a href="https://twitter.com" target="_blank"><img src="/img/vk-icon.png" alt="VK"></a>
        <a href="https://instagram.com" target="_blank"><img src="/img/youtube-icon.png" alt="YouTube"></a>
      </div>
    </div>
    <div class="footer-links">
      <h4>Полезные ссылки:</h4>
      <ul>
        <li><a class="a-footer" href="#">Ссылка 1</a></li>
        <li><a type="footer"href="#">Ссылка 2</a></li>
        <li><a type="footer"href="#">Ссылка 3</a></li>
        <li><a type="footer"href="#">Ссылка 4</a></li>
      </ul>
    </div>
  </div>
  <div class="footer-bottom">
    <p>© 2023 ParadiseRP. Все права защищены.</p>
    <a href="https://www.youtube.com/watch?v=dQw4w9WgXcQ" target="_blank">Нажми на меня</a>
  </div>
</footer>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="monitor.js"></script>
    <script src="forms_message.js"></script>
    <!-- <div style="position: fixed; bottom: 0; margin-left: -10px; width: 100%; height: auto; background-color: rgba(0, 0, 0, 0.7); z-index: 1000;"> -->
    <!-- <div style="margin: 0 25px; display: flex; align-items: center; justify-content: space-between; padding: 10px 5px; color: white;"> -->
      <!-- <div style="width: 200px;">Про использование cookie</div> -->
      <!-- <div style="display: flex;"> -->
        <!-- <a class="button">Принять Cookie</a> -->
        <!-- <a onclick="acceptCookie()" class="button">Отклонить Cookie</a> -->
      <!-- </div> -->
    <!-- </div> -->
  <!-- </div> -->
</body>
<script>
    document.querySelector('.logo').addEventListener('click', function() {
      location.href = 'index.php'; // перенаправление на site copy.php при клике на логотип
    });
    document.querySelector('h3').addEventListener('click', function() {
      location.href = 'index.php'; // перенаправление на site copy.php при клике на логотип
    });
  </script>
  <script>
    $(document).ready(function() {
  $(window).scroll(function() {
    if ($(this).scrollTop() > 100) {
      $('.scroll-to-top').css('opacity', '1');
    } else {
      $('.scroll-to-top').css('opacity', '0');
    }
  });

  $('.scroll-to-top a').click(function(e) {
    e.preventDefault();
    $('html, body').animate({scrollTop: 0}, '300');
  });
});
</script>
<!-- <script> -->
    <!-- function acceptCookie() { -->
        <!-- var xhr = new XMLHttpRequest(); -->
        <!-- xhr.open("GET", "accept_cookie.php", true); -->
        <!-- xhr.onreadystatechange = function() { -->
            <!-- if (xhr.readyState === 4 && xhr.status === 200) { -->
                <!-- console.log(xhr.responseText); -->
            <!-- } -->
        <!-- } -->
        <!-- xhr.send(); -->
    <!-- } -->
<!-- </script> -->
</html>