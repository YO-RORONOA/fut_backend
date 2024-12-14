<?php
include('config.php'); 
?>

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

        <!-- Main Content -->
        <div class="flex-1 flex flex-col">
            <!-- Header -->
            <header class="bg-white shadow-md p-4 flex items-center justify-between">
                <h2 class="text-lg font-semibold">Dashboard</h2>
                <div class="flex items-center space-x-4">
                    <button class="text-sm px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Logout</button>
                </div>
            </header>

            <!-- Content Area -->
            <main class="flex-1 overflow-y-auto p-6">
                <div class="bg-white shadow-md rounded-lg p-6">
                    <h3 class="text-xl font-semibold mb-4">Welcome to the FUT Dashboard</h3>
                    <p class="text-gray-600">Use the navigation menu on the left to manage players, view statistics, and configure settings.</p>

                    <!-- Placeholder Section -->
                    <div class="mt-6 p-4 bg-gray-100 border rounded-lg">
                        <p class="text-gray-500">This is where your dynamic content will appear based on user actions.</p>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <script src="./scripts.js"></script>
</body>
</html>