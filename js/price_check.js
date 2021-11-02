$(function (){
    startLoading();
    $('.table').hide();
    const total = $('.category').length + $('.type').length;

    $('.category').each(function (){
       const category = $(this);
       var selected = '';
       $(this).find('li').each(function (){
           if ($(this).data('id') == category.data('id')){
               selected = $(this).html().split('<ul>')[0];
               return;
           }
       });
       category.find('ul').dropdown({
           toggleText: selected
       })
    });

    $('.type').each(function (){
        const type = $(this);
        var selected = '';
        $(this).find('li').each(function (){
            if ($(this).data('id') == type.data('id')){
                selected = $(this).text();
                return;
            }
        });
        type.find('ul').dropdown({
            toggleText: selected
        })
    });

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
        //считываем все динамические поля
        const price = [];
        const desc = [];
        $('tbody').find('tr').each(function (){
            price.push({id: $(this).data('id'), val: $(this).find('input').val()});
            desc.push({id: $(this).data('id'), val: $(this).find('textarea').val()});
            //console.log($(this.find('dropdown-text').last().text()));
        });
        //делаем запрос на сохранение информации о товаров
        $.ajax({
            method: "POST",
            url: "confirm.php",
            data: {
                user_id: $(this).data('id'),
                price,
                desc
            }
        }).done(function( response ) {
            if (response){
                //window.history.back();
                //window.location = document.referrer + '?succes=true';
            } else {
            }
        });
    })
    closeLoading();
    $('.table').show();
    $('.confirm_btn').removeClass('disabled', false);
})