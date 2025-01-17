<?php

require_once('../classes/class_tag.php');
require_once('../classes/class_delete.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_tags'])) {
    $noms = array_map('trim', explode(',', $_POST['noms']));

    if (Tag::saveMultiple($noms)) {
        echo "Les tags ont été ajoutés avec succès !";
        header("Location: tag.php");
        exit();
    } else {
        echo "Une erreur est survenue lors de l'ajout des tags.";
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_tag'])) {
    $tagId = (int)$_POST['delete_id'];

    $delete = new Delete('tags', $tagId);
    if ($delete->execute()) {
        echo "Le tag a été supprimé avec succès.";
        header("Location: tag.php");
        exit();
    } else {
        echo "Une erreur est survenue lors de la suppression du tag.";
    }
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Tags - Plateforme de Cours</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/js/all.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-indigo-700 text-white min-h-screen">
            <div class="p-6">
                <h2 class="text-2xl font-bold">Youdemy</h2>
            </div>
            <nav class="mt-6">
                <div class="px-4 space-y-2">
                    <!-- <a href="./admin.php" class="flex items-center p-3 bg-indigo-800 rounded-lg hover:bg-indigo-900 transition-colors">
                        <i class="fas fa-home w-6"></i>
                        <span>Tableau de bord</span>
                    </a> -->
                    <a href="./utilisateurs.php" class="flex items-center p-3 hover:bg-indigo-800 rounded-lg transition-colors">
                        <i class="fas fa-chalkboard-teacher w-6"></i>
                        <span>Utilisateurs</span>
                    </a>
                    <a href="./categorie.php" class="flex items-center p-3 hover:bg-indigo-800 rounded-lg transition-colors">
                        <i class="fas fa-th-list w-6"></i>
                        <span>Add Catégories</span>
                    </a>
                    <a href="./tag.php" class="flex items-center p-3 hover:bg-indigo-800 rounded-lg transition-colors">
                        <i class="fas fa-tags w-6"></i>
                        <span>Add Tags</span>
                    </a>
                    <a href="./statistique.php" class="flex items-center p-3 hover:bg-indigo-800 rounded-lg transition-colors">
                        <i class="fas fa-chart-line w-6"></i>
                        <span>Statistiques</span>
                    </a>
                    <a href="../login/signin.php" class="flex items-center p-3 hover:bg-indigo-800 rounded-lg transition-colors">
                        <i class="fas fa-sign-out-alt w-6"></i>
                        <span>Se déconnecter</span>
                    </a>
                </div>
            </nav>
        </aside>

        <!-- Main Content -->
        <div class="flex-1">
            <!-- Top Navigation -->
            <header class="bg-white shadow">
                <div class="flex justify-between items-center px-8 py-4">
                    <h1 class="text-2xl font-bold text-gray-800">Gestion des Tags</h1>
                    <div class="flex items-center gap-4">
                        <button data-modal-toggle="addCategorieModal" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 flex items-center gap-2">
                            <i class="fas fa-plus"></i>
                            Ajouter un Tag
                        </button>
                        <div class="flex items-center gap-2">
                            <img src="../img/houssam.jpg" alt="Profile" class="w-10 h-10 rounded-full">
                            <span class="font-medium">Admin</span>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Categories Content -->
            <main class="p-8">
                <!-- Categories Table -->
                <table class="min-w-full bg-white shadow rounded-lg">
                    <thead>
                        <tr>
                            <th class="px-6 py-3 text-left text-gray-600">ID</th>
                            <th class="px-6 py-3 text-left text-gray-600">Nom</th>
                            <th class="px-6 py-3 text-left text-gray-600">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $tags = Tag::getAllTags();
                        foreach ($tags as $tag): ?>
                            <tr class="border-b">
                                <td class="px-6 py-3"><?= htmlspecialchars($tag->getId()) ?></td>
                                <td class="px-6 py-3"><?= htmlspecialchars($tag->getNom()) ?></td>
                                <td class="px-6 py-3">
                                    <form action="" method="POST" style="display:inline;">
                                        <input type="hidden" name="delete_id" value="<?= $tag->getId() ?>">
                                        <button type="submit" name="delete_tag" class="ml-4 text-red-600 hover:underline">
                                            <i class="fas fa-trash-alt"></i> Supprimer
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </main>
        </div>
    </div>

    <!-- Modal for adding a category -->
    <!-- Modal for adding a category -->
    <div id="addCategorieModal" class="fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center hidden">
        <div class="bg-white p-6 rounded-lg w-1/3 relative">
            <!-- Bouton X pour fermer le modal -->
            <button id="closeModalButton" class="absolute top-2 right-2 text-red-600 hover:text-red-600">
                <i class="fas fa-times"></i>
            </button>

            <h3 class="text-xl font-semibold mb-4">Ajouter un nouveau tag</h3>
            <form method="POST">
                <div class="mb-4">
                    <label for="tagInput" class="block text-gray-600">Ajoutez des tags</label>
                    <div class="flex items-center gap-2">
                        <input type="text" id="tagInput" class="w-full px-4 py-2 border rounded-lg" placeholder="Entrez un tag">
                        <button type="button" id="addTagButton" class="bg-indigo-600 text-white px-4 py-2 rounded-lg">Ajouter</button>
                    </div>
                    <div id="tagList" class="mt-2 flex flex-wrap gap-2"></div>
                    <input type="hidden" name="noms" id="tags">
                </div>
                <button type="submit" name="add_tags" class="bg-indigo-600 text-white px-4 py-2 rounded-lg">Soumettre</button>
                <button type="button" id="resetButton" class="ml-4 text-red-600 hover:underline">Réinitialiser</button>
            </form>
        </div>
    </div>


    <script>
        document.querySelector('[data-modal-toggle="addCategorieModal"]').addEventListener('click', function() {
            document.getElementById('addCategorieModal').classList.remove('hidden');
        });

        document.querySelector('form').addEventListener('submit', function() {
            document.getElementById('addCategorieModal').classList.add('hidden');
        });

        document.addEventListener('DOMContentLoaded', () => {
            const tagInput = document.getElementById('tagInput');
            const addTagButton = document.getElementById('addTagButton');
            const tagList = document.getElementById('tagList');
            const resetButton = document.getElementById('resetButton');
            const tagsHiddenInput = document.getElementById('tags');
            const closeModalButton = document.getElementById('closeModalButton'); // bouton pour fermer le modal
            const addCategorieModal = document.getElementById('addCategorieModal'); // modal

            let tags = []; // tableau pour stocker les tags ajoutés

            // Ajouter un tag
            addTagButton.addEventListener('click', () => {
                const tagText = tagInput.value.trim();
                if (tagText && !tags.includes(tagText)) {
                    const tagElement = document.createElement('div');
                    tagElement.className = 'bg-gray-300 px-3 py-1 rounded-full flex items-center';
                    tagElement.innerHTML = `
                <span class="mr-2">${tagText}</span>
                <button type="button" class="text-red-600 ml-2">X</button>
            `;
                    const removeButton = tagElement.querySelector('button');
                    removeButton.addEventListener('click', () => {
                        tagList.removeChild(tagElement);
                        tags = tags.filter(tag => tag !== tagText); // supprimer le tag du tableau
                        updateTagCount();
                        tagsHiddenInput.value = tags.join(',');
                    });
                    tagList.appendChild(tagElement);
                    tags.push(tagText); // ajouter le tag au tableau
                    tagInput.value = '';
                    tagsHiddenInput.value = tags.join(','); // mettre à jour l'input caché
                    updateTagCount();
                } else {
                    tagInput.value = ''; // si le tag est déjà dans le tableau ou est vide, réinitialiser l'input
                }
            });

            // Ajouter un tag lorsqu'on appuie sur Entrée
            tagInput.addEventListener('keypress', (e) => {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    addTagButton.click();
                }
            });

            // Réinitialiser la liste de tags
            resetButton.addEventListener('click', () => {
                tagList.innerHTML = '';
                tags = []; // réinitialiser le tableau des tags
                updateTagCount();
                tagsHiddenInput.value = ''; // réinitialiser l'input caché
            });

            // Fermer le modal en cliquant sur le bouton "X"
            closeModalButton.addEventListener('click', () => {
                addCategorieModal.classList.add('hidden');
            });

            // Fermer le modal en cliquant à l'extérieur de la boîte du modal
            addCategorieModal.addEventListener('click', (event) => {
                if (event.target === addCategorieModal) {
                    addCategorieModal.classList.add('hidden');
                }
            });

            // Mettre à jour le nombre de tags affiché
            function updateTagCount() {
                const tagCount = tagList.children.length;
                // Pour afficher le nombre de tags en bas ou ailleurs dans le modal si nécessaire
                console.log(`${tagCount} tag(s)`);
            }
        });
        addCategorieModal.addEventListener('click', (event) => {
            if (event.target === addCategorieModal) {
                addCategorieModal.classList.add('hidden');
            }
        });
        closeModalButton.addEventListener('click', () => {
            addCategorieModal.classList.add('hidden');
        });
    </script>
</body>

</html>