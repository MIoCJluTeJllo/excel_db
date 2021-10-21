$(function (){
    //запрос удаления поля из таблицы подтверждения
    $('.delete_btn').click(function (){
        const self = $(this);
        $.ajax({
            method: "POST",
            url: "remove_row.php",
            data: {
                'delete_id': $(this).data('id')
            },
        }).done(function( response ) {
            if (response){
                console.log(response);
                //анимация удаления
                self.closest('tr').fadeOut(800,function(){
                    $(this).remove();
                });
            }
        });
    })

    //запрос подтверждения таблицы
    $('.confirm_btn').click(function (){
        //считываем все выбранные категории товаров
        const categories = [];
        $('.category_select').each(function (){
            categories.push({id: $(this).data('id'), val: $(this).val()});
        })
        //считываем все выбранные типы товаров
        const types = [];
        $('.type_select').each(function (){
            types.push({id: $(this).data('id'), val: $(this).val()});
        })
        //делаем запрос на сохранение информации о товаров
        $.ajax({
            method: "POST",
            url: "confirm.php",
            data: {
                user_id: $(this).data('id'),
                categories: categories,
                types: types
            }
        }).done(function( response ) {
            if (response){
                //console.log(response);
                window.history.back();
                //alert(document.referrer);
                //window.location = document.referrer + '?succes=true';
            } else {
                alert('Не все данные корректны');
            }
        });
    })
})