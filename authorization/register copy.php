<?php
if(isset($_COOKIE['login_log_roshkam'])) {
    header('Location:login.php');
}

require_once('detect_lang.php');

if(isset($_GET['referal_id'])) {
    $referal_id = $_GET['referal_id'];
    
    $db = new mysqli('localhost', 'root', '', 'LocalUsersTest');
    $result = $db->query("SELECT username FROM users WHERE my_referal_id = '$referal_id'");
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $referal_id_on = '<h3>' . $translations['You join:'] . $row['username'] . '</h3>';
        setcookie("referal_pre_reg", $referal_id, time()+3600);
    } else {
        $referal_id_on = "";
        setcookie("referal_pre_reg", $referal_id, time()+3600);
    }
}

?>
<!DOCTYPE html>
<html>
<head>
 <title><?php echo $translations['Registration'] ?></title>
 <meta charset="UTF-8">
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
        color: #000000;
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
            margin-bottom: -20px;
            margin-top: -10px;
            text-align: center;
        }
        h3 {
            color: grey;
            font-size: 24px;
            margin-bottom: 20px;
            text-align: center;
        }
				        p {
            color: #2c3e50;
			font-family: Arial;
            font-size: 22px;
            margin-bottom: 1px;
            text-align: left;
        }
        input[type=text] {
            font-size: 16px;
            padding: 10px 20px;
            border-radius: 3px;
            border: 1px solid #CCCCCC; /* добавляем серую рамку */
            margin-bottom: 10px;
            width: calc(100% - 42px); /* вычитаем размер кнопки */
            background-color: #f2f2f2;
            border-radius: 10px;
			margin-bottom: -5px;
        }
        input[type=password],
        input[type=email]		{
            font-size: 16px;
            padding: 10px 20px;
            border-radius: 3px;
            border: 1px solid #CCCCCC; /* добавляем серую рамку */
            margin-bottom: 10px;
            width: calc(100% - 42px); /* вычитаем размер кнопки */
            background-color: #f2f2f2;
            border-radius: 10px;
			margin-bottom: 0px;
        }
        input[type=password1]		{
            font-size: 16px;
            padding: 10px 20px;
            border-radius: 3px;
            border: 1px solid #CCCCCC; /* добавляем серую рамку */
            margin-bottom: 10px;
            width: calc(100% - 42px); /* вычитаем размер кнопки */
            background-color: #f2f2f2;
            border-radius: 10px;
			margin-bottom: 35px;
        }
    input[type=submit] {
        font-size: 16px;
        padding: 10px 100px;
        border-radius: 3px;
        border: none;
        margin-bottom: 10px;
        width: 100%;
        background-color: #2c3e50;
        color: #fff;
        transition: all 0.3s ease;
        cursor: pointer;
		border-radius: 10px;
        margin-top: 1vh;
    }
    input[type=submit]:hover {
        background-color: #3498db;
    }
 </style>
</head>
<body>
 <div class="form-group">
 <form method="POST" action="reg_code.php<?php
   if(isset($_GET['redirect_url'])) {
     $redirect_url = $_GET['redirect_url'];
   echo '?redirect_url=' . $redirect_url; 
   }
   ?>">
   <h2><?php echo $translations['Registration'] ?></h2>
   <?php echo $referal_id_on ?>
   <p for="login"><?php echo $translations['Username'] ?> *</p>
   <input type="text" name="login" placeholder="<?php echo $translations['Enter username'] ?>" required pattern="^[^!@#$%^&*()_+={}[\]|\\:;&quot;&lt;&gt;?/~`]*$">
   <p for="email"><?php echo $translations['Email'] ?> *</p>
   <input type="email" name="email" placeholder="<?php echo $translations['Enter email'] ?>" required pattern="^[^!#$%^&*()_+={}[\]|\\:;&quot;&lt;&gt;?/~`]*$">
   <p for="first_name"><?php echo $translations['First name'] ?> *</p>
   <input type="text" name="first_name" placeholder="<?php echo $translations['Enter first name'] ?>" required pattern="^[^!@#$%^&*()_+={}[\]|\\:;&quot;&lt;&gt;,.?/~`]*$">
   <p for="last_name"><?php echo $translations['Last name'] ?></p>
   <input type="text" name="last_name" placeholder="<?php echo $translations['Enter last name'] ?>" pattern="^[^!@#$%^&*()_+={}[\]|\\:;&quot;&lt;&gt;,.?/~`]*$">
   <p for="password"><?php echo $translations['Password'] ?> *</p>
   <input type="password" name="password" placeholder="<?php echo $translations['Enter password'] ?>" required pattern="^[^#^&{}\\\;&quot;&lt;&gt;?/`]">
   <p for="password_confirmation"><?php echo $translations['Confirm password'] ?> *</p>
   <input type="password"  name="password_confirmation" placeholder="<?php echo $translations['Confirm password'] ?>" required pattern="^[^#^&{}\\\;&quot;&lt;&gt;?/`]">
   <input type="submit" name="register" value="<?php echo $translations['Registration'] ?>">
    <?php
    if (isset($_GET['error'])) {
        $error = $_GET['error'];
        if ($error == 'password') {
            echo "<p class='error'>".$translations['Passwords do not match']."</p>";
      header("Location: messages.php?message=".$translations['Passwords do not match']."&color=red&color_form=white&title=".$translations['Passwords do not match']."");
        }
    }
    ?>
  </form>
 </div>
</body>
</html>