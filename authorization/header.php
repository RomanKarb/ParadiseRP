<style>    .header {
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
    
  }
  .logo {
    margin-top: 5px;
    width: 70px;
    height: 50px;
    background-image: url('/logo.png');
    background-repeat: no-repeat;
    background-size:contain;
    cursor: pointer; /* добавляем стиль указателя при наведении */
  }

  h4 {
    left: 80px;
    position: absolute;
    font-size: 30px;
    font-family: Arial, Helvetica, sans-serif;
    cursor: pointer;
  }

  .buttons-head {
    display: flex;
    align-items: center;
    justify-content: flex-end;
    width: calc(100% - 50px);
  }

  .button-head {
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
  
  .button-head:hover {
    font-size: 19px;
  }</style>
  <meta charset="utf-8">
<div class="header">
    <div class="header-content">
      <div class="logo"></div>
      <h4>ParadiseRP</h4>
      <div class="buttons-head">
        <a href="#" class="button-head">Донат</a>
        <a href="#" class="button-head">Информация</a>
        <!-- <a href="javascript:history.back()" class="button-head">Вернуться</a> -->
      </div>
    </div>
  </div>
  <script>
    document.querySelector('.logo').addEventListener('click', function() {
      location.href = '/index.php'; // перенаправление на site copy.php при клике на логотип
    });
    document.querySelector('h4').addEventListener('click', function() {
      location.href = '/index.php'; // перенаправление на site copy.php при клике на логотип
    });
  </script>