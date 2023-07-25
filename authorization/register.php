<?php
if(isset($_COOKIE['login_log_roshkam'])) {
    header('Location:login.php');
}

require_once('detect_lang.php');
require_once('theme.php');

if(isset($_GET['referal_id'])) {
    $referal_id = $_GET['referal_id'];
    
    $db = new mysqli('localhost', 'root', '', 'LocalUsersTest');
    $result = $db->query("SELECT username FROM users WHERE my_referal_id = '$referal_id'");
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $referal_id_on = '<h3>' . $translations['You join:'] . " " .  $row['username'] . '</h3>';
        setcookie("referal_pre_reg", $referal_id, time()+6600);
    } else {
        $referal_id_on = "";
        setcookie("referal_pre_reg", $referal_id, time()+6600);
    }
}

?>
<!DOCTYPE html>
<html>
<head>
 <title><?php echo $translations['Registration'] ?> - ParadiseRP</title>
 <meta charset="UTF-8">
 <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800'rel='stylesheet' type='text/css'>
 <?php include 'css/login-password.php'; ?>
 <script>
        function openFile() {
            window.location.href = "login<?php 
    if(isset($_GET['redirect_url'])) {
      $redirect_url = $_GET['redirect_url'];
    echo "?redirect_url=" . $redirect_url; }
    ?>";
        }
    </script>
 <!-- У shield.land -->
 <meta data-n-head="ssr" name="viewport" content="width=device-width, initial-scale=0.5">
    <meta data-n-head="ssr" data-hid="og:title" property="og:title" content="ParadiseRP">
    <meta data-n-head="ssr" data-hid="og:image" property="og:image" content="https://media.shield.land/other/og_image.png">
    <meta data-n-head="ssr" data-hid="description" name="description" content="ParadiseRP, это уникальный сервер Minecraft, посвященный Minecraft и сделан всего-лишь двумя лучшими друзьями">
    <meta data-n-head="ssr" data-hid="og:description" property="og:description" content="ParadiseRP, это уникальный сервер Minecraft, посвященный Minecraft и сделан всего-лишь двумя лучшими друзьями">
    <meta data-n-head="ssr" name="format-detection" content="telephone=no">
    <link data-n-head="ssr" rel="icon" type="image/x-icon" href="/logo.png">
    <link rel="shortcut icon" href="/logo.png" type="image/png">
</head>
<body>
<?php include 'header.php'; ?>
 <div class="form-group">
 <form method="POST" action="reg_code.php<?php
   if(isset($_GET['redirect_url'])) {
     $redirect_url = $_GET['redirect_url'];
   echo '?redirect_url=' . $redirect_url; 
   }
   ?>" onsubmit="return validateCaptcha()">
   <h2><?php echo $translations['Registration'] ?></h2>
   <?php echo $referal_id_on ?>
   <div class="texts">
   <p for="login"><?php echo $translations['Username'] ?> *</p>
   <input type="text" name="login" placeholder="<?php echo $translations['Enter username'] ?>" required pattern="[^<>'?#&@\s]*">
   <p for="email"><?php echo $translations['Email'] ?> *</p>
   <input type="email" name="email" placeholder="<?php echo $translations['Enter email'] ?>" required pattern="^[^!#$%^&*()={}[\]|\\:;&quot;&lt;&gt;?/~`]*$">
   <p for="first_name"><?php echo $translations['First name'] ?> *</p>
   <input type="text" name="first_name" placeholder="<?php echo $translations['Enter first name'] ?>" required pattern="^[^!@#$%^&*()_+={}[\]|\\:;&quot;&lt;&gt;,.?/~`]*$">
   <!-- <p for="last_name"><?php echo $translations['Last name'] ?></p> -->
   <!-- <input type="text" name="last_name" placeholder="<?php echo $translations['Enter last name'] ?>" pattern="^[^!@#$%^&*()_+={}[\]|\\:;&quot;&lt;&gt;,.?/~`]*$"> -->
   <p for="password"><?php echo $translations['Password'] ?> *</p>
   <input type="password" name="password" placeholder="<?php echo $translations['Enter password'] ?>" required pattern="[&{}\\\;&quot;&lt;&gt;?/`]">
   <p for="password_confirmation"><?php echo $translations['Confirm password'] ?> *</p>
   <input type="password"  name="password_confirmation" placeholder="<?php echo $translations['Confirm password'] ?>" required pattern="[&{}\\\;&quot;&lt;&gt;?/`]">
   </div>
   <button style="margin-top: 10px;" type="submit" name="register"><?php echo $translations['Registration'] ?></button>
   <div class="g-recaptcha" data-sitekey="6LdGfSonAAAAAHkhqSolPi5Bp34MyyjW-7Xyn-OZ"></div>
   <div class="div-discord-group" style="cursor: pointer;">
        <div class="div-discord" onclick="location.href = 'discord-auth.php'" style="cursor: pointer;">
        <img src="/img/discord-icon.png" alt="Discord icon" class="discord-icon">
  <span class="span-discord"><?php echo $translations['Registration via Discord'] ?></span>
</div>
</div>
    <?php
    if (isset($_GET['error'])) {
        $error = $_GET['error'];
        if ($error == 'password') {
            echo "<p class='error'>".$translations['Passwords do not match']."</p>";
      header("Location: messages.php?message=".$translations['Passwords do not match']."&color=red&color_form=white&title=".$translations['Passwords do not match']."");
        }
    }
    ?>
            <div class="centered-div">
    <h5><?php echo $translations['Already registered?'] ?></h5>
    <h6 onclick="openFile()"><?php echo $translations['Log in'] ?></h6>
</div>
  </form>
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script>
        function validateCaptcha() {
            if (grecaptcha.getResponse().length === 0) {
                alert('<?php echo $translations['Enter captcha'] ?>.');
                return false;
            }
            return true;
        }
    </script>
 </div>
</body>
</html>