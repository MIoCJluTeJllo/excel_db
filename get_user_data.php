<?php
    require_once "bootstrap.php";

    include "db/entities/oc_t_user.php";
    include "db/entities/oc_user_excel_price.php";

    //получение данных о пользователе и прайс листе
    if (array_key_exists('user_id', $_POST)){
        $user_id = $_POST['user_id'];
        $user = $entityManager->find(oc_t_user::class, $user_id);
        if ($user){
            $result = [
                'user' => [
                    'name' => $user->getSName(),
                    'email' => $user->getSEmail(),
                ]
            ];
            //если информация о прайс листе имеется отправляем ее тоже
            $user_price = $entityManager->getRepository(oc_user_excel_price::class)->findOneBy(['id_user' => $user->getId()]);
            if ($user_price){
                $result['price'] = [
                    'num_title' => $user_price->getNumTitle(),
                    'num_desc' => $user_price->getNumDesc(),
                    'num_price' => $user_price->getNumPrice(),
                    'num_str' => $user_price->getNumStr(),
                ];
            }
            echo json_encode($result);
            exit;
        }
        echo 0;
    }