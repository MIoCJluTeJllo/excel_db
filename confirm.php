<?php
    //подтверждение таблицы и окончательная запись в базу данных
    include 'const.php';

    require_once "bootstrap.php";
    include 'db/entities/psed_data.php';
    include 'db/entities/oc_t_item_excel.php';
    include 'db/entities/oc_item_description.php';
    include 'db/entities/oc_t_item_resource.php';
    include 'db/entities/oc_category_keys.php';
    include 'db/entities/oc_type_item_keys.php';
    include 'db/entities/oc_t_user.php';
    include 'db/entities/stat_item.php';


    if (isset($_POST['user_id'])){

        $user_id = $_POST['user_id'];
        //все данные из выпадающих списков типа и категории товара
        $categories = $_POST['categories'];
        $types = $_POST['types'];
        //обновляем эти данные
        foreach ($categories as $category){
            $changeCategory = $entityManager->getRepository(psed_data::class)->findOneBy(['id' => $category['id']]);
            $changeCategory->setFkICategoryId($category['val']);
            $entityManager->persist($changeCategory);
            $entityManager->flush();
        }
        foreach ($types as $type){
            $changeType = $entityManager->getRepository(psed_data::class)->findOneBy(['id' => $type['id']]);
            $changeType->setIdItemClass($type['val']);
            $entityManager->persist($changeType);
            $entityManager->flush();
        }

        $psed_data = $entityManager->getRepository(psed_data::class)->findAll();
        $psed_data_titles = array_column($psed_data, 'item_title');
        $exist_excel_items = $entityManager->getRepository(oc_t_item_excel::class)->findBy(['fk_i_user' => $user_id]);
        foreach ($exist_excel_items as $excel_item){
            $exist_description = $entityManager->getRepository(oc_item_description::class)->findOneBy(['pk_i' => $excel_item->getId()]);
            if ($exist_description){
                $index = array_search($exist_description->getSTitle(), $psed_data_titles);
                if (array_key_exists($index, $psed_data)){
                    $psed_item = $psed_data[$index];
                    $excel_item->setIPrice($psed_item->getIPrice());
                    $entityManager->persist($excel_item);
                    $entityManager->flush();
                    unset($psed_data[$index]);
                    unset($psed_data_titles[$index]);
                }
            }
        }
        $user_data = $entityManager->getRepository(oc_t_user::class)->findOneBy(['id' => $user_id]);
        foreach ($psed_data as $psed_item){
            $oc_t_item_excel = new oc_t_item_excel();
            $oc_t_item_excel->setFkIUser($user_data);
            $oc_t_item_excel->setSContactName($user_data->getSName());
            $oc_t_item_excel->setSContactEmail($user_data->getSEmail());
            $oc_t_item_excel->setFkICategory(
                $entityManager->getRepository(oc_category_keys::class)->findOneBy(['id' => $psed_item->getFkICategoryId()])
            );
            $oc_t_item_excel->setFkIType(
                $entityManager->getRepository(oc_type_item_keys::class)->findOneBy(['id' => $psed_item->getIdItemClass()])
            );
            $oc_t_item_excel->setIPrice($psed_item->getIPrice());
            $entityManager->persist($oc_t_item_excel);

            $oc_item_description = new oc_item_description();
            $oc_item_description->setPkI($oc_t_item_excel);
            $oc_item_description->setSTitle($psed_item->getItemTitle());
            $oc_item_description->setSDescription($psed_item->getItemDesc());
            $entityManager->persist($oc_item_description);

            $oc_t_item_resource = new oc_t_item_resource();
            $oc_t_item_resource->setFkIItem($oc_t_item_excel);
            $oc_t_item_resource->setSContentType($psed_item->getResursType());
            $oc_t_item_resource->setSName($psed_item->getResurs());
            $oc_t_item_resource->setSPath($IMG_PATH);
            $entityManager->persist($oc_t_item_resource);

            $stat_item = new stat_item();
            $stat_item->setFkIItem($oc_t_item_excel);
            $stat_item->setItemTitle($psed_item->getItemTitle());
            $entityManager->persist($stat_item);

            $entityManager->flush();
        }
        echo 1;
        exit;
    }
    echo 0;
    exit;
?>