<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Youdemy - Plateforme de Cours en Ligne</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50">
    <!-- Navigation -->
    <nav class="bg-white border-gray-200 shadow-sm fixed w-full z-50">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
            <a href="../index.php" class="flex items-center space-x-3">
                <span class="self-center text-2xl font-bold text-indigo-600">Youdemy</span>
            </a>
            <div class="flex md:order-2 space-x-3">
                <a href="../login/signin.php" class="text-white bg-indigo-600 hover:bg-indigo-700 font-medium rounded-lg text-sm px-4 py-2">
                    Connexion
                </a>
                <a href="../login/signup.php" class="text-indigo-600 bg-white hover:bg-indigo-50 hover:text-indigo-700 font-medium rounded-lg text-sm px-4 py-2 border border-indigo-600">
                    S'inscrire
                </a>
                <button data-collapse-toggle="navbar-sticky" type="button"
                    class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100"
                    aria-controls="navbar-sticky" aria-expanded="false">
                    <span class="sr-only">Menu</span>
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M1 1h15M1 7h15M1 13h15" />
                    </svg>
                </button>
            </div>
            <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-sticky">
                <ul class="flex flex-col p-4 md:p-0 mt-4 font-medium border border-gray-100 rounded-lg bg-gray-50 md:space-x-8 md:flex-row md:mt-0 md:border-0 md:bg-white">
                    <li>
                        <a href="../index.php" class="block py-2 px-3 text-indigo-600" aria-current="page">Accueil</a>
                    </li>
                    <li>
                        <a href="#" class="block py-2 px-3 text-gray-900 hover:text-indigo-600">Cours</a>
                    </li>
                    <li>
                        <a href="./programmes.php" class="block py-2 px-3 text-gray-900 hover:text-indigo-600">Programmes</a>
                    </li>
                    <li>
                        <a href="./enseignant.php" class="block py-2 px-3 text-gray-900 hover:text-indigo-600">About Youdemy</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Filtres et Catalogue -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- En-tête et filtres -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 mt-12">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Catalogue des cours</h1>
                <p class="mt-2 text-gray-600">Découvrez notre sélection de cours de qualité</p>
            </div>
            <div class="mt-4 md:mt-0 flex flex-wrap gap-2">
                <select class="bg-white border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:border-indigo-500">
                    <option>Tous les niveaux</option>
                    <option>Débutant</option>
                    <option>Intermédiaire</option>
                    <option>Avancé</option>
                </select>
                <select class="bg-white border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:border-indigo-500">
                    <option>Toutes les catégories</option>
                    <option>Développement</option>
                    <option>Business</option>
                    <option>Design</option>
                    <option>Marketing</option>
                </select>
            </div>
        </div>

        <!-- Grille des cours -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php
            require_once('../classes/class_cours.php');
            $cours = new Cours('', '', '', 0, 0);
            $total = $cours->totalcours();
            $nmbpage = ceil($total['total'] / 6);
            $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
            $courses = $cours->pagination($page);
            ?>

            <?php foreach ($courses as $Cours): ?>
                <?php
                if (empty($Cours['titre']) || empty($Cours['image_url']) || empty($Cours['prix'])) {
                    continue;
                }
                ?>
                <div class="bg-white rounded-lg shadow-md overflow-hidden transition-transform hover:scale-105 p-6">
                    <img src="../img/<?php echo htmlspecialchars($Cours['image_url']); ?>" alt="<?php echo htmlspecialchars($Cours['titre']); ?>" class="w-full h-64 object-cover">
                    <div class="p-6">
                        <h3 class="text-xl font-bold mb-4"><?php echo htmlspecialchars($Cours['titre']); ?></h3>
                        <p class="text-gray-600 mb-4"><?php echo htmlspecialchars($Cours['description']); ?></p>
                        <div class="flex items-center justify-between">
                            <span class="text-xl font-bold text-indigo-600"><?php echo number_format($Cours['prix'], 2, ',', ' ') . '€'; ?></span>
                            <button class="text-white bg-indigo-600 hover:bg-indigo-700 px-6 py-3 rounded-lg">
                                Voir le cours
                            </button>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

    </div>
    <!-- Pagination -->
    <div class="w-full">
        <div class="pagination">
            <ul class="flex justify-center mb-12 space-x-4">
                <?php

                for ($i = 1; $i <= $nmbpage; $i++) {

                    $activeClass = ($i == $page) ? 'class="active"' : '';
                    echo "<li class='bg-gray-200 text-gray-800 px-4 py-2 rounded-md hover:bg-gray-300'><a href='?page=$i' $activeClass>$i</a></li>";
                }
                ?>
            </ul>
        </div>
    </div>
    </div>

    <!-- Footer Amélioré -->
    <footer class="bg-gradient-to-r from-gray-900 to-black text-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 text-center">
                <!-- Colonnes précédentes avec des améliorations visuelles subtiles -->
                <div>
                    <img src="https://via.placeholder.com/150x50?text=RoadRover" alt="RoadRover Logo" class="mb-4 mx-auto transform hover:scale-110 transition duration-300">
                    <p class="text-sm text-gray-400">RoadRover - Votre partenaire de confiance pour la location de voitures de luxe.</p>
                </div>

                <div>
                    <h4 class="font-bold mb-4 text-yellow-500">Liens Rapides</h4>
                    <ul class="space-y-2">
                        <li><a href="#home" class="hover:text-yellow-400 transition duration-300">Accueil</a></li>
                        <li><a href="#cars" class="hover:text-yellow-400 transition duration-300">Véhicules</a></li>
                        <li><a href="#reservation" class="hover:text-yellow-400 transition duration-300">Réservation</a></li>
                        <li><a href="#about" class="hover:text-yellow-400 transition duration-300">À Propos</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="font-bold mb-4 text-yellow-500">Contact</h4>
                    <ul class="space-y-2">
                        <li><i class="fas fa-phone mr-2 text-yellow-500"></i>+33 1 23 45 67 89</li>
                        <li><i class="fas fa-envelope mr-2 text-yellow-500"></i>contact@roadrover.com</li>
                        <li><i class="fas fa-map-marker-alt mr-2 text-yellow-500"></i>Paris, France</li>
                    </ul>
                </div>

                <div>
                    <h4 class="font-bold mb-4 text-yellow-500">Suivez-nous</h4>
                    <div class="flex space-x-4 justify-center">
                        <a href="#" class="text-2xl hover:text-yellow-400 transform hover:scale-125 transition duration-300"><i class="fab fa-facebook"></i></a>
                        <a href="#" class="text-2xl hover:text-yellow-400 transform hover:scale-125 transition duration-300"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="text-2xl hover:text-yellow-400 transform hover:scale-125 transition duration-300"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="text-2xl hover:text-yellow-400 transform hover:scale-125 transition duration-300"><i class="fab fa-linkedin"></i></a>
                    </div>
                </div>
            </div>

            <div class="mt-8 pt-8 border-t border-gray-800 text-center">
                <p class="text-sm text-gray-400">&copy; 2024 Youdemy. Tous droits réservés.</p>
            </div>
        </div>
    </footer>

</html>