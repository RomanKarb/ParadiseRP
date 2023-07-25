<?php 
require_once('detect_lang.php');
?>
<!DOCTYPE html>
<html lang="<?php echo $user_language ?>">
<head>
    <meta charset="UTF-8">
    <title><?php echo $translations['Password recovery'] ?></title>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800'rel='stylesheet' type='text/css'>
    <style>
        body {
            background: linear-gradient(to bottom right, #3498db, #2c3e50);
            font-family: Arial, sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            margin: 0;
        }
    form {
        width: 100%;
        max-width: 400px;
        background-color: #fff;
        border-radius: 25px;
        padding: 60px;
        box-shadow: 0px 0px 10px rgba(0,0,0,0.25);
    }
        h2 {
            color: #2c3e50;
            font-size: 24px;
            margin-bottom: 20px;
      text-align: center;
        }
    input[type=email] {
        display: block;
        width: calc(100% - 42px); /* вычитаем размер кнопки */
        padding: 10px 20px;
        font-size: 16px;
        color: #555;
        border: 1px solid #ddd;
        border-radius: 3px;
        margin-bottom: 10px;
        background-color: #f2f2f2;
    border-radius: 10px;
    }
        button[type=submit] {
            font-size: 16px;
            padding: 10px 20px;
            border-radius: 3px;
            border: none;
            margin-bottom: 10px;
            width: 100%;
        }
        button[type=submit] {
            background-color: #2c3e50;
            color: #fff;
            transition: all 0.3s ease;
            cursor: pointer;
              border-radius: 10px;
        }
        button[type=submit]:hover {
            background-color: #3498db;
        }

    </style>
</head>
<body>
    <form action="res_pass.php<?php 
    if(isset($_GET['redirect_url'])) {
      $redirect_url = $_GET['redirect_url'];
    echo "?redirect_url=" . $redirect_url; }
    ?>" method="post" onsubmit="return validateCaptcha()">
        <h2><?php echo $translations['Password recovery'] ?></h2>
        <div class="form-group">
            <label for="email"><?php echo $translations['Email address used during registration:'] ?></label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <button type="submit" class="btn btn-primary" name="reset_password"><?php echo $translations['Recover password'] ?></button>
        <div class="g-recaptcha" data-sitekey="6LdGfSonAAAAAHkhqSolPi5Bp34MyyjW-7Xyn-OZ"></div>
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
</body>
</html> 
