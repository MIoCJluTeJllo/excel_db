<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Импорт прайса</title>
    <!--
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
    !-->
    <script src='https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

    <link rel='stylesheet' href='css/style.css'>
    <script src='./dropdown/jquery.dropdown.js'></script>
    <link rel='stylesheet' href='./dropdown/dropdown.css'>
</head>
<body>
    <?php
    /*
    include "bootstrap.php";
    $em = $entityManager;
    $em->getConfiguration()->setMetadataDriverImpl(new \Doctrine\ORM\Mapping\Driver\DatabaseDriver($em->getConnection()->getSchemaManager()));
    $cmf = new Doctrine\ORM\Tools\DisconnectedClassMetadataFactory();
    $cmf->setEntityManager($em);
    $metadata = $cmf->getAllMetadata();
    $eg = new \Doctrine\ORM\Tools\EntityGenerator();
    $eg->setGenerateStubMethods(true);
    $cme = new \Doctrine\ORM\Tools\Export\ClassMetadataExporter();
    $exporter = $cme->getExporter('annotation', './Entities');
    $exporter->setMetadata($metadata);
    $exporter->setEntityGenerator($eg);
    $exporter->export();*/
    /*
include "bootstrap.php";
try { //here create table code} catch (\Doctrine\ORM\Tools\ToolsException $exc)
    $schemaTool = new \Doctrine\ORM\Tools\SchemaTool($entityManager);
    $classes = $entityManager->getMetadataFactory()->getAllMetadata();
    $schemaTool->createSchema($classes);
} catch (\Doctrine\ORM\Tools\ToolsException $exc) {}
`
#include "db/entities/oc_category.php";*/
    ?>
        <form method="post" class="form">
            <div class="form_section">
                <input class="user_id form-control" placeholder="Компания" name="user_id"/>
                <button type="button" class="get_data btn btn-light">
                    Получить данные
                </button>
            </div>
            <div style="display: none" class="loader_section">
                <div class="loader"></div>
            </div>
            <div class="form_section">
                <input disabled name="user_name" class="form-control" placeholder="Имя пользователя"/>
                <input disabled name="user_email" class="form-control" placeholder="email"/>
            </div>
            <div class="form_section file_form">
                <input accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" name="price_list" class="form-control" placeholder="Прайс лист" type="file"/>
            </div>
            <div class="form_section">
                <input name="start_row" class="price_column_item form-control" placeholder="Строка первого товара"/>
                <input name="name_column" class="price_column_item form-control" placeholder="Столбец наименования"/>
                <input name="price_column" class="price_column_item form-control" placeholder="Столбец цены"/>
                <input name="desc_columns" class="price_column_description form-control" placeholder="Столбцы описания"/>
                <input name="img_column" class="price_column_item form-control" placeholder="Номер столбца с фото"/>
            </div>
            <div class="form_section">
                <input checked type="radio" class="img_type btn-check" name="img_type" id="img_type_none" value="img_type_none">
                <label class="radio btn btn-default" for="img_type_none">нет</label>
                <input type="radio" class="img_type btn-check" name="img_type" id="img_type_img" value="img_type_img">
                <label class="radio btn btn-default" for="img_type_img">img</label>
                <input type="radio" class="img_type btn-check" name="img_type" id="img_type_url" value="img_type_url">
                <label class="radio btn btn-default" for="img_type_url">url</label>
            </div>
            <button type="button" class="price_import btn btn-secondary">
                Импорт прайса
            </button>
            <div style="display: none" class="get_error alert alert-danger">
            </div>
        </form>
    </div>
</body>
<script type='text/javascript' src='js/utils.js'></script>
<script type='text/javascript' src='js/init.js'></script>
<script type='text/javascript' src='js/alert.js'></script>
<script type='text/javascript' src='js/loader.js'></script>
<script type='text/javascript' src='js/index.js'></script>
</html>