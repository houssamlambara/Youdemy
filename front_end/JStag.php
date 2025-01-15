<?php
require_once '../classes/class_tag.php';
header("Content-Type: application/json");

// On récupère tous les tags sous forme d'objets tag
$tags = tag::afficheTag();

// On mappe les objets tag pour obtenir uniquement les noms des tags
$tagNames = array_map(function($tag) {
    return $tag->getTag();
}, $tags);

echo json_encode($tagNames);
?>