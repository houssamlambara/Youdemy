<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Catégories - Plateforme de Cours</title>
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
                    <a href="./admin.php" class="flex items-center p-3 hover:bg-indigo-800 rounded-lg">
                        <i class="fas fa-home w-6"></i>
                        <span>Tableau de bord</span>
                    </a>
                    <a href="./addcours.php" class="flex items-center p-3 hover:bg-indigo-800 rounded-lg transition-colors">
                        <i class="fas fa-book w-6"></i>
                        <span>Cours</span>
                    </a>
                    <a href="./etudiant.php" class="flex items-center p-3 hover:bg-indigo-800 rounded-lg transition-colors">
                        <i class="fas fa-users w-6"></i>
                        <span>Étudiants</span>
                    </a>
                    <a href="./enseignant.php" class="flex items-center p-3 hover:bg-indigo-800 rounded-lg transition-colors">
                        <i class="fas fa-chalkboard-teacher w-6"></i>
                        <span>Enseignant</span>
                    </a>
                    <a href="./categorie.php" class="flex items-center p-3 bg-indigo-800 rounded-lg">
                        <i class="fas fa-th-list w-6"></i>
                        <span>Catégories</span>
                    </a>
                    <a href="./statistique.php" class="flex items-center p-3 hover:bg-indigo-800 rounded-lg transition-colors">
                        <i class="fas fa-chart-line w-6"></i>
                        <span>Statistiques</span>
                    </a>
                    <a href="../index.php" class="flex items-center p-3 hover:bg-indigo-800 rounded-lg transition-colors">
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
                    <h1 class="text-2xl font-bold text-gray-800">Gestion des Catégories</h1>
                    <div class="flex items-center gap-4">
                        <button class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 flex items-center gap-2">
                            <i class="fas fa-plus"></i>
                            Ajouter une Catégorie
                        </button>
                        <div class="flex items-center gap-2">
                            <img src="/api/placeholder/40/40" alt="Profile" class="w-10 h-10 rounded-full">
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
                            <th class="px-6 py-3 text-left text-gray-600">Nom de la Catégorie</th>
                            <th class="px-6 py-3 text-left text-gray-600">Nombre de Cours</th>
                            <th class="px-6 py-3 text-left text-gray-600">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Category 1 -->
                        <tr class="border-b">
                            <td class="px-6 py-3">Développement Web</td>
                            <td class="px-6 py-3">82</td>
                            <td class="px-6 py-3">
                                <button class="text-indigo-600 hover:underline">
                                    <i class="fas fa-edit"></i> Modifier
                                </button>
                                <button class="ml-4 text-red-600 hover:underline">
                                    <i class="fas fa-trash-alt"></i> Supprimer
                                </button>
                            </td>
                        </tr>
                        <!-- Category 2 -->
                        <tr class="border-b">
                            <td class="px-6 py-3">Design</td>
                            <td class="px-6 py-3">54</td>
                            <td class="px-6 py-3">
                                <button class="text-indigo-600 hover:underline">
                                    <i class="fas fa-edit"></i> Modifier
                                </button>
                                <button class="ml-4 text-red-600 hover:underline">
                                    <i class="fas fa-trash-alt"></i> Supprimer
                                </button>
                            </td>
                        </tr>
                        <!-- Category 3 -->
                        <tr class="border-b">
                            <td class="px-6 py-3">Marketing Digital</td>
                            <td class="px-6 py-3">45</td>
                            <td class="px-6 py-3">
                                <button class="text-indigo-600 hover:underline">
                                    <i class="fas fa-edit"></i> Modifier
                                </button>
                                <button class="ml-4 text-red-600 hover:underline">
                                    <i class="fas fa-trash-alt"></i> Supprimer
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </main>
        </div>
    </div>
</body>

</html>