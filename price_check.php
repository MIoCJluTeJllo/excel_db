<doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Проверка данных</title>
    <link rel='stylesheet' href='css/price_check.css'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
</head>
<body>
    <div class="app">
        <span data-id="<?= $_GET['user'];?>" class="confirm_btn btn btn-secondary">
            Подтвердить
        </span>
        <table class="table table-hover">
            <thead class="table-secondary">
            <tr>
                <th>#</th>
                <th class="col-2 name">Название</th>
                <th class="col-2">Описание</th>
                <th class="col-1">Цена</th>
                <th>Фото</th>
                <th class="col-2">Категория</th>
                <th class="col-2">Тип</th>
                <th class="col-2">Действие</th>
            </tr>
            </thead>
            <tbody>
            <?php
            include 'const.php';

            require_once "bootstrap.php";
            include "db/entities/psed_data.php";
            include "db/entities/oc_category_keys.php";
            include "db/entities/oc_type_item_keys.php";

            //инициализация таблицы подтверждения
            $data = $entityManager->getRepository(psed_data::class)->findAll();
            $categories = $entityManager->getRepository(oc_category_keys::class)->findAll();

            $category_groups = [];
            foreach ($categories as $category){
                $key = $category->getCatId();
                if (!array_key_exists($key, $category_groups)){
                    $category_groups[$key] = [];
                }
                array_push($category_groups[$key], $category->getKeys());
            }

            $types = $entityManager->getRepository(oc_type_item_keys::class)->findAll();

            $type_groups = [];
            foreach ($types as $type){
                $key = $type->getItemTypeId();
                if (!array_key_exists($key, $type_groups)){
                    $type_groups[$key] = [];
                }
                array_push($type_groups[$key], $type->getKeys());
            }

            foreach ($data as $item){
                ?>
                <tr>
                    <td>
                        <?php echo $item->getId();?>
                    </td>
                    <td>
                        <?php echo $item->getItemTitle();?>
                    </td>
                    <td>
                        <?php echo $item->getItemDesc();?>
                    </td>
                    <td>
                        <?php echo $item->getIPrice();?></td>
                    <td>
                        <?php
                            //отображаем изображение товара
                            if ($item->getResurs()) {
                                echo "<img src='$IMG_PATH/{$item->getResurs()}'/>";
                            } else {
                                echo '';
                            }
                        ?>
                    </td>
                    <td>
                        <?php
                            $cat_id = $item->getFkICategoryId();
                            if (array_key_exists($cat_id, $category_groups)) {?>
                                <select class="category_select form-select" data-id="<?= $item->getId();?>">
                                    //отображаем список категории товара
                                    <?php foreach (array_keys($category_groups) as $key){?>
                                        <option
                                            value="<?php echo $key?>"
                                            <?php echo $key == $cat_id ? 'selected' : ''?>
                                        >
                                            <?php echo $key.' ('.implode(', ', $category_groups[$key]).')'?>
                                        </option>
                                    <?php }?>
                                </select>
                            <?php } else {?>
                                <select class="category_select form-select" data-id="<?= $item->getId();?>">
                                    //отображаем список категории товара
                                    <option selected value="-1">Не определено</option>
                                    <?php foreach (array_keys($category_groups) as $key){?>
                                        <option>
                                            <?php echo $key.' ('.implode(', ', $category_groups[$key]).')'?>
                                        </option>
                                    <?php }?>
                                </select>
                        <?php }?>
                    </td>
                    <td>
                        <?php
                        $type_id = $item->getIdItemClass();
                        if (array_key_exists($type_id, $type_groups)) {?>
                            <select class="type_select form-select" data-id="<?= $item->getId();?>">
                                //отображаем список категории товара
                                <?php foreach (array_keys($type_groups) as $key){?>
                                    <option
                                            value="<?php echo $key?>"
                                        <?php echo $key == $type_id ? 'selected' : ''?>
                                    >
                                        <?php echo $key.' ('.implode(', ', $type_groups[$key]).')'?>
                                    </option>
                                <?php }?>
                            </select>
                        <?php } else {?>
                            <select class="type_select form-select" data-id="<?= $item->getId();?>">
                                //отображаем список категории товара
                                <option selected value="-1">Не определено</option>
                                <?php foreach (array_keys($type_groups) as $key){?>
                                    <option>
                                        <?php echo $key.' ('.implode(', ', $type_groups[$key]).')'?>
                                    </option>
                                <?php }?>
                            </select>
                        <?php }?>
                    </td>
                    <td class="action_column">
                        <span data-id="<?= $item->getId();?>" class="delete_btn btn btn-outline-secondary">Удалить</span>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
<script src='js/price_check.js'></script>
</html>