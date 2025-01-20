<?php
require_once('database.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_cours'])) {
    // Récupérer les données envoyées
    $id = intval($_POST['id']);
    $titre = htmlspecialchars($_POST['titre']);
    $description = htmlspecialchars($_POST['description']);
    $categorie_id = htmlspecialchars($_POST['categorie_id']);
    $prix = htmlspecialchars($_POST['prix']);

    // Gestion du téléchargement de l'image
    $image_url = '';
    if (!empty($_FILES['image_url']['name'])) {
        $image_url = 'uploads/' . basename($_FILES['image_url']['name']);
        if (move_uploaded_file($_FILES['image_url']['tmp_name'], $image_url)) {
            // Image téléchargée avec succès
        } else {
            echo "Erreur lors de l'upload de l'image.";
        }
    } else {
        // Si aucune image n'est téléchargée, garder l'image existante
        $cours = new Cours('', '', '', '', '');
        $existingCourse = $cours->getCoursById($id);
        $image_url = $existingCourse ? $existingCourse->getImageUrl() : ''; // Conserver l'image existante
    }

    // Créer un objet Cours avec les nouvelles données
    $cours = new Cours($titre, $description, $image_url, $categorie_id, $prix);
    $cours->setId($id); // Assurez-vous d'avoir un setter pour l'ID

    // Mettre à jour le cours dans la base de données
    if ($cours->update()) {
        echo "Le cours a été mis à jour avec succès !";
        header('Location: enseignant_dashboard.php');
        exit();
    } else {
        echo "Une erreur s'est produite lors de la mise à jour du cours.";
    }
}
?>
