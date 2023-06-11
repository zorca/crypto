<!DOCTYPE html>
<html lang="zxx">

    <head>
        <meta charset="UTF-8">
        <meta name="description" content="Sona Template">
        <meta name="keywords" content="Sona, unica, creative, html">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Crypto-Pro API</title>

        <!-- Google Font -->
        <link href="/assets/https://fonts.googleapis.com/css?family=Lora:400,700&display=swap" rel="stylesheet">
        <link href="/assets/https://fonts.googleapis.com/css?family=Cabin:400,500,600,700&display=swap" rel="stylesheet">

        <!-- Css Styles -->
        <link rel="stylesheet" href="/assets/css/bootstrap.min.css" type="text/css">
        <link rel="stylesheet" href="/assets/css/font-awesome.min.css" type="text/css">
    </head>

    <body>

        <section class="blog-details-section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-10">
                        <div class="text-center">
                            <h2>Инструкция по использованию сервиса Крипто-Про API</h2>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div class="container">
            <div class="row tab-pane">
                <h3>Понятия сущностей сервиса</h3>
            </div>
            <section class="blog-details-text">
                <ul>
                    <li>
                        Сертификат пользователя - это файл сертификата,
                        выданный определенным уполномоченным органом.
                        Как правило имеет расширение .cer
                    </li>
                    <li>
                        Ключевой контейнер - это каталог в котором содержится 6 файлов .key .
                        <p class="text-success">
                            Имеет уникальное имя и может распологаться как на машине пользователя
                            так и на внешнем носителе (токен, usb-flash накопитель, дискета и т.п.).<br/>
                            <i class="text-danger">
                                Важно !!! ключевой контейнер должен быть импортируемым
                            </i>
                        </p>
                    </li>
                    <li>
                        $id - значение идентификатора нового пользователя в системе
                        <p class="text-success">
                            Присваивается в поле id объекта при установки сертификата и ключевого контейнера
                        </p>
                    </li>
                </ul>
            </section>
            <?php include_once "setContainer.php"; ?>
            <?php include_once "signFile.php"; ?>
            <?php include_once "signMessage.php"; ?>
            <?php include_once "extractFile.php"; ?>
            <?php include_once "extractMessage.php"; ?>
            <?php include_once "license.php"; ?>
            <?php include_once "request.php"; ?>
        </div>
    </body>

</html>
