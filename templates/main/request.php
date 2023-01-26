<section class="blog-details-section">
    <h5 class="text-center text-success">
        7 Создание запроса на выдачу сертификата
    </h5>
    <div class="blog-details-text">

        <p>
            Для создание запроса на выдачу сертификата необходимо отправить <i class="text-info">PUT</i> запрос
            по адресу <a class="text-success"><?php echo $url ?>create/request</a><br/>
            В теле запроса должен лежать корректный json объект <i class="text-success">file</i>
        <p>
            <code>
                {
        <p style="padding-left: 40px;">
            "country": "RU",<br/>
            "region": "77 Московская ОБЛ.",<br/>
            "city": "Г. Москва",<br/>
            "street": "ул Новая",<br/>
            "name_company": "\"ООО УК \"\"Ромашка\"\"\"",<br/>
            "full_name_company": "\"ОБЩЕСТВО С ОГРАНИЧЕННОЙ ОТВЕТСТВЕННОСТЬЮ УПРАВЛЯЮЩАЯ КОМПАНИЯ
            \"\"Ромашка\"\"\"",<br/>
            "name": "Иван Иванович",<br/>
            "last_name": "Иванов",<br/>
            "official": "ГЕНЕРАЛЬНЫЙ ДИРЕКТОР",<br/>
            "snils": "11061365520",<br/>
            "ogrn": "1175477616420",<br/>
            "inn": "540411987983",<br/>
            "email": "vasy@new.com",<br/>
        </p>
        }
        </code>
        <br/>
        В случае успеха в ответе вернется json объект с сылками для скачивания необходимых данных
        <br/>
        <i class="text-success">Пример :</i><br/>
        <code>
            {
            <p style="padding-left: 40px;">
                "request": "http://51.250.97.26/load/O7mwOfvcV7gTIZhaoNNYg2RVZ9fFN9PCGX",<br/>
                "container": "http://51.250.97.26/load/C9CJuMKSzZc5VkCiIuijQKie8HSaQt"<br/>
            </p>
            }
        </code>
        </p>
        В свойстве request лежит ссылка на сам запрос для выдачи сертификата<br/>
        В свойстве container лежит ссылка на архив с ключами будущего сертификата<br/>
    </div>
</section>