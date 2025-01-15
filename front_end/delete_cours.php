<?php
require_once '../classes/database.php';
require_once '../classes/class_cours.php';

if (isset($_POST['course_id']) && !empty($_POST['course_id'])) {
    $courseId = $_POST['course_id'];

    $result = Cours::deleteCourse($courseId);

    if ($result) {
        header("Location: liste_des_cours.php"); 
        exit();
    } else {
        echo "Une erreur est survenue lors de la suppression du cours.";
    }
} else {
    echo "ID de cours non valide.";
}
?>
