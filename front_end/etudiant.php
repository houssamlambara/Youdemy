<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Étudiants - Admin</title>
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
                    <a href="./admin.php" class="flex items-center p-3 bg-indigo-800 rounded-lg">
                        <i class="fas fa-home w-6"></i>
                        <span>Tableau de bord</span>
                    </a>
                    <a href="./cours.php" class="flex items-center p-3 hover:bg-indigo-800 rounded-lg transition-colors">
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
                    <a href="./statistique.php" class="flex items-center p-3 hover:bg-indigo-800 rounded-lg transition-colors">
                        <i class="fas fa-chart-line w-6"></i>
                        <span>Statistiques</span>
                    </a>
                    <a href="#" class="flex items-center p-3 hover:bg-indigo-800 rounded-lg transition-colors">
                        <i class="fas fa-cog w-6"></i>
                        <span>Paramètres</span>
                    </a>
                </div>
            </nav>
        </aside>

        <!-- Main Content -->
        <div class="flex-1">
            <!-- Top Navigation -->
            <header class="bg-white shadow">
                <div class="flex justify-between items-center px-8 py-4">
                    <h1 class="text-2xl font-bold text-gray-800">Gestion des Étudiants</h1>
                    <div class="flex items-center gap-4">
                        <button class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 flex items-center gap-2">
                            <i class="fas fa-plus"></i>
                            Ajouter un Étudiant
                        </button>
                        <button class="relative text-gray-500 hover:text-gray-700">
                            <i class="fas fa-bell text-xl"></i>
                            <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full w-4 h-4 flex items-center justify-center">3</span>
                        </button>
                        <div class="flex items-center gap-2">
                            <img src="/api/placeholder/40/40" alt="Profile" class="w-10 h-10 rounded-full">
                            <span class="font-medium">Admin</span>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Students Content -->
            <main class="p-8">
                <!-- Quick Stats -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
                    <div class="bg-white rounded-lg shadow p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-500">Total Étudiants</p>
                                <h3 class="text-2xl font-bold">2,451</h3>
                            </div>
                            <div class="w-12 h-12 bg-indigo-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-users text-indigo-600 text-xl"></i>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white rounded-lg shadow p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-500">Actifs ce mois</p>
                                <h3 class="text-2xl font-bold">1,845</h3>
                            </div>
                            <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-user-check text-green-600 text-xl"></i>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white rounded-lg shadow p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-500">Nouveaux</p>
                                <h3 class="text-2xl font-bold">245</h3>
                            </div>
                            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-user-plus text-blue-600 text-xl"></i>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white rounded-lg shadow p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-500">Taux de complétion</p>
                                <h3 class="text-2xl font-bold">78%</h3>
                            </div>
                            <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-chart-line text-yellow-600 text-xl"></i>
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
                                <input type="text" placeholder="Nom ou email..."
                                    class="w-full pl-10 pr-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Statut</label>
                            <select class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                <option>Tous les statuts</option>
                                <option>Actif</option>
                                <option>Inactif</option>
                                <option>En pause</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Date d'inscription</label>
                            <select class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                <option>Toutes les dates</option>
                                <option>Cette semaine</option>
                                <option>Ce mois</option>
                                <option>Cette année</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Progression</label>
                            <select class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                <option>Toutes</option>
                                <option>0-25%</option>
                                <option>26-50%</option>
                                <option>51-75%</option>
                                <option>76-100%</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Students List -->
                <div class="bg-white rounded-lg shadow">
                    <div class="p-6 border-b">
                        <h2 class="text-xl font-bold">Liste des Étudiants</h2>
                    </div>
                    <div class="p-6">
                        <table class="w-full">
                            <thead>
                                <tr class="text-left text-gray-500 border-b">
                                    <th class="pb-4">Étudiant</th>
                                    <th class="pb-4">Email</th>
                                    <th class="pb-4">Cours inscrits</th>
                                    <th class="pb-4">Progression</th>
                                    <th class="pb-4">Statut</th>
                                    <th class="pb-4">Dernière connexion</th>
                                    <th class="pb-4">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y">
                                <tr>
                                    <td class="py-4">
                                        <div class="flex items-center gap-3">
                                            <img src="/api/placeholder/40/40" alt="Student" class="w-10 h-10 rounded-full">
                                            <div>
                                                <p class="font-medium">Thomas Martin</p>
                                                <p class="text-sm text-gray-500">Inscrit le 12 Jan 2024</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>thomas.martin@email.com</td>
                                    <td>4 cours</td>
                                    <td>
                                        <div class="flex items-center gap-2">
                                            <div class="w-24 bg-gray-200 rounded-full h-2">
                                                <div class="bg-green-500 rounded-full h-2" style="width: 75%"></div>
                                            </div>
                                            <span>75%</span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-sm">
                                            Actif
                                        </span>
                                    </td>
                                    <td>Il y a 2 heures</td>
                                    <td>
                                        <div class="flex gap-2">
                                            <button class="p-2 text-blue-600 hover:text-blue-800">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button class="p-2 text-indigo-600 hover:text-indigo-800">
                                                <i class="fas fa-envelope"></i>
                                            </button>
                                            <button class="p-2 text-gray-600 hover:text-gray-800">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="py-4">
                                        <div class="flex items-center gap-3">
                                            <img src="/api/placeholder/40/40" alt="Student" class="w-10 h-10 rounded-full">
                                            <div>
                                                <p class="font-medium">Marie Dubois</p>
                                                <p class="text-sm text-gray-500">Inscrite le 5 Jan 2024</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>marie.dubois@email.com</td>
                                    <td>6 cours</td>
                                    <td>
                                        <div class="flex items-center gap-2">
                                            <div class="w-24 bg-gray-200 rounded-full h-2">
                                                <div class="bg-green-500 rounded-full h-2" style="width: 90%"></div>
                                            </div>
                                            <span>90%</span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-sm">
                                            Actif
                                        </span>
                                    </td>
                                    <td>Il y a 1 jour</td>
                                    <td>
                                        <div class="flex gap-2">
                                            <button class="p-2 text-blue-600 hover:text-blue-800">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button class="p-2 text-indigo-600 hover:text-indigo-800">
                                                <i class="fas fa-envelope"></i>
                                            </button>
                                            <button class="p-2 text-gray-600 hover:text-gray-800">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="py-4">
                                        <div class="flex items-center gap-3">
                                            <img src="/api/placeholder/40/40" alt="Student" class="w-10 h-10 rounded-full">
                                            <div>
                                                <p class="font-medium">Paul Bernard</p>
                                                <p class="text-sm text-gray-500">Inscrit le 28 Déc 2023</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>paul.bernard@email.com</td>
                                    <td>2 cours</td>
                                    <td>
                                        <div class="flex items-center gap-2">
                                            <div class="w-24 bg-gray-200 rounded-full h-2">
                                                <div class="bg-yellow-500 rounded-full h-2" style="width: 45%"></div>
                                            </div>
                                            <span>45%</span>
                                    </td>
                                    <td>
                                        <span class="px-3 py-1 bg-yellow-100 text-yellow-700 rounded-full text-sm">
                                            En pause
                                        </span>
                                    </td>
                                    <td>Il y a 5 jours</td>
                                    <td>
                                        <div class="flex gap-2">
                                            <button class="p-2 text-blue-600 hover:text-blue-800">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button class="p-2 text-indigo-600 hover:text-indigo-800">
                                                <i class="fas fa-envelope"></i>
                                            </button>
                                            <button class="p-2 text-gray-600 hover:text-gray-800">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="py-4">
                                        <div class="flex items-center gap-3">
                                            <img src="/api/placeholder/40/40" alt="Student" class="w-10 h-10 rounded-full">
                                            <div>
                                                <p class="font-medium">Sophie Lefevre</p>
                                                <p class="text-sm text-gray-500">Inscrite le 20 Nov 2023</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>sophie.lefevre@email.com</td>
                                    <td>3 cours</td>
                                    <td>
                                        <div class="flex items-center gap-2">
                                            <div class="w-24 bg-gray-200 rounded-full h-2">
                                                <div class="bg-red-500 rounded-full h-2" style="width: 30%"></div>
                                            </div>
                                            <span>30%</span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="px-3 py-1 bg-red-100 text-red-700 rounded-full text-sm">
                                            Inactif
                                        </span>
                                    </td>
                                    <td>Il y a 10 jours</td>
                                    <td>
                                        <div class="flex gap-2">
                                            <button class="p-2 text-blue-600 hover:text-blue-800">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button class="p-2 text-indigo-600 hover:text-indigo-800">
                                                <i class="fas fa-envelope"></i>
                                            </button>
                                            <button class="p-2 text-gray-600 hover:text-gray-800">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="py-4">
                                        <div class="flex items-center gap-3">
                                            <img src="/api/placeholder/40/40" alt="Student" class="w-10 h-10 rounded-full">
                                            <div>
                                                <p class="font-medium">Élodie Moreau</p>
                                                <p class="text-sm text-gray-500">Inscrite le 14 Jan 2024</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>elodie.moreau@email.com</td>
                                    <td>5 cours</td>
                                    <td>
                                        <div class="flex items-center gap-2">
                                            <div class="w-24 bg-gray-200 rounded-full h-2">
                                                <div class="bg-green-500 rounded-full h-2" style="width: 80%"></div>
                                            </div>
                                            <span>80%</span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-sm">
                                            Actif
                                        </span>
                                    </td>
                                    <td>Il y a 1 semaine</td>
                                    <td>
                                        <div class="flex gap-2">
                                            <button class="p-2 text-blue-600 hover:text-blue-800">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button class="p-2 text-indigo-600 hover:text-indigo-800">
                                                <i class="fas fa-envelope"></i>
                                            </button>
                                            <button class="p-2 text-gray-600 hover:text-gray-800">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>