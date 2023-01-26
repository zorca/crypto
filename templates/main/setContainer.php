<section class="blog-details-section">
    <h5 class="text-center text-success">
        1 Установка сертификата и ключевого контейнера
    </h5>
    <div class="blog-details-text">
        <p>
            Для установки сертификата и ключевого контейнера необходимо иметь:
        </p>
        <ul>
            <ol>
                1.1 Заархивированый в zip архив ключевой контейнер.
                <p class="text-danger">
                    Заархивировать необходимо сам каталог вместе со
                    всем содержимым а не только содержимое,
                    так как сертификат связан с контейнером по его наименованию
                </p>
            </ol>
            <ol>
                1.2 Наличие самого файла сертификата в формате .cer
                <p class="text-success">
                    (сертификат в формате base64 или der)
                </p>
            </ol>
            <i>
                Дополнительная информация
            </i>
            <p class="text-success">
                Если сертификат и контейнер находятся на внешнем токене, то необходимо
                установить сертификат и импортировать ключевой контейнер на клиентскую машину.
                Далее найти на клиентской машине каталог с ключевым контейнером и выполнить пункт 1.1
                После этого импортировать сертификат из ключевого котейнера на клиентской машине
                в соответствии с пунктом 1.2
            </p>
        </ul>
        <p>
            Установка сертификата и ключевого контейнера на текущем сервисе:
        </p>
        <p>
            Для установки сертификата и ключевого контейнера необходимо отправить <i class="text-info">POST</i> запрос
            <i class="text-info">multipart/form-data</i> по адресу <a class="text-success"
                                                                      href="<?php echo $url ?>set/container"><?php echo $url ?>
                set/container</a><br/>
            Тело запроса должно иметь 2 поля формы <i class="text-success">container</i> и <i class="text-success">certificate</i>
        <p>
            <i>
                В поле container должен находится архив ключевого контейнера удовлетворяющий требованиям пункта 1.1<br/>
                В поле certificate должен находится сертификат удовлетворяющий требованиям пункта 1.2
            </i>
            <br/>
            В случае успеха в ответе вернется json объект с информацией о новом пользователе
            <br/>
            <i class="text-success">Пример :</i><br/>
            <code>
                {
        <p style="padding-left: 40px;">
            "id": "1",<br/>
            "uid": "dd4b5f0d-b493-0d30-d5a9-7464fe924e4c",<br/>
            "data": "C=RU, S=77 Московская ОБЛ., L=Г. Москва, STREET=\"ул Новая, Д. 157/1, ОФИС 215\", O=\"ООО УК
            \"\"Ромашка\"\"\", CN=\"ОБЩЕСТВО С ОГРАНИЧЕННОЙ ОТВЕТСТВЕННОСТЬЮ УПРАВЛЯЮЩАЯ КОМПАНИЯ \"\"Ромашка\"\"\",
            G=Иван Иванович, SN=Иванов, T=ГЕНЕРАЛЬНЫЙ ДИРЕКТОР, СНИЛС=11061945520, ОГРН=1175476116420, ИНН
            ЮЛ=5410071220, ИНН=540411037983",<br/>
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
            "thumbprint": "18d26b0890b0c9a11e026f3442e08d8b251c4edf",<br/>
            "email": null,<br/>
            "container": "\\\\.\\HDIMAGE\\67ea0ff7-b8e2-a07d-b63c-ed072f64af6c",<br/>
            "date_create": "2022-09-29 09:22:54",<br/>
            "date_update": "2022-09-29 09:22:54"
        </p>
        }
        <br/>
        </code>
        </p>
        На клиентской стороне необходимо сохранить id (далее $id) нового пользователя для возможности дальнейшей работы
        с текущим сервисом
        </p>
    </div>
</section>
