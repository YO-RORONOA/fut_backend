<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="./output.css" rel="stylesheet">
</head>
<body class="bg-gray-100 min-h-screen">
    <!-- Main Container -->
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <aside class="bg-gray-800 text-white w-64 flex-shrink-0">
            <div class="p-4">
                <h1 class="text-xl font-bold">FUT Dashboard</h1>
            </div>
            <nav class="mt-6">
                <ul class="space-y-2">
                    <li><a href="./form.php" class="block px-4 py-2 hover:bg-gray-700">Add Player</a></li>
                    <li><a href="#" class="block px-4 py-2 hover:bg-gray-700">View Players</a></li>
                    <li><a href="#" class="block px-4 py-2 hover:bg-gray-700">Statistics</a></li>
                    <li><a href="#" class="block px-4 py-2 hover:bg-gray-700">Settings</a></li>
                </ul>
            </nav>
        </aside>
        <div class="flex-1 flex flex-col">
            <!-- Header -->
            <header class="bg-white shadow-md p-4 flex items-center justify-between">
                <h2 class="text-lg font-semibold">Dashboard</h2>
                <div class="flex items-center space-x-4">
                    <button class="text-sm px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Logout</button>
                </div>
            </header>
<main class="flex-1 overflow-y-auto p-6">
                <div class="bg-white shadow-md rounded-lg p-6">
                    <h3 class="text-xl font-semibold mb-4">Add New Player</h3>
                    <form id="playerForm" class="space-y-4">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700">Player Name:</label>
                            <input type="text" id="name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                        </div>

                        <div>
                            <label for="position" class="block text-sm font-medium text-gray-700">Position:</label>
                            <select id="position" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                                <option value="ST">Striker</option>
                                <option value="RW">Right Wing</option>
                                <option value="LW">Left Wing</option>
                                <option value="CM">Center Mid</option>
                                <option value="CDM">Central Defensive Mid</option>
                                <option value="CB">Center Back</option>
                                <option value="GK">Goalkeeper</option>
                                <option value="LB">Left Back</option>
                                <option value="RB">Right Back</option>
                            </select>
                        </div>

                        <div>
                            <label for="nationality" class="block text-sm font-medium text-gray-700">Nationality:</label>
                            <input type="text" id="nationality" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                        </div>

                        <div>
                            <label for="club" class="block text-sm font-medium text-gray-700">Club URL:</label>
                            <input type="url" id="club" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                        </div>

                        <div>
                            <label for="rating" class="block text-sm font-medium text-gray-700">Rating:</label>
                            <input type="number" id="rating" min="1" max="100" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                        </div>

                        <div>
                            <label for="photo" class="block text-sm font-medium text-gray-700">Photo URL:</label>
                            <input type="url" id="photo" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                        </div>

                        <div>
                            <label for="logo" class="block text-sm font-medium text-gray-700">Logo URL:</label>
                            <input type="url" id="logo" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                        </div>

                        <div>
                            <label for="flag" class="block text-sm font-medium text-gray-700">Flag URL:</label>
                            <input type="url" id="flag" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                        </div>

                        <!-- Outfield player stats -->
                        <div id="outfieldStats" class="hidden">
                            <h4 class="text-md font-semibold mt-4">Outfield Player Stats</h4>
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label for="pace" class="block text-sm font-medium text-gray-700">Pace:</label>
                                    <input type="number" id="pace" min="0" max="99" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                </div>
                                <div>
                                    <label for="shooting" class="block text-sm font-medium text-gray-700">Shooting:</label>
                                    <input type="number" id="shooting" min="0" max="99" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                </div>
                                <div>
                                    <label for="passing" class="block text-sm font-medium text-gray-700">Passing:</label>
                                    <input type="number" id="passing" min="0" max="99" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                </div>
                                <div>
                                    <label for="dribbling" class="block text-sm font-medium text-gray-700">Dribbling:</label>
                                    <input type="number" id="dribbling" min="0" max="99" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                </div>
                                <div>
                                    <label for="defending" class="block text-sm font-medium text-gray-700">Defending:</label>
                                    <input type="number" id="defending" min="0" max="99" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                </div>
                                <div>
                                    <label for="physical" class="block text-sm font-medium text-gray-700">Physical:</label>
                                    <input type="number" id="physical" min="0" max="99" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                </div>
                            </div>
                        </div>

                        <!-- Goalkeeper stats -->
                        <div id="gkStats" class="hidden">
                            <h4 class="text-md font-semibold mt-4">Goalkeeper Stats</h4>
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label for="diving" class="block text-sm font-medium text-gray-700">Diving:</label>
                                    <input type="number" id="diving" min="0" max="99" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                </div>
                                <div>
                                    <label for="handling" class="block text-sm font-medium text-gray-700">Handling:</label>
                                    <input type="number" id="handling" min="0" max="99" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                </div>
                                <div>
                                    <label for="kicking" class="block text-sm font-medium text-gray-700">Kicking:</label>
                                    <input type="number" id="kicking" min="0" max="99" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                </div>
                                <div>
                                    <label for="reflexes" class="block text-sm font-medium text-gray-700">Reflexes:</label>
                                    <input type="number" id="reflexes" min="0" max="99" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                </div>
                                <div>
                                    <label for="speed" class="block text-sm font-medium text-gray-700">Speed:</label>
                                    <input type="number" id="speed" min="0" max="99" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                </div>
                                <div>
                                    <label for="positioning" class="block text-sm font-medium text-gray-700">Positioning:</label>
                                    <input type="number" id="positioning" min="0" max="99" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                </div>
                            </div>
                            </div>
                        <button type="submit" class="w-full px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Add Player</button>

                    </form>

    <script src="./scripts.js"></script>

</body>
</html>