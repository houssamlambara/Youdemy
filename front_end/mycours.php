<?php 
require_once('../classes/class_etudiant.php');
session_start();
// if(!isset($_SESSION['id_user']) || $_SESSION['role']!=3){
//     header('location: ./signin.php');
// }

$etudiant= new Student($_SESSION['id_user'],null,$_SESSION['username'],$_SESSION['email'],$_SESSION['role']);
$cours=$etudiant->getcoursStudent();

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Cours - Youdemy</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/js/all.min.js"></script>
</head>
<body class="bg-gray-50">
    <!-- Navigation -->
    <nav class="bg-white shadow">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center">
                    <div class="text-2xl font-bold text-indigo-600">Youdemy</div>
                </div>
                <div class="flex items-center space-x-4">
                    <div class="relative">
                        <input type="text" placeholder="Rechercher un cours..." 
                            class="w-64 px-4 py-2 rounded-lg border focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        <i class="fas fa-search absolute right-3 top-3 text-gray-400"></i>
                    </div>
                    <div class="flex items-center space-x-3">
                        <img src="/api/placeholder/32/32" alt="Profile" class="h-8 w-8 rounded-full">
                        <span class="text-gray-700">John Doe</span>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Mes Cours</h1>
        </div>

        <!-- Course Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Course Card 1 -->
             <?php 
              foreach($cours as $cour){
             
             ?>
            <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                <div class="relative">
                    <img src="<?=$cour['image_url']?>" alt="Course thumbnail" class="w-full h-48 object-cover">
                    <div class="absolute top-2 right-2 bg-green-500 text-white px-2 py-1 rounded text-sm">
                        En cours
                    </div>
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-semibold mb-2"><?=$cour["titre"]?></h3>
                    <p class="text-gray-600 mb-4 line-clamp-2"><?=$cour["description"]?></p>
                    <div class="flex justify-between items-center">
                        <div class="flex items-center space-x-2">
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-indigo-600 h-2 rounded-full" style="width: 45%"></div>
                            </div>
                            <span class="text-sm text-gray-600">45%</span>
                        </div>
                        <a href="#" class="text-indigo-600 hover:text-indigo-800">Lire cours</a>
                    </div>
                </div>
            </div>
            <?php } ?>

            <!-- Course Card 2 -->
            
        </div>
    </main>
</body>
</html>