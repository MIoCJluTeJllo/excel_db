<doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Проверка данных</title>
    <link rel='stylesheet' href='css/style.css'>
    <link rel='stylesheet' href='css/price_check.css'>
    <!--<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>!-->

    <script src='https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

    <link rel='stylesheet' href='dropdown/dropdown.css'>
    <script src="dropdown/jquery.dropdown.js"></script>
</head>
<body>
    <div class="app">
        <div class="loader_section">
            <div class="loader"></div>
        </div>
        <span data-id="<?= $_GET['user'];?>" class="confirm_btn btn btn-success disabled">
            Подтвердить
        </span>
        <table class="table table-hover" style="display: none">
            <thead class="table-secondary">
            <tr>
                <th>#</th>
                <th class="col-1 name">Название</th>
                <th class="col-2">Категория</th>
                <th class="col-2">Тип</th>
                <th class="col-3">Описание</th>
                <th class="col-1">Цена</th>
                <th>Фото</th>
                <th class="col-1">Действие</th>
            </tr>
            </thead>
            <tbody>
            <?php
            include 'const.php';

            require_once "bootstrap.php";
            include "db/entities/psed_data.php";
            include "db/entities/oc_t_category_description.php";
            include "db/entities/oc_category.php";
            include "db/entities/oc_t_type_description.php";
            include "./dropdown/dropdown.php";

            //инициализация таблицы подтверждения
            $data = $entityManager->getRepository(psed_data::class)->findAll();

            $category_desc = $entityManager->getRepository(oc_t_category_description::class)->findAll();
            $categories = $entityManager->getRepository(oc_category::class)->findAll();

            $category_desc_array = array_map(function ($category) {
                return [ 'name' => $category->getSName(), 'id' => $category->getFkICategoryId() ];
            }, $category_desc);
            $prepare_categories = [];
            foreach ($categories as $category){
                $parent = $category->getFkIParent();
                if ($category->getFkIParent()){
                    array_push($prepare_categories, ['id' =>  $category->getPkIId(), 'parent_id' => $parent->getPkIId()]);
                } else {
                    array_push($prepare_categories, ['id' =>  $category->getPkIId(), 'parent_id' => -1]);
                }
            }
            $category_tree = buildTree($prepare_categories);
            $category_dropwodn = '';
            setDropwdown($category_tree, $category_desc_array, $category_dropwodn);

            $types = $entityManager->getRepository(oc_t_type_description::class)->findAll();
            $type_tree = array_map(function ($type) {
                return [ 'name' => $type->getSName(), 'id' => $type->getId() ];
            }, $types);
            $type_dropwodn = '';
            setDropwdown($type_tree, $type_tree, $type_dropwodn);

            foreach ($data as $item){?>
                <tr data-id=<?php echo $item->getId();?>>
                    <td>
                        <?php echo $item->getId();?>
                    </td>
                    <td>
                        <?php echo $item->getItemTitle();?>
                    </td>
                    <td class="category" data-id=<?php echo $item->getCategory();?>>
                        <?php echo $category_dropwodn?>
                    </td>
                    <td class="type" data-id=<?php echo $item->getType();?>>
                        <?php echo $type_dropwodn?>
                    </td>
                    <td>
                        <?php echo "<textarea class='form-control'>{$item->getItemDesc()}</textarea>"?>
                    </td>
                    <td>
                        <?php echo "<input class='form-control' value='{$item->getIPrice()}'/>"?>
                    </td>
                    <td>
                        <?php
                            //отображаем изображение товара
                            if ($item->getImgPath()) {
                                echo "<img src='$IMG_PATH/{$item->getImgPath()}_thumbnail.{$item->getImgType()}'/>";
                            } else {
                                echo '';
                            }
                        ?>
                    </td>
                    <td class="action_column">
                        <button data-id="<?= $item->getId();?>" class="delete_btn btn btn-danger">Удалить</button>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</body>
<script src='js/loader.js'></script>
<script src='js/price_check.js'></script>
</html>