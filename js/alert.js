//блок для сообщения об ошибке или успехе
const msg_block = $('.get_error');

//показать сообщение
const sendMsg = (text, error) => {
    if (error){
        msg_block.removeClass('alert-success');
        msg_block.addClass('alert-danger');
    } else {
        msg_block.addClass('alert-success');
        msg_block.removeClass('alert-danger');
    }
    msg_block.empty();
    msg_block.append(text);
    msg_block.show();
}

//скрыть сообщение
const closeMsg = () => msg_block.hide();