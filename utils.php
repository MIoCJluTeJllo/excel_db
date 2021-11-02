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

//изменение размера с сохранением пропорций
function resizeImage($filename, $max_width, $max_height, $path, $ext)
{
    list($orig_width, $orig_height) = getimagesize($filename);

    $width = $orig_width;
    $height = $orig_height;

    # taller
    if ($height > $max_height) {
        $width = ($max_height / $height) * $width;
        $height = $max_height;
    }

    # wider
    if ($width > $max_width) {
        $height = ($max_width / $width) * $height;
        $width = $max_width;
    }

    $image_p = imagecreatetruecolor($width, $height);

    if (in_array($ext, ['jpg', 'jpeg'])){
        $image = imagecreatefromjpeg($filename);

        imagecopyresampled($image_p, $image, 0, 0, 0, 0,
            $width, $height, $orig_width, $orig_height);

        imagejpeg($image_p, $path);
    }
    if ($ext == 'png'){

        $background = imagecolorallocate($image_p , 0, 0, 0);

        imagecolortransparent($image_p, $background);
        imagealphablending($image_p, false);
        imagesavealpha($image_p, true);

        $image = imagecreatefrompng($filename);
        imagecopyresampled($image_p, $image, 0, 0, 0, 0,
            $width, $height, $orig_width, $orig_height);

        imagepng($image_p, $path);
    }
}

function psw_generate(
    int $length = 8,
    string $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'
): string {
    if ($length < 1) {
        throw new \RangeException("Length must be a positive integer");
    }
    $pieces = [];
    $max = mb_strlen($keyspace, '8bit') - 1;
    for ($i = 0; $i < $length; ++$i) {
        $pieces []= $keyspace[random_int(0, $max)];
    }
    return implode('', $pieces);
}