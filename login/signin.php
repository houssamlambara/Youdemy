<?php
session_start();
include_once "../classes/database.php";
include_once "../classes/class_user.php";

$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    if (empty($email) || empty($password)) {
        $error = "Email et mot de passe sont requis.";
    } else {
        try {
            $authenticatedUser = User::signin($email, $password);

            $_SESSION['id'] = $authenticatedUser->getId();
            $_SESSION['role'] = $authenticatedUser->getRole();

            if ($authenticatedUser->getRole() === 1) { 
                header("Location: ../front_end/admin.php");
            } elseif ($authenticatedUser->getRole() === 2) { 
                header("Location: ../front_end/cours.php");
            } elseif ($authenticatedUser->getRole() === 3) { 
                header("Location: ../front_end/enseignant_dashboard.php");
            } else {

                header("Location: ./login/signin.php");
            }
            exit(); 
        } catch (Exception $e) {
            $error = $e->getMessage();
        }
    }
}
?>



<?php if ($error): ?>
    <div class="error"><?php echo $error; ?></div>
<?php endif; ?>

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
    <nav class="bg-white border-gray-200 shadow-sm fixed w-full top-0 z-50">
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
                        <a href="../front_end/cours.php" class="block py-2 px-3 text-gray-900 hover:text-indigo-600">Cours</a>
                    </li>
                    <li>
                        <a href="../front_end/categorie.php" class="block py-2 px-3 text-gray-900 hover:text-indigo-600">Catégories</a>
                    </li>
                    <li>
                        <a href="../front_end/programmes.php" class="block py-2 px-3 text-gray-900 hover:text-indigo-600">Programmes</a>
                    </li>
                    <li>
                        <a href="../front_end/enseignant.php" class="block py-2 px-3 text-gray-900 hover:text-indigo-600">Enseignants</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content avec padding-top pour compenser la navbar fixe -->
    <main class="mt-8">
        <div class="min-h-screen flex items-center justify-center bg-gradient-to-r from-indigo-100 to-indigo-200">
            <div class="max-w-4xl w-full bg-white rounded-lg shadow-lg flex overflow-hidden my-12">
                <!-- Partie Image - Maintenant en premier -->
                <div class="w-full bg-indigo-600 hidden md:block">
                    <img src="../img/Developpeur.jpg" alt="Illustration de connexion"
                        class="object-cover w-full h-full rounded-l-lg"> <!-- Changed to rounded-l-lg -->
                </div>

                <!-- Partie Formulaire -->
                <div class="w-full p-10">
                    <h2 class="text-3xl font-semibold text-center text-gray-800 mb-6">Connexion à Youdemy</h2>

                    <form action="" method="POST" class="space-y-6">
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">Adresse email</label>
                            <input type="email" id="email" name="email" required placeholder="Votre email"
                                class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 focus:outline-none transition duration-300 ease-in-out" />
                        </div>
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700">Mot de passe</label>
                            <input type="password" id="password" name="password" required placeholder="Votre Mot de passe"
                                class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 focus:outline-none transition duration-300 ease-in-out" />
                        </div>

                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <input id="remember-me" name="remember-me" type="checkbox"
                                    class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                                <label for="remember-me" class="ml-2 block text-sm text-gray-700">
                                    Se souvenir de moi
                                </label>
                            </div>
                            <a href="/mot-de-passe-oublie" class="text-sm text-indigo-500 hover:text-indigo-600">
                                Mot de passe oublié ?
                            </a>
                        </div>
                        <div>
                            <button type="submit"
                                class="w-full py-3 px-4 bg-indigo-600 text-white font-semibold rounded-md shadow-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-400 transition duration-300 ease-in-out">
                                Se connecter
                            </button>
                        </div>

                        <div class="text-center mt-4">
                            <p class="text-sm text-gray-600">Vous n'avez pas de compte ? <a href="./signup.php"
                                    class="text-indigo-500 hover:text-indigo-600 font-medium">S'inscrire</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer Amélioré -->

    <footer class="bg-gradient-to-r from-gray-900 to-black text-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 text-center">
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