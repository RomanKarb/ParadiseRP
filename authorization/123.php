<html>
<body>

<?php
// проверить наличие параметра kills в GET запросе
if (isset($_GET['kills'])) {

    // код, выполняющийся только для параметра kills
    $lok = $_GET['kills'];
    echo '<h2>Lok' . $lok . '</h2>';

} elseif (isset($_GET['boomer'])) {

    // код, выполняющийся только для параметра boomer
    $losk = $_GET['boomer'];
    echo '<h2>Losk' . $losk . '</h2>';
    echo '<form action="ask.php"><button>Send</button></form>';

} else {
    // код, выполняющийся при любом другом GET запросе
    echo 'Передайте параметр kills или boomer в GET запросе';
}
?>

</body>
</html>