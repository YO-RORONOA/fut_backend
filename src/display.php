<?php
include('./config.php');

$sql = " SELECT players.id, players.name, players.position, players.rating, players.photo, nationalities.flag as flag, clubs.club as club
        FROM players
        JOIN nationalities ON players.nationality_id = nationalities.id
        JOIN clubs ON players.club_id = clubs.id";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Players List</title>
    <link href="./output.css" rel="stylesheet">
</head>
<body class="bg-gray-100 min-h-screen">
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <aside class="bg-gray-800 text-white w-64 flex-shrink-0">
            <div class="p-4">
                <h1 class="text-xl font-bold">FUT Dashboard</h1>
            </div>
            <nav class="mt-6">
                <ul class="space-y-2">
                    <li><a href="./form.php" class="block px-4 py-2 hover:bg-gray-700">Add Player</a></li>
                    <li><a href="./display.php" class="block px-4 py-2 hover:bg-gray-700">View Players</a></li>
                    <li><a href="#" class="block px-4 py-2 hover:bg-gray-700">Statistics</a></li>
                    <li><a href="#" class="block px-4 py-2 hover:bg-gray-700">Settings</a></li>
                </ul>
            </nav>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col">
            <header class="bg-white shadow-md p-4 flex items-center justify-between">
                <h2 class="text-lg font-semibold">Players List</h2>
                <div class="flex items-center space-x-4">
                    <button class="text-sm px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Logout</button>
                </div>
            </header>

            <!-- Table Content -->
            <main class="flex-1 p-4 overflow-scroll">
                <div class="overflow-x-auto bg-white shadow-md rounded-lg">
                    <table class="min-w-full table-auto">
                        <thead class="bg-gray-200">
                            <tr>
                                <th class="px-4 py-2 text-left">Player</th>
                                <th class="px-4 py-2 text-left">Photo</th>
                                <th class="px-4 py-2 text-left">Flag</th>
                                <th class="px-4 py-2 text-left">Club</th>
                                <th class="px-4 py-2 text-left">Position</th>
                                <th class="px-4 py-2 text-left">Rating</th>
                                <th class="px-4 py-2 text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>

                        <?php
                        // Loop through the results and display them in rows
                        while ($row = $result->fetch_assoc()) {
                            echo '  
                            <tr class="border-b">
                                <td class="px-4 py-2">' . $row['name'] . '</td>
                                <td class="px-4 py-2"><img src="' . $row['photo'] . '" alt="Player Photo" class="w-12 h-12 rounded-full object-cover"></td>
                                <td class="px-4 py-2"><img src="' . $row['flag'] . '" alt="Flag" class="w-12 h-8 object-cover"></td>
                                <td class="px-4 py-2"><img src="' . $row['club'] . '" alt="Flag" class="w-12 h-8 object-cover"></td>
                                <td class="px-4 py-2">' . $row['position'] . '</td>
                                <td class="px-4 py-2">' . $row['rating'] . '</td>
                                <td class="px-4 py-2 text-center">
                                <a href="edit.php?id=' . $row['id'] . '" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">Edit</a>
                                    <button class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Delete</button>
                                </td>
                            </tr>';
                            
                        }

                        ?>

                        </tbody>
                    </table>
                </div>
            </main>
        </div>
    </div>
</body>
</html>

