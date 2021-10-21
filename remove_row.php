<?php
    require_once "bootstrap.php";
    include "db/entities/psed_data.php";

    //удаление поля из таблицы данных для подтверждения
    if(isset($_POST['delete_id'])){
        $psed_data_item = $entityManager->getRepository(psed_data::class)->findOneBy(['id' => $_POST['delete_id']]);
        $entityManager->remove($psed_data_item);
        $entityManager->flush();
        echo 1;
        exit;
    }
    echo 0;
    exit;