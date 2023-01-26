<section class="blog-details-section">
    <h5 class="text-center text-success">
        3 Подпись сообщения
    </h5>
    <div class="blog-details-text">
        <p class="text-info">
            Для подписания сообщений и запросов необходимо знать id ($id) пользователя в текущем сервисе<br/>
            <i class="text-danger">
                Подпись сообщения или запроса занимает значительное время в зависимости от объёма данных.
            </i>
        </p>
        <p>
            Для подписи сообщения необходимо отправить <i class="text-info">POST</i> запрос
            по адресу <a class="text-success"><?php echo $url ?>sign/message?user_id=$id</a><br/>
            Тело запроса должно иметь 1 поле формы <i class="text-success">message</i>
        <p>
            <i>
                В поле <i class="text-success">message</i> должен находится текст сообщения который необходимо подписать<br/>
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
        <?php $message = 'содержащий тело запроса отправленного для подписи'; ?>
        </p>
        <?php include 'anatation.php'; ?>
    </div>
</section>
