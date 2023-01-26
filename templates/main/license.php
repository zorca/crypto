<section class="blog-details-section">
    <h5 class="text-center text-success">
        6 Лицензия
    </h5>
    <div class="blog-details-text">
        <p>
            Для просмотра лицензии необходимо отправить <i class="text-info">GET</i> запрос
            по адресу <a href="<?php echo $url ?>view/license" class="text-success"><?php echo $url ?>
                view/license</a><br/>
        <p>
            <br/>
            В случае успеха в ответе вернется json объект с данными об установленой лицензии
            <br/>
            <i class="text-success">Пример :</i><br/>
            <code>
                {
        <p style="padding-left: 40px;">
            "license": "5050010037ELQF5H28KM8E6BA",<br/>
            "expires": "66 day(s)",<br/>
            "type": "Demo"
        </p>
        }
        </code>
        </p>
    </div>
    <div class="blog-details-text">
        <p>
            Для установки новой лицензии необходимо отправить <i class="text-info">POST</i> запрос
            по адресу <a class="text-success"><?php echo $url ?>set/license</a><br/>
            Тело запроса должно иметь 1 поле формы <i class="text-success">license</i>
        <p>
            <i>
                В поле <i class="text-success">license</i> должен находится текст лицензионного ключа<br/>
            </i>
            <br/>
            В случае успеха в ответе вернется json объект с данными об установленой лицензии
            <br/>
            <i class="text-success">Пример :</i><br/>
            <code>
                {
        <p style="padding-left: 40px;">
            "license": "5050T80000017A6YGRZUUTVXT",<br/>
            "expires": "license - permanent",<br/>
            "type": "Client"
        </p>
        }
        </code>
        </p>
    </div>
</section>
