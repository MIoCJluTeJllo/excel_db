<?php
function buildTree(array $categories, $parentId = -1): array
{
    $branch = array();
    foreach ($categories as $category) {
        if ($category['parent_id'] == $parentId) {
            $children = buildTree($categories, $category['id']);
            if ($children) {
                $category['children'] = $children;
            }
            $branch[] = $category;
        }
    }
    return $branch;
}

function setDropwdown($tree, $desc, &$result){
    $result  = $result.'<ul>';
    foreach ($tree as $node){
        $desc_key = array_search($node['id'], array_column($desc, 'id'));
        if ($desc_key !== false){
            $result  = $result."<li data-id='{$desc[$desc_key]['id']}'>". $desc[$desc_key]['name'];
            if (array_key_exists('children', $node)){
                setDropwdown($node['children'], $desc, $result);
            }
            $result  = $result.'</li>';
        }
    }
    $result = $result.'</ul>';
}