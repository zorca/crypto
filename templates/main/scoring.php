
<section class="blog-details-section">
    <h5 class="text-center text-success">
        8 Скоринг клиента
    </h5>
    <div class="blog-details-text">
        <p>
            Для получения скоринга по клиенту необходимо отправить <i class="text-info">PUT</i> запрос
            по адресу <a class="text-success"><?php echo $url; ?>scoring/user</a><br/>
            Тело запроса должен лежать корректный json объект
        <p/>
        <i class="text-success">Пример :</i><br/>
        <code>
            {
            <div style="padding-left: 40px;">
                "last":"Иванов",<br/>
                "first":"Иван",<br/>
                "middle":"Иванович",<br/>
                "gender":9,<br/>
                "birthday":"01.01.1987",<br/>
                "doc":{
                <div style="padding-left: 40px;">
                    "serial":1234,<br/>
                    "number":567890,<br/>
                    "date":"01.01.2000"<br/>
                </div>
                }
            </div>
            }
        </code>
        <br/>
        В случае успеха в ответе вернется json объект с результатом скоринга от бюро
        <br/>
    </div>
</section>

