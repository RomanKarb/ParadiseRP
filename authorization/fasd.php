<?php
// Получаем текущее значение темы оформления
$user_theme = 'light';

// Формируем JavaScript код
echo "<script src=\"https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js\"></script><script>
    let userTheme = '".$user_theme."';

    if(window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
        userTheme = 'dark';
    }

    $.ajax({
        method: 'POST',
        url: 'update_user_theme.php',
        data: { userTheme: userTheme }
    }).done(function( msg ) {
        console.log( 'User theme updated: ' + msg );
    });
</script>";

// Получаем значение переменной "userTheme" на сервере
$user_theme = isset($_POST['userTheme']) ? $_POST['userTheme'] : $user_theme;
echo $user_theme;
?>