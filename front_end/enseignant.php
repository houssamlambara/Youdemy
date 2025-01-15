<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Enseignants - Admin</title>
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
                    <a href="./admin.php" class="flex items-center p-3 bg-indigo-800 rounded-lg hover:bg-indigo-900 transition-colors">
                        <i class="fas fa-home w-6"></i>
                        <span>Tableau de bord</span>
                    </a>
                    <a href="./enseignant.php" class="flex items-center p-3 hover:bg-indigo-800 rounded-lg transition-colors">
                        <i class="fas fa-chalkboard-teacher w-6"></i>
                        <span>Enseignant</span>
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
                    <h1 class="text-2xl font-bold text-gray-800">Gestion des Enseignants</h1>
                    <div class="flex items-center gap-4">
                        <button class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 flex items-center gap-2">
                            <i class="fas fa-plus"></i>
                            Ajouter un Enseignant
                        </button>
                        <div class="flex items-center gap-2">
                            <img src="/api/placeholder/40/40" alt="Profile" class="w-10 h-10 rounded-full">
                            <span class="font-medium">Admin</span>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Teachers Content -->
            <main class="p-8">
                <!-- Quick Stats -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
                    <div class="bg-white rounded-lg shadow p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-500">Total Enseignants</p>
                                <h3 class="text-2xl font-bold">42</h3>
                            </div>
                            <div class="w-12 h-12 bg-indigo-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-chalkboard-teacher text-indigo-600 text-xl"></i>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white rounded-lg shadow p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-500">Cours Actifs</p>
                                <h3 class="text-2xl font-bold">156</h3>
                            </div>
                            <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-book-open text-green-600 text-xl"></i>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white rounded-lg shadow p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-500">Étudiants Total</p>
                                <h3 class="text-2xl font-bold">4,521</h3>
                            </div>
                            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-users text-blue-600 text-xl"></i>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white rounded-lg shadow p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-500">Satisfaction</p>
                                <h3 class="text-2xl font-bold">4.8/5</h3>
                            </div>
                            <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-star text-yellow-600 text-xl"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Filters -->
                <div class="bg-white rounded-lg shadow mb-6 p-6">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Rechercher</label>
                            <div class="relative">
                                <input type="text" placeholder="Nom ou spécialité..."
                                    class="w-full pl-10 pr-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Spécialité</label>
                            <select class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                <option>Toutes les spécialités</option>
                                <option>Développement Web</option>
                                <option>Design</option>
                                <option>Marketing</option>
                                <option>Business</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Statut</label>
                            <select class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                <option>Tous les statuts</option>
                                <option>Actif</option>
                                <option>En congé</option>
                                <option>Inactif</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Note</label>
                            <select class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                <option>Toutes les notes</option>
                                <option>4.5+</option>
                                <option>4.0+</option>
                                <option>3.5+</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Teachers List -->
                <div class="bg-white rounded-lg shadow">
                    <div class="p-6 border-b">
                        <h2 class="text-xl font-bold">Liste des Enseignants</h2>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            <!-- Teacher Card 1 -->
                            <div class="bg-white border rounded-lg overflow-hidden">
                                <div class="p-6">
                                    <div class="flex justify-between items-start">
                                        <div class="flex items-center gap-4">
                                            <img src="/api/placeholder/64/64" alt="Teacher" class="w-16 h-16 rounded-full">
                                            <div>
                                                <h3 class="font-bold text-lg">Dr. Michel Dupont</h3>
                                                <p class="text-gray-500">Développement Web</p>
                                                <div class="flex items-center mt-1">
                                                    <i class="fas fa-star text-yellow-400"></i>
                                                    <span class="ml-1">4.9</span>
                                                    <span class="text-gray-500 text-sm ml-1">(128 avis)</span>
                                                </div>
                                            </div>
                                        </div>
                                        <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-sm">
                                            Actif
                                        </span>
                                    </div>
                                    <div class="mt-6 space-y-2">
                                        <div class="flex justify-between text-sm">
                                            <span class="text-gray-500">Cours actifs</span>
                                            <span class="font-medium">8</span>
                                        </div>
                                        <div class="flex justify-between text-sm">
                                            <span class="text-gray-500">Étudiants total</span>
                                            <span class="font-medium">1,245</span>
                                        </div>
                                        <div class="flex justify-between text-sm">
                                            <span class="text-gray-500">Taux de complétion</span>
                                            <span class="font-medium">92%</span>
                                        </div>
                                    </div>
                                    <div class="mt-6 flex gap-2">
                                        <button class="flex-1 bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700">
                                            Voir le profil
                                        </button>
                                        <button class="p-2 text-gray-600 hover:text-gray-800 border rounded-lg">
                                            <i class="fas fa-envelope"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Teacher Card 2 -->
                            <div class="bg-white border rounded-lg overflow-hidden">
                                <div class="p-6">
                                    <div class="flex justify-between items-start">
                                        <div class="flex items-center gap-4">
                                            <img src="/api/placeholder/64/64" alt="Teacher" class="w-16 h-16 rounded-full">
                                            <div>
                                                <h3 class="font-bold text-lg">Sarah Martin</h3>
                                                <p class="text-gray-500">Design UI/UX</p>
                                                <div class="flex items-center mt-1">
                                                    <i class="fas fa-star text-yellow-400"></i>
                                                    <span class="ml-1">4.8</span>
                                                    <span class="text-gray-500 text-sm ml-1">(96 avis)</span>
                                                </div>
                                            </div>
                                        </div>
                                        <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-sm">
                                            Actif
                                        </span>
                                    </div>
                                    <div class="mt-6 space-y-2">
                                        <div class="flex justify-between text-sm">
                                            <span class="text-gray-500">Cours actifs</span>
                                            <span class="font-medium">6</span>
                                        </div>
                                        <div class="flex justify-between text-sm">
                                            <span class="text-gray-500">Étudiants total</span>
                                            <span class="font-medium">856</span>
                                        </div>
                                        <div class="flex justify-between text-sm">
                                            <span class="text-gray-500">Taux de complétion</span>
                                            <span class="font-medium">88%</span>
                                        </div>
                                    </div>
                                    <div class="mt-6 flex gap-2">
                                        <button class="flex-1 bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700">
                                            Voir le profil
                                        </button>
                                        <button class="p-2 text-gray-600 hover:text-gray-800 border rounded-lg">
                                            <i class="fas fa-envelope"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Teacher Card 3 -->
                            <div class="bg-white border rounded-lg overflow-hidden">
                                <div class="p-6">
                                    <div class="flex justify-between items-start">
                                        <div class="flex items-center gap-4">
                                            <img src="/api/placeholder/64/64" alt="Teacher" class="w-16 h-16 rounded-full">
                                            <div>
                                                <h3 class="font-bold text-lg">Pierre Durand</h3>
                                                <p class="text-gray-500">Marketing Digital</p>
                                                <div class="flex items-center mt-1">
                                                    <i class="fas fa-star text-yellow-400"></i>
                                                    <span class="ml-1">4.7</span>
                                                    <span class="text-gray-500 text-sm ml-1">(84 avis)</span>
                                                </div>
                                            </div>
                                        </div>
                                        <span class="px-3 py-1 bg-yellow-100 text-yellow-700 rounded-full text-sm">
                                            En congé
                                        </span>
                                    </div>
                                    <div class="mt-6 space-y-2">
                                        <div class="flex justify-between text-sm">
                                            <span class="text-gray-500">Cours actifs</span>
                                            <span class="font-medium">4</span>
                                        </div>
                                        <div class="flex justify-between text-sm">
                                            <span class="text-gray-500">Étudiants total</span>
                                            <span class="font-medium">640</span>
                                        </div>
                                        <div class="flex justify-between text-sm">
                                            <span class="text-gray-500">Taux de complétion</span>
                                            <span class="font-medium">80%</span>
                                        </div>
                                    </div>
                                    <div class="mt-6 flex gap-2">
                                        <button class="flex-1 bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700">
                                            Voir le profil
                                        </button>
                                        <button class="p-2 text-gray-600 hover:text-gray-800 border rounded-lg">
                                            <i class="fas fa-envelope"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Teacher Card 4 -->
                            <div class="bg-white border rounded-lg overflow-hidden">
                                <div class="p-6">
                                    <div class="flex justify-between items-start">
                                        <div class="flex items-center gap-4">
                                            <img src="/api/placeholder/64/64" alt="Teacher" class="w-16 h-16 rounded-full">
                                            <div>
                                                <h3 class="font-bold text-lg">Claire Leroy</h3>
                                                <p class="text-gray-500">Photographie et Vidéo</p>
                                                <div class="flex items-center mt-1">
                                                    <i class="fas fa-star text-yellow-400"></i>
                                                    <span class="ml-1">4.6</span>
                                                    <span class="text-gray-500 text-sm ml-1">(76 avis)</span>
                                                </div>
                                            </div>
                                        </div>
                                        <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-sm">
                                            Actif
                                        </span>
                                    </div>
                                    <div class="mt-6 space-y-2">
                                        <div class="flex justify-between text-sm">
                                            <span class="text-gray-500">Cours actifs</span>
                                            <span class="font-medium">5</span>
                                        </div>
                                        <div class="flex justify-between text-sm">
                                            <span class="text-gray-500">Étudiants total</span>
                                            <span class="font-medium">512</span>
                                        </div>
                                        <div class="flex justify-between text-sm">
                                            <span class="text-gray-500">Taux de complétion</span>
                                            <span class="font-medium">85%</span>
                                        </div>
                                    </div>
                                    <div class="mt-6 flex gap-2">
                                        <button class="flex-1 bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700">
                                            Voir le profil
                                        </button>
                                        <button class="p-2 text-gray-600 hover:text-gray-800 border rounded-lg">
                                            <i class="fas fa-envelope"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Teacher Card 5 -->
                            <div class="bg-white border rounded-lg overflow-hidden">
                                <div class="p-6">
                                    <div class="flex justify-between items-start">
                                        <div class="flex items-center gap-4">
                                            <img src="/api/placeholder/64/64" alt="Teacher" class="w-16 h-16 rounded-full">
                                            <div>
                                                <h3 class="font-bold text-lg">Sophie Moreau</h3>
                                                <p class="text-gray-500">Gestion de projet</p>
                                                <div class="flex items-center mt-1">
                                                    <i class="fas fa-star text-yellow-400"></i>
                                                    <span class="ml-1">4.5</span>
                                                    <span class="text-gray-500 text-sm ml-1">(50 avis)</span>
                                                </div>
                                            </div>
                                        </div>
                                        <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-sm">
                                            Actif
                                        </span>
                                    </div>
                                    <div class="mt-6 space-y-2">
                                        <div class="flex justify-between text-sm">
                                            <span class="text-gray-500">Cours actifs</span>
                                            <span class="font-medium">7</span>
                                        </div>
                                        <div class="flex justify-between text-sm">
                                            <span class="text-gray-500">Étudiants total</span>
                                            <span class="font-medium">900</span>
                                        </div>
                                        <div class="flex justify-between text-sm">
                                            <span class="text-gray-500">Taux de complétion</span>
                                            <span class="font-medium">91%</span>
                                        </div>
                                    </div>
                                    <div class="mt-6 flex gap-2">
                                        <button class="flex-1 bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700">
                                            Voir le profil
                                        </button>
                                        <button class="p-2 text-gray-600 hover:text-gray-800 border rounded-lg">
                                            <i class="fas fa-envelope"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>