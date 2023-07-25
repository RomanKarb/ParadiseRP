<!DOCTYPE html>
<html>
<head>
  <title>Сайт по Minecraft</title>
  <style>
    body {
      background-image: url('Без имени-2.png');
      background-repeat: no-repeat;
      background-size: cover;
      position: relative;
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
    
    .blur-background {
      position: fixed;
      top: -50%;
      left: -50%;
      right: -50%;
      bottom: -50%;
      background-image: url('Без имени-2.png');
      background-repeat: no-repeat;
      background-size: cover;
      filter: blur(20px);
      z-index: -1;
      pointer-events: none;
      user-select: none;
    }
    
    .button {
      margin-top: 20px;
      padding: 10px 20px;
      background-color: #4CAF50;
      color: white;
      border: none;
      text-decoration: none;
      font-size: 16px;
    }
  </style>
  
</head>
<body>
  <div class="blur-background"></div>
  <div class="content">
    <h1>Это сайт по Minecraft</h1>
    <a href="#" class="button">Войти</a>
    <h1>Это сайт по Minecraft</h1>
    <a href="#" class="button">Войти</a>
    <h1>Это сайт по Minecraft</h1>
    <a href="#" class="button">Войти</a>
    <h1>Это сайт по Minecraft</h1>
    <a href="#" class="button">Войти</a>
    <h1>Это сайт по Minecraft</h1>
    <a href="#" class="button">Войти</a>
    <h1>Это сайт по Minecraft</h1>
    <a href="#" class="button">Войти</a>
    <h1>Это сайт по Minecraft</h1>
    <a href="#" class="button">Войти</a>
    <h1>Это сайт по Minecraft</h1>
    <a href="#" class="button">Войти</a>
    <h1>Это сайт по Minecraft</h1>
    <a href="#" class="button">Войти</a>
  </div>

</body>
</html>