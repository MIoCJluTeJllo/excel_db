$(function (){
    //выбранный тип изображения
    var img_type_selected = $("input[name='img_type']:checked");
    img_type.change(function (){
        img_type_selected = $(this);
    })
    //делаем кнопку импорта данных неактивной
    price_import_btn.prop("disabled", true);

    //событие нажатия на кнопку получения данных
    get_data_btn.click(function () {
        //очищаем имя и email
        user_name.val('');
        user_email.val('');
        //делаем кнопку импорта неактивной
        price_import_btn.prop("disabled", true);

        //проверяем поле id
        if (isNumber(user_id.val())) {
            //скрываем сообщение
            closeMsg();
            //делаем ajax запрос
            $.ajax({
                method: "POST",
                url: "get_user_data.php",
                data: {user_id: user_id.val()},
                beforeSend: function () {
                    //делаем кнопку получения данных неактивной и показываем индикатор загрузки
                    get_data_btn.prop("disabled", true);
                    startLoading();
                }
            }).done(function (response) {
                //после получения данных
                setTimeout(function () {
                    //обрабатываем их
                    console.log(response)
                    const data = $.parseJSON(response);
                    if (data && data.user) {
                        //заполняем поля имя и email
                        user_name.val(data.user.name);
                        user_email.val(data.user.email);
                        //если так же есть данные прайса
                        if (data.price){
                            //заполняем все поля столбцов, полученные из данных о прайсе
                            name_column.val(data.price.num_title);
                            desc_columns.val(data.price.num_desc);
                            price_column.val(data.price.num_price);
                            start_row.val(data.price.num_str);
                        }
                        //делаем кнопку импорта активной
                        price_import_btn.prop("disabled", false);
                    } else {
                        sendMsg('Пользователь не найден', true);
                    }
                    //делаем кнопку получения данных активной и скрываем индикатор загрузки
                    get_data_btn.prop("disabled", false);
                    closeLoading();
                }, 300);
            });
        } else {
            sendMsg('ID должен быть целым числом', true);
        }
    })

    //при нажатии на любое поле убираем его метку о валидации
    $('input').click(function (){
        $(this).removeClass('no_valid');
    })

    //событие нажатия на кнопку импорта
    price_import_btn.click(function () {
        //набор полей с одинаковой валидацией
        const intColumns = [start_row, name_column, price_column];
        //если выбран типа изображения, добавляем поле столбца изображения в набор
        if (['img_type_img', 'img_type_url'].includes(img_type_selected.val())){
            intColumns.push(img_column);
        }

        //валидация полей
        var valid = true;
        if (!checkInt(intColumns)){
            valid = false;
        }
        if (!checkDesc(desc_columns)){
            valid = false;
        }
        if (!checkId(user_id)){
            valid = false;
        }
        if (!checkFile(price_list)){
            valid = false;
        }
        //при успешной валидации
        if (valid){
            //скрываем сообщение об ошибке
            closeMsg();
            //дополняем набор всеми оставшимися полями
            const fields = intColumns.concat(desc_columns, user_id, img_type_selected, img_column);
            //инициализируем данные для отправки на сервер
            var data = new FormData();
            fields.forEach((field) => data.append(field.attr("name"), field.val()));
            data.append('price_list', price_list.prop('files')[0]);
            //отправляем ajax запрос
            $.ajax({
                method: "POST",
                url: "price_import.php",
                data: data,
                contentType: false,
                processData: false,
                beforeSend: function(  ) {
                    //делаем кнопку импорта неактивной и показываем индикатор загрузки
                    price_import_btn.prop("disabled", true);
                    startLoading();
                }
            }).done(function( response ) {
                //после получения данных
                setTimeout(function() {
                    //показываем сообщении с ссылкой на таблицу данных
                    sendMsg(`<a href="price_check.php?user=${$('input[name="user_id"]').val()}" class="alert-link">Данные получены</a>`)
                    //покажем log
                    console.log(response);
                    //делаем кнопку импорта активной и скрываем индикатор загрузки
                    price_import_btn.prop("disabled", false);
                    closeLoading();
                }, 300);
            });
        }
        else {
            sendMsg('Проверьте значения полей', true);
        }
    })
})