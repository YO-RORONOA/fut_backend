<?php
require('../php/config.php');
$nationalitiesQuery = "SELECT id, name FROM nationalities";
$nationalitiesResult = $conn->query($nationalitiesQuery);
$nationalities = [];
if ($nationalitiesResult->num_rows > 0) {
    while ($row = $nationalitiesResult->fetch_assoc()) {
        $nationalities[] = $row;
    }
}
$clubsQuery = "SELECT id, club FROM clubs";
$clubsResult = $conn->query($clubsQuery);
$clubs = [];
if ($clubsResult->num_rows > 0) {
    while ($row = $clubsResult->fetch_assoc()) {
        $clubs[] = $row;
    }
}
                                                                                                                                                                                                                                          
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['nationality']) && isset($_POST['flag'])) {
    
        // Process nationality form
        $nationality = mysqli_real_escape_string($conn, $_POST['nationality']);
        $flag = mysqli_real_escape_string($conn, $_POST['flag']);
        // echo($conn);

        $stmt = $conn->prepare("INSERT INTO nationalities (name, flag) VALUES (?, ?)  ON DUPLICATE KEY UPDATE flag = ?");
        $stmt->bind_param("sss", $nationality, $flag, $flag);
        $stmt->execute();
    } elseif (isset($_POST['club']) && isset($_POST['logo'])) {
        // Process club form
        $club = mysqli_real_escape_string($conn, $_POST['club']);
        $logo = mysqli_real_escape_string($conn, $_POST['logo']);

        $stmt = $conn->prepare("INSERT INTO clubs (club, logo) VALUES (?, ?) ON DUPLICATE KEY UPDATE logo = ?");
        $stmt->bind_param("sss", $club, $logo, $logo);
        $stmt->execute();
    } elseif (isset($_POST['name']) && isset($_POST['position']) && isset($_POST['rating'])) {
        // Process player form
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $position = mysqli_real_escape_string($conn, $_POST['position']);
        $nationality_id = intval($_POST['nationality_id']);
        $club_id = intval($_POST['club_id']);
        $rating = intval($_POST['rating']);
        $photo = mysqli_real_escape_string($conn, $_POST['photo']);

        $stmt = $conn->prepare("INSERT INTO players (name, photo, position, rating, nationality_id, club_id) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssiii", $name, $photo, $position, $rating, $nationality_id, $club_id);

        

        $stmt->execute();
       
        $player_id = $conn->insert_id;

        if ($position === "GK") {
            $diving = intval($_POST['diving'] ?? 0);
            $handling = intval($_POST['handling'] ?? 0);
            $kicking = intval($_POST['kicking'] ?? 0);
            $reflexes = intval($_POST['reflexes'] ?? 0);
            $speed = intval($_POST['speed'] ?? 0);
            $positioning = intval($_POST['positioning'] ?? 0);

            $stmt = $conn->prepare("INSERT INTO goalkeeper (player_id, diving, handling, kicking, reflexes, speed, positioning) 
                                    VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("iiiiiii", $player_id, $diving, $handling, $kicking, $reflexes, $speed, $positioning);
            $stmt->execute();
        } else {
            $pace = intval($_POST['pace'] ?? 0);
            $shooting = intval($_POST['shooting'] ?? 0);
            $passing = intval($_POST['passing'] ?? 0);
            $dribbling = intval($_POST['dribbling'] ?? 0);
            $defending = intval($_POST['defending'] ?? 0);
            $physical = intval($_POST['physical'] ?? 0);

            $stmt = $conn->prepare("INSERT INTO fplayer (player_id, pace, shooting, passing, dribbling, defending, physical) 
                                    VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("iiiiiii", $player_id, $pace, $shooting, $passing, $dribbling, $defending, $physical);
            $stmt->execute();
        }
    }
}
mysqli_close($conn);
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- <script src="https://cdn.tailwindcss.com"></script> -->

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
                    <li><a href="./display.php" class="block px-4 py-2 hover:bg-gray-700">View Players</a></li>
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
                    <!-- Form to Add Nationality -->
            <div class="bg-white shadow-md rounded-lg p-6 mt-6">
                <h3 class="text-xl font-semibold mb-4">Add Nationality</h3>
                <form method="POST" action="form.php" class="space-y-4">
                    <div>
                        <label for="nationality_name" class="block text-sm font-medium">Nationality Name:</label>
                        <input type="text" id="nationality_name" name="nationality" class="mt-1 block w-full border-gray-300 rounded-md" required>
                    </div>
                    <div>
                        <label for="nationality_flag" class="block text-sm font-medium">Flag URL:</label>
                        <input type="url" id="nationality_flag" name="flag" class="mt-1 block w-full border-gray-300 rounded-md" required>
                    </div>
                    <button type="submit" class="w-full bg-blue-500 text-white rounded px-4 py-2">Add Nationality</button>
                </form>
            </div>

             <!-- Form to Add Club -->
             <div class="bg-white shadow-md rounded-lg p-6 mt-6">
                <h3 class="text-xl font-semibold mb-4">Add Club</h3>
                <form method="POST" action="form.php" class="space-y-4">
                    <div>
                        <label for="club_name" class="block text-sm font-medium">Club Name:</label>
                        <input type="text" id="club_name" name="club" class="mt-1 block w-full border-gray-300 rounded-md" required>
                    </div>
                    <div>
                        <label for="club_logo" class="block text-sm font-medium">Logo URL:</label>
                        <input type="url" id="club_logo" name="logo" class="mt-1 block w-full border-gray-300 rounded-md" required>
                    </div>
                    <button type="submit" class="w-full bg-blue-500 text-white rounded px-4 py-2">Add Club</button>
                </form>
            </div>




                    <h3 class="text-xl font-semibold mb-4">Add New Player</h3>
                    <form id="playerForm" class="space-y-4" method="POST" action="form.php">
                    <div>
                            <label for="name" class="block text-sm font-medium text-gray-700">Player Name:</label>
                            <input type="text" id="name" name="name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                        </div>

                        <div>
                            <label for="position" class="block text-sm font-medium text-gray-700">Position:</label>
                            <select id="position" name="position" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
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
                            <label for="player_nationality" class="block text-sm font-medium">Nationality:</label>
                        <select id="player_nationality" name="nationality_id" class="mt-1 block w-full border-gray-300 rounded-md" required>
                            <?php foreach ($nationalities as $nationality): ?>
                                <option value="<?= $nationality['id'] ?>"><?= $nationality['name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div>
                        <label for="player_club" class="block text-sm font-medium">Club:</label>
                        <select id="player_club" name="club_id" class="mt-1 block w-full border-gray-300 rounded-md" required>
                            <?php foreach ($clubs as $club): ?>
                                <option value="<?= $club['id'] ?>"><?= $club['club'] ?></option>
                            <?php endforeach; ?>
                        </select>
                        </div>

                        <div>
                            <label for="rating" class="block text-sm font-medium text-gray-700">Rating:</label>
                            <input type="number" name="rating" id="rating" min="1" max="100" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                        </div>

                        <div>
                            <label for="photo" class="block text-sm font-medium text-gray-700">Photo URL:</label>
                            <input type="url" id="photo" name="photo" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                        </div>

                        <div>
                            <label for="logo" class="block text-sm font-medium text-gray-700">Logo URL:</label>
                            <input type="url" id="logo" name="logo" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                        </div>

                        <div>
                            <label for="flag" class="block text-sm font-medium text-gray-700">Flag URL:</label>
                            <input type="url" id="flag" name="flag" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                        </div>

                        <!-- Outfield player stats -->
                        <div id="outfieldStats" class="hidden">
                            <h4 class="text-md font-semibold mt-4">Outfield Player Stats</h4>
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label for="pace" class="block text-sm font-medium text-gray-700">Pace:</label>
                                    <input type="number" id="pace" name="pace" min="0" max="99" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                </div>
                                <div>
                                    <label for="shooting" class="block text-sm font-medium text-gray-700">Shooting:</label>
                                    <input type="number" id="shooting" name="shooting" min="0" max="99" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                </div>
                                <div>
                                    <label for="passing" class="block text-sm font-medium text-gray-700">Passing:</label>
                                    <input type="number" id="passing" min="0" name="passing" max="99" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                </div>
                                <div>
                                    <label for="dribbling" class="block text-sm font-medium text-gray-700">Dribbling:</label>
                                    <input type="number" id="dribbling" min="0" name="dribbling" max="99" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                </div>
                                <div>
                                    <label for="defending" class="block text-sm font-medium text-gray-700">Defending:</label>
                                    <input type="number" id="defending" min="0" name="defending" max="99" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                </div>
                                <div>
                                    <label for="physical" class="block text-sm font-medium text-gray-700">Physical:</label>
                                    <input type="number" id="physical" min="0" name="physical" max="99" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                </div>
                            </div>
                        </div>

                        <!-- Goalkeeper stats -->
                        <div id="gkStats" class="hidden">
                            <h4 class="text-md font-semibold mt-4">Goalkeeper Stats</h4>
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label for="diving" class="block text-sm font-medium text-gray-700">Diving:</label>
                                    <input type="number" id="diving" name="diving" min="0" max="99" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                </div>
                                <div>
                                    <label for="handling" class="block text-sm font-medium text-gray-700">Handling:</label>
                                    <input type="number" id="handling" name="handling" min="0" max="99" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                </div>
                                <div>
                                    <label for="kicking" class="block text-sm font-medium text-gray-700">Kicking:</label>
                                    <input type="number" id="kicking" name="kicking" min="0" max="99" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                </div>
                                <div>
                                    <label for="reflexes" class="block text-sm font-medium text-gray-700">Reflexes:</label>
                                    <input type="number" id="reflexes" name="reflexes" min="0" max="99" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                </div>
                                <div>
                                    <label for="speed" class="block text-sm font-medium text-gray-700">Speed:</label>
                                    <input type="number" id="speed" min="0" name="speed" max="99" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                </div>
                                <div>
                                    <label for="positioning" class="block text-sm font-medium text-gray-700">Positioning:</label>
                                    <input type="number" id="positioning" min="0" name="positioning" max="99" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                </div>
                            </div>
                            </div>
                        <button type="submit" class="w-full px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Add Player</button>

                    </form>

    <script src="./scripts.js"></script>

</body>
</html>