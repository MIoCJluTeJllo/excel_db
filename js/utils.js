//проверка является ли строка ненулевым целым числом
const isInt = (text) => /^[1-9]\d*$/.test(text);

//проверка является ли строка целым числом
const isNumber = (text) => /^[0-9]+$/.test(text);

//проверка является ли строка ненулевыми целыми числами через запятую (без пробела)
const isCommaNums = (text) => /^([1-9]\d*(,[1-9]\d*)*)$/.test(text);

//валидация полей на ненулевое целое число
const checkInt = (fields) => {
    var valid = true;
    fields.forEach((field) => {
        if (!isInt(field.val())){
            field.addClass('no_valid');
            valid = false;
        }
    })
    return valid;
}

//валидация значения поля описания
const checkDesc = (desc_field) => {
    if (!isCommaNums(desc_field.val())){
        desc_field.addClass('no_valid');
        return false
    }
    return true;
}

//валидация значения поля id
const checkId = (id_field) => {
    if (!isInt(id_field.val())){
        id_field.addClass('no_valid');
        return false
    }
    return true;
}

//валидация значения поля файла
const checkFile = (file_field) => {
    if (!file_field.val()){
        file_field.addClass('no_valid');
        return false
    }
    return true;
}