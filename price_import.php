<?php
    include 'const.php';
    include 'utils.php';
    use PhpOffice\PhpSpreadsheet\Cell\Coordinate;

    require_once "bootstrap.php";
    include "db/entities/oc_t_user.php";
    include "db/entities/psed_data.php";
    include "db/entities/oc_t_category_description.php";
    include "db/entities/oc_user_excel_price.php";
    include "db/entities/oc_category_keys.php";
    include "db/entities/oc_t_type_description.php";

    $user_id = $_POST['user_id'];
    $start_row = $_POST['start_row'];
    $name_column = $_POST['name_column'];
    $price_column = $_POST['price_column'];
    $desc_columns = $_POST['desc_columns'];
    $img_type = $_POST['img_type'];
    $img_column = $_POST['img_column'];

    $user = $entityManager->find(oc_t_user::class, $user_id);

    $user_price = $entityManager->getRepository(oc_user_excel_price::class)->findOneBy(['idUser' => $user->getPkIId()]);
    if (!$user_price){
        $user_price = new oc_user_excel_price($name_column, $desc_columns, $price_column, $start_row, $user);
        $entityManager->persist($user_price);
        $entityManager->flush();
    }

    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
    $file = $_FILES['price_list']['tmp_name'];

    $excel_name = explode('.', $_FILES['price_list']['name'])[0];
    $sheet = $reader->load($file)->getActiveSheet();
    $data = $reader->load($file)->getActiveSheet()->toArray();
    $result = [];

    $keys = $entityManager->getRepository(oc_category_keys::class)->findAll();
    $categories = $entityManager->getRepository(oc_t_category_description::class)->findAll();

    foreach ($data as $row_index=>$row){
        $img = $img_ext = '';
        if ($row_index >= $start_row - 1){//начинаем с указанной начальной строки
            //если тип изображения url
            if ($img_type == 'img_type_url') {
                $cell = $sheet->getCellByColumnAndRow($img_column, $row_index);
                if ($cell->hasHyperlink()){
                    $link = $cell->getHyperlink()->getUrl();
                    $rand_id = rand(1111111111, 9999999999);
                    $img_info = pathinfo($link);
                    $extension = $img_info['extension'];
                    //проверяем тип изображения
                    if (in_array($extension, ['jpg', 'jpeg', 'png'])){
                        if (!file_exists($IMG_PATH)) {
                            mkdir($IMG_PATH);
                        }
                        //генерируем файл, сохраняем и запоминаем тип и название
                        $file_name = "{$user_id}user{$row_index}product_id$rand_id.{$extension}";
                        #file_put_contents("$IMG_PATH/$file_name", file_get_contents_curl($link));
                        $img = $file_name;
                        $img_ext = "image/$extension";
                    }
                }
            }
            //разделяем строку столбцов описания и вычитываем из таблицы
            $desc = '';
            foreach (explode(',', $desc_columns) as $desc_column){
                $desc = $desc.' '.$row[$desc_column - 1];
            }

            //вычитываем все основные поля с валидацией
            $desc = format_str($desc, 1000);
            $name = format_str($row[$name_column - 1], 100);
            $price = format_str($row[$price_column - 1], 10);

            $category = 6;
            $type = 0;

            $type_cat = null;
            foreach ($keys as $key){
                if ($key->getKeys()) {
                    if (str_contains(mb_strtolower($name, 'utf-8'), mb_strtolower($key->getKeys(), 'utf-8'))){
                        $category = $key->getCatId();
                    }
                }
            }
            $cat_type = $entityManager->getRepository(oc_t_type_description::class)->findOneBy(['cat' => $category]);
            if ($cat_type){
                $type = $cat_type->getId();
            }
            //записываем все вычитанные данные о строке
            if ($desc and $name and $price){
                array_push($result, [
                    'row' => $row_index,
                    'name' => $name,
                    'price' => $price,
                    'desc' => $desc,
                    'category' => $category,
                    'type' => $type,
                    'img_path' => $img,
                    'img_type' => $img_ext
                ]);
            }
        }
    }
    //начинаем читать все данные из таблицы
    //если тип изображение
    if ($img_type == 'img_type_img'){
        //вычитываем все изображения из таблицы
        foreach ($sheet->getDrawingCollection() as $drawing){
            list($startColumn, $row) = Coordinate::coordinateFromString($drawing->getCoordinates());
            $column = Coordinate::columnIndexFromString($startColumn);
            $key = array_search($row, array_column($result, "row"));
            //выбираем лишь по указанному столбцу изображения и если были получены данные о строке
            if ($img_column == $column and $key){
                $extension = $drawing->getExtension();
                //проверяем тип изображения
                if (in_array($extension, ['jpg', 'jpeg', 'png'])) {
                    $zipReader = fopen($drawing->getPath(), 'r');

                    $imageContents = '';
                    while (!feof($zipReader)) {
                        $imageContents .= fread($zipReader, 1024);
                    }
                    fclose($zipReader);
                    if ($imageContents) {
                        if (!file_exists($IMG_PATH)) {
                            mkdir($IMG_PATH);
                        }
                        //генерируем файл, сохраняем и запоминаем тип и название
                        $file_name = $excel_name.$row;
                        file_put_contents("$IMG_PATH/{$file_name}_original.{$extension}", $imageContents);

                        foreach ($SIZE_VARIANT as $variant=>$variant_size){
                            resizeImage($drawing->getPath(), $variant_size['width'], $variant_size['height'], $IMG_PATH.'/'.$file_name.'_'.$variant.'.'.$extension, $extension);
                        }

                        $result[$key]['img_path'] = $file_name;
                        $result[$key]['img_type'] = $extension;
                    }
                }
            }
        }
    }
    //перезаписываем временные данные по которым будет подтверждение и запись
    $all_psed_data = $entityManager->getRepository(psed_data::class)->findAll();
    foreach ($all_psed_data as $psed_item){
        $entityManager->remove($psed_item);
        $entityManager->flush();
    }

    foreach ($result as $index=>$item){
        $psed_data = new psed_data(
            $item['name'],
            $item['desc'],
            $item['price'],
            $item['category'],
            $item['type'],
            $item['img_path'],
            $item['img_type']);
        $entityManager->persist($psed_data);
        $entityManager->flush();
    }
