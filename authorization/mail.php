<!DOCTYPE html>
    <html>
    <head>
        <meta charset="utf-8">
        <title>Почтовое письмо</title>
        <style>
            body {
                background-image: url(http://c9242780.beget.tech/backround.png);
                background-repeat: no-repeat;
                background-size: cover;
                font-family: Arial, sans-serif;
                max-height: 700px;
                align-items: center;
                border-radius: 20px;
            }
            
            .container {
                text-align: center;
                margin: 0 auto;
                font-size: 25px;
            }
            
            h2 {
                font-size: 50px;
                color: rgba(0, 0, 0, 0.75);
            }

            h3 {
                font-size: 50px;
                text-align: center;
                margin-bottom: 200px;
                color: rgba(0, 0, 0, 0.75);
            }
    
            .footer {
                text-align: center;
                font-size: 16px;
                margin-top: 200px;
            }

            p {
                font-size: 30px;
                text-align: center;
                color: rgba(0, 0, 0, 0.75); 
            }

            form {

                margin-left: calc(50% - 335px);
    width: 900px;
    max-width: 670px;
    background: white;
    border-radius: 25px;
    padding: 60px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.75);
}
        </style>
    </head>
    <body>
        <h3>ParadiseRP</h3>
        <!-- <form> -->
        <div class="container">
            <h1>Введите этот код на сайте:</h1>
            <h2>Код: <?php echo $code ?></h2>
        </div>
    <!-- </form> -->
        <div class="footer">
            <p>Сайт: www.ParadiseRP.fun, все права принадлежат \"Snr_RoSHkam\" и \"SnrKryak\"</p>
        </div>
    </body>
    </html>