<?php
require_once '../classes/class_tag.php';
header("Content-Type: application/json");


$tags = tag::afficheTag();

$tagNames = array_map(function($tag) {
    return $tag->getTag();
}, $tags);

echo json_encode($tagNames);
?>