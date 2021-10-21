<?php
    include 'const.php';
    include 'utils.php';
    use PhpOffice\PhpSpreadsheet\Cell\Coordinate;

    require_once "bootstrap.php";
    include "db/entities/oc_t_user.php";
    include "db/entities/oc_user_excel_price.php";
    include "db/entities/oc_type_item_keys.php";
    include "db/entities/oc_category_keys.php";
    include "db/entities/psed_data.php";

    $user_id = $_POST['user_id'];
    $start_row = $_POST['start_row'];
    $name_column = $_POST['name_column'];
    $price_column = $_POST['price_column'];
    $desc_columns = $_POST['desc_columns'];
    $img_type = $_POST['img_type'];
    $img_column = $_POST['img_column'];

    $user = $entityManager->find(oc_t_user::class, $user_id);
    $user_price = $entityManager->getRepository(oc_user_excel_price::class)->findOneBy(['id_user' => $user->getId()]);
    if (!$user_price){
        $user_price = new oc_user_excel_price();
    }
    $user_price->setIdUser($user);
    $user_price->setNumTitle($name_column);
    $user_price->setNumDesc($desc_columns);
    $user_price->setNumPrice($price_column);
    $user_price->setNumStr($start_row);

    $entityManager->persist($user_price);
    $entityManager->flush();

    //получаем все типы и категории
    $categories = $entityManager->getRepository(oc_category_keys::class)->findAll();
    $types = $entityManager->getRepository(oc_type_item_keys::class)->findAll();

    //начинаем читать все данные из таблицы
    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
    $file = $_FILES['price_list']['tmp_name'];
    $sheet = $reader->load($file)->getActiveSheet();
    $data = $reader->load($file)->getActiveSheet()->toArray();
    $result = [];
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
                        file_put_contents("$IMG_PATH/$file_name", file_get_contents_curl($link));
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

            //определяем категорию и типа или же ставим 0
            $category_id = $type_id = 0;
            $category = contains($categories, $name);
            if ($category) {
                $category_id = $category->getCatId();
            }
            else {
                $category_id = -1;
            }
            $type = contains($types, $name);
            if ($type) {
                $type_id = $type->getItemTypeId();
            }
            else {
                $type_id = -1;
            }
            $type = contains($types, $name);

            //записываем все вычитанные данные о строке
            if ($desc and $name and $price ){
                array_push($result, [
                    'row' => $row_index,
                    'name' => $name,
                    'price' => $price,
                    'desc' => $desc,
                    'category' => $category_id,
                    'type' => $type_id,
                    'img' => $img,
                    'img_type' => $img_ext
                ]);
            }
        }
    }

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
                        $rand_id = rand(1111111111, 9999999999);
                        $file_name = "{$user_id}user{$row}product_id{$rand_id}.{$extension}";
                        file_put_contents("$IMG_PATH/{$file_name}", $imageContents);
                        $result[$key]['img'] = $file_name;
                        $result[$key]['img_type'] = 'image/'.$extension;
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
        $psed_data = new psed_data();
        $psed_data->setItemTitle($item['name']);
        $psed_data->setIPrice($item['price']);
        $psed_data->setItemDesc($item['desc']);
        $psed_data->setFkICategoryId($item['category']);
        $psed_data->setIdItemClass($item['type']);
        $psed_data->setResurs($item['img']);
        $psed_data->setResursType($item['img_type']);
        $entityManager->persist($psed_data);
        $entityManager->flush();
    }
