<?php
    //подтверждение таблицы и окончательная запись в базу данных
    include 'const.php';

    require_once "bootstrap.php";
    include "utils.php";
    include "db/entities/oc_t_user.php";
    include "db/entities/psed_data.php";
    include "db/entities/oc_t_item.php";
    include "db/entities/oc_t_item_description.php";
    include "db/entities/oc_t_item_meta.php";
    include "db/entities/oc_t_item_location.php";
    include "db/entities/oc_t_item_resource.php";

    if (isset($_POST['user_id'])){
        $user_id = $_POST['user_id'];
        $price = $_POST['price'];
        $desc = $_POST['desc'];
        //все данные из выпадающих списков типа и категории товара
        $user_info = $entityManager->getRepository(oc_t_user::class)->findOneBy(['pkIId' => $user_id]);

        $psed_data = $entityManager->getRepository(psed_data::class)->findAll();
        foreach ($psed_data as $item){
            $exist_desc = $entityManager->getRepository(oc_t_item_description::class)->findOneBy(['sTitle' => $item->getItemTitle()]);
            if ($exist_desc){
                $exist_id = $exist_desc->getFkIItemId();

                $exist_item = $entityManager->getRepository(oc_t_item::class)->findOneBy(['pkIId' => $exist_id]);
                $exist_meta = $entityManager->getRepository(oc_t_item_meta::class)->findOneBy(['fkIItemId' => $exist_id]);
                $exist_location = $entityManager->getRepository(oc_t_item_location::class)->findOneBy(['fkIItemId' => $exist_id]);
                $exist_resource = $entityManager->getRepository(oc_t_item_resource::class)->findOneBy(['fkIItem' => $exist_item]);
                $user_info->setIItems($user_info->getIItems() - 1);

                if ($exist_desc){
                    $entityManager->remove($exist_desc);
                }
                if ($exist_item){
                    $entityManager->remove($exist_item);
                }
                if ($exist_meta){
                    $entityManager->remove($exist_meta);
                }
                if ($exist_location){
                    $entityManager->remove($exist_location);
                }
                if ($exist_resource){
                    $entityManager->remove($exist_resource);
                }
                if ($user_info){
                    $entityManager->persist($user_info);
                }

                $entityManager->flush();
            }
            $price_key = array_search($user_info->getPkIId(), array_column($price, 'id'));
            $desc_key = array_search($user_info->getPkIId(), array_column($desc, 'id'));

            $new_item = new oc_t_item(
                $user_info->getPkIId(),
                $user_info->getSName(),
                $user_info->getSEmail(),
                $price[$price_key]['val'],
                $item->getCategory(),
                $item->getType(),
                psw_generate()
            );
            $entityManager->persist($new_item);
            $entityManager->flush();

            $user_info->setIItems($user_info->getIItems() + 1);
            $entityManager->persist($user_info);

            $item_id = $new_item->getPkIId();

            $new_decs = new oc_t_item_description($item_id, $item->getItemTitle(), $desc[$desc_key]['val']);
            $entityManager->persist($new_decs);

            $new_meta = new oc_t_item_meta();
            $new_meta->setFkIItemId($item_id);
            $entityManager->persist($new_meta);

            $new_location = new oc_t_item_location(
                $item_id,
                $user_info->getSAddress(),
                $user_info->getFkIRegionId(),
                $user_info->getSRegion(),
                $user_info->getFkICityId(),
                $user_info->getSCity());
            $entityManager->persist($new_location);

            if ($item->getImgPath()){
                $new_resource = new oc_t_item_resource(
                    $new_item,
                    psw_generate(),
                    $item->getImgType(),
                    "image/{$item->getImgType()}");

                $entityManager->persist($new_resource);
                $entityManager->flush();

                $img_id = $new_resource->getPkIId();
                foreach (['_original', '_preview', '_thumbnail'] as $img_variant){
                    $img_ext = "{$img_variant}.{$item->getImgType()}";
                    rename(
                        "{$IMG_PATH}/{$item->getImgPath()}{$img_ext}",
                        "{$IMG_PATH}/{$img_id}{$img_ext}"
                    );
                }
            }
        }
        echo 1;
        exit;
    }
    echo 0;
    exit;
?>