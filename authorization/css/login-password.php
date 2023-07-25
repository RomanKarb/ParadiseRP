<style>
        body {
            background-image: url('/backround.png');
            background-repeat: no-repeat;
            background-size:cover;
            position: relative;
            font-family: Arial, sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            margin: 0;
            z-index: -100;
            overflow-y: scroll;
        }
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
	.g-recaptcha {
		margin-left: 10 px;
		margin-bottom: 10px;
	}
    form {
    width: 45vh;
    max-width: 550px;
    background: <?php echo $used_theme['form-background'] ?>;
    border-radius: 25px;
    padding: 60px;
    box-shadow: 0px 0px 10px rgba(0,0,0,0.25);
}
.form-group-1 {
    margin-bottom: 20px;
}
        h2 {
            color: <?php echo $used_theme['h2-color'] ?>;
            font-size: 24px;
            margin-bottom: -20px;
            margin-top: -10px;
            text-align: center;
        }
        h3 {
            color: <?php echo $used_theme['h2-color'] ?>;
            font-size: 24px;
            margin-bottom: 20px;
            text-align: center;
        }
		p {
            color: <?php echo $used_theme['p-color'] ?>;
			font-family: Arial;
            font-size: 22px;
            margin-bottom: 1px;
            text-align: left;
        }
        input[type=text] {
            font-size: 16px;
            padding: 10px 20px;
            border-radius: 3px;
            border: <?php echo $used_theme['input-type-text-border'] ?>; /* добавляем серую рамку */
            margin-bottom: 10px;
            width: 100%;
            /* width: calc(100% - 42px); вычитаем размер кнопки */
            background-color: <?php echo $used_theme['input-type-text-backround'] ?>;
            border-radius: 10px;
			margin-bottom: 0px;
        }
        input[type=text1] {
            font-size: 16px;
            padding: 10px 20px;
            border-radius: 3px;
            border: <?php echo $used_theme['input-type-text-border'] ?>; /* добавляем серую рамку */
            margin-bottom: 10px;
            width: calc(100% - 42px); /* вычитаем размер кнопки */
            background-color: <?php echo $used_theme['input-type-text-backround'] ?>;
            border-radius: 10px;
			margin-top: 30px;
        }
        input[type=password],
        input[type=email] {
  font-size: 16px;
  padding: 10px 20px;
  border-radius: 3px;
  border: <?php echo $used_theme['input-type-text-border'] ?>; /* добавляем серую рамку */
  margin-bottom: 10px;
  width: 100%;
  /* width: calc(100% - 42px); вычитаем размер кнопки */
  background-color: <?php echo $used_theme['input-type-text-backround'] ?>;
  border-radius: 10px;
  margin-bottom: 0px;
}

.texts {
    width: calc(100% - 42px); /*вычитаем размер кнопки*/
}

        button[type=submit] {
            font-size: 16px;
            padding: 10px 20px;
            border-radius: 3px;
            border: none;
            margin-bottom: 10px;
            width: 100%;
        }
        a {
            color: <?php echo $used_theme['recovery-password'] ?>;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
        h5 {
            color: <?php echo $used_theme['recovery-password'] ?>;
            text-decoration:none;
            text-align: center;
            margin-top: 0px;
            font-size: 20px;
        }
        h6 {
            color: <?php echo $used_theme['recovery-password'] ?>;
            text-decoration:none;
            text-align: center;
            margin-top: -25px;
            cursor: pointer;
            font-size: 20px;
            margin-bottom: -10px;
        }
        h6:hover {
            text-decoration: underline;
        }
        button[type=submit] {
        font-size: 16px;
        padding: 10px 100px;
        border-radius: 3px;
        border: none;
        margin-bottom: 10px;
        width: 100%;
        background-color: <?php echo $used_theme['input-submit-backroud'] ?>;
        color: #fff;
        transition: all 0.3s ease;
        cursor: pointer;
		border-radius: 10px;
        margin-top: 1px;
    }
    button[type=submit]:hover {
        background-color: <?php echo $used_theme['hover-button-color'] ?>;
    }
    button[type=submit-discord] {
      font-size: 16px;
      padding: 10px 100px;
      border-radius: 3px;
      border: none;
      margin-bottom: 10px;
      width: 100%;
      background-color: <?php echo $used_theme['input-submit-backroud'] ?>;
      background-image: url("/img/discord-icon.png");
      background-position: right center;
      background-repeat: no-repeat;
      background-size: 30px 30px;
      color: #fff;
      transition: all 0.3s ease;
      cursor: pointer;
      border-radius: 10px;
      margin-top: 1px;
   }
   button[type=submit-discord]:hover {
      background-color: <?php echo $used_theme['hover-button-color'] ?>;
   }
   .discord-icon {
    position: absolute;
  width: 35px;
  height: 35px;
  margin-top: 4px;
  margin-left: 5px;
}
.vk-icon {
    position: absolute;
  width: 33px;
  height: 33px;
  margin-top: 4px;
  margin-left: 5px;
}
.span-discord {
    margin-top: 10px;
    position: absolute;
    margin-left: 42px;
    font-size: 18px;

    color: white;
}
.div-discord-group {
    background-color: <?php echo $used_theme['input-submit-backroud'] ?>;
    height: 41px;
    margin-bottom: 10px;
    border-radius: 10px;
    align-items: center;
    transition: all 0.3s ease;
}
.div-discord-group:hover {
    background-color: <?php echo $used_theme['hover-button-color'] ?>;
}
.div-discord {
    position:static;
    align-items: center;
}
    input[type=password1]		{
            font-size: 16px;
            padding: 10px 20px;
            border-radius: 3px;
            border: <?php echo $used_theme['input-type-text-border'] ?>; /* добавляем серую рамку */
            margin-bottom: 10px;
            width: calc(100% - 42px); /* вычитаем размер кнопки */
            background-color: <?php echo $used_theme['input-type-text-backround'] ?>b;
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
        background-color: <?php echo $used_theme['input-submit-backroud'] ?>;
        color: #fff;
        transition: all 0.3s ease;
        cursor: pointer;
		border-radius: 10px;
        margin-top: 10px;
    }
    input[type=submit]:hover {
        background-color: <?php echo $used_theme['hover-button-color'] ?>;
    }
        ::placeholder {
  color: <?php echo $used_theme['placeholder-color'] ?>; /* черный цвет подсказки */
}
</style>