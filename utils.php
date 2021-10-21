<?php
//валидация полей по разрешенным символам и допустимому размеру
function format_str($str, $size){
    $pattern = '/[a-zA-Z0-9А-Яа-я\s:.,-_""\\/]+/u';
    preg_match_all($pattern, $str, $matches);
    if (!empty($matches)){
        return mb_substr(implode(' ', $matches[0]), 0, $size, "utf-8");
    }
}

//опеределение типа или категории по имение
function contains($arr, $str){
    foreach ($arr as $obj){
        $str_lower = mb_strtolower($str, 'utf-8');
        $keys_lower = mb_strtolower($obj->getKeys(), 'utf-8');
        if ($keys_lower and str_contains($str_lower, $keys_lower)){
            return $obj;
        }
    }
}

//получение изображения по url
function file_get_contents_curl($url) {
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $url);

    $data = curl_exec($ch);
    curl_close($ch);

    return $data;
}