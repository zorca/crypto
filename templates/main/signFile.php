<section class="blog-details-section">
    <h5 class="text-center text-success">
        2 Подпись файла
    </h5>
    <div class="blog-details-text">
        <p class="text-info">
            Для подписания файлов и сообщений необходимо знать id ($id) пользователя в текущем сервисе<br/>
            <i class="text-danger">
                Подпись файла или сообщения занимает значительное время в зависимости от объёма данных.
            </i>
        </p>
        <p>
            Для подписи файла необходимо отправить <i class="text-info">POST</i> запрос
            <i class="text-info">multipart/form-data</i> по адресу <a class="text-success"><?php echo $url ?>
                sign/file?user_id=$id</a><br/>
            Тело запроса должно иметь 1 поле формы <i class="text-success">file</i>
        <p>
            <i>
                В поле <i class="text-success">file</i> должен находится файл который необходимо подписать<br/>
            </i>
            <br/>
            В случае успеха в ответе вернется json объект с сылками для скачивания необходимых данных
            <br/>
            <i class="text-success">Пример :</i><br/>
            <code>
                {
        <p style="padding-left: 40px;">
            "hash": "<?php echo $url ?>load/RxjYpWIMLxOrg4E71Ghzi05B95sGj3Jgij",<br/>
            "crypt": "<?php echo $url ?>load/R9uokctauLBQMjLuRt48xbDZs9jfoDz8Gfsm",<br/>
            "file": "<?php echo $url ?>load/8NKXHvWWYysTEOwId8YIGu7ikeTIjiR",<br/>
            "sgn": "<?php echo $url ?>load/5w4bChtQ5883BAlxdCqEkg9e7sDXQfwWlE9gXpr",<br/>
            "msg": "<?php echo $url ?>load/CXprCdD6P7T1ZjiRiz124LelYbOCVgfXk8z",<br/>
            "sig": "<?php echo $url ?>load/uquFQl7UcSSgY4idWscE265fEIPPoeFa8X"
        </p>
        }
        </code>
        <?php $message = 'отправленый для подписи'; ?>
        </p>
        <?php include 'anatation.php'; ?>
    </div>
</section>
