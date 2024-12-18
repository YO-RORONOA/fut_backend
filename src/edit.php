<?php
include('../php/config.php');
// include('./display.php');

if (isset($_GET['id'])) {
    $player_id = $_GET['id'];  // Get the player ID from the URL
    
    $sql = "SELECT players.id, players.name, players.position, players.rating, players.photo, 
            nationalities.id AS nationality_id, nationalities.flag, nationalities.name as country,
            clubs.id AS club_id, clubs.club, clubs.logo, pace, shooting, passing, dribbling, defending,
            physical, diving, handling, kicking, reflexes, speed, positioning
            FROM players
            JOIN nationalities ON players.nationality_id = nationalities.id
            left join goalkeeper on goalkeeper.player_id = players.id
            left join fplayer on fplayer.player_id = players.id
            JOIN clubs ON players.club_id = clubs.id
            WHERE players.id = $player_id";

        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // $player_id = $_POST['player_id'];
    $player_id = $_GET['id'];
        $name = $_POST['name'];
        $position = $_POST['position'];
        $rating = $_POST['rating'];
        $photo = $_POST['photo'];
        $nationality = $_POST['nationality'];
        $club = $_POST['club'];
        $logo = $_POST['logo'];
        $flag = $_POST['flag'];

        // Specific stats for field players or goalkeepers
        $pace = $_POST['pace'];
        $shooting = $_POST['shooting'];
        $passing = $_POST['passing'];
        $dribbling = $_POST['dribbling'];
        $defending = $_POST['defending'];
        $physical = $_POST['physical'];
        $diving = $_POST['diving'];
        $handling = $_POST['handling'];
        $kicking = $_POST['kicking'];
        $reflexes = $_POST['reflexes'];
        $speed = $_POST['speed'];
        $positioning = $_POST['positioning'];


        // Update the player's basic information
        $stmt = $conn->prepare("UPDATE players SET name = ?, photo = ?, position = ?, rating = ?, nationality_id = ?, club_id = ? WHERE id = ?");
        $stmt->bind_param("sssiiii", $name, $photo, $position, $rating, $row['nationality_id'], $row['club_id'], $player_id);
        
   

        $stmt->execute();

        // Update stats based on position (goalkeeper or field player)
        if ($position === "GK") {
            // Update goalkeeper stats
            $stmt = $conn->prepare("UPDATE goalkeeper SET diving = ?, handling = ?, kicking = ?, reflexes = ?, speed = ?, positioning = ? WHERE player_id = ?");
            $stmt->bind_param("iiiiiii", $diving, $handling, $kicking, $reflexes, $speed, $positioning, $player_id);
            echo $player_id;
            $stmt->execute();
        } else {
            // Update field player stats
            $stmt = $conn->prepare("UPDATE fplayer SET pace = ?, shooting = ?, passing = ?, dribbling = ?, defending = ?, physical = ? WHERE player_id = ?");
            $stmt->bind_param("iiiiiii", $pace, $shooting, $passing, $dribbling, $defending, $physical, $player_id);
            echo $player_id;
            $stmt->execute();
        }
        
exit();
}
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
                    <h3 class="text-xl font-semibold mb-4">Add New Player</h3>
                    <form id="playerForm" class="space-y-4" method="POST" action="edit.php">
                    <input type="hidden" name="player_id" value="<?php echo $player_id; ?>" />
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700">Player Name:</label>
                            <input type="text" id="name" name="name" value="<?php echo $row['name']; ?>" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                        </div>

                        <div>
                            <label for="position" class="block text-sm font-medium text-gray-700">Position:</label>
                            <select id="position" name="position" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                                <option value="ST" <?php echo ($row['position'] == 'ST') ? 'selected' : ''; ?>>Striker</option>
                                <option value="RW" <?php echo ($row['position'] == 'RW') ? 'selected' : ''; ?>>Right Wing</option>
                                <option value="LW" <?php echo ($row['position'] == 'LW') ? 'selected' : ''; ?>>Left Wing</option>
                                <option value="CM" <?php echo ($row['position'] == 'CM') ? 'selected' : ''; ?>>Center Mid</option>
                                <option value="CDM" <?php echo ($row['position'] == 'CDM') ? 'selected' : ''; ?>>Central Defensive Mid</option>
                                <option value="CB" <?php echo ($row['position'] == 'CB') ? 'selected' : ''; ?>>Center Back</option>
                                <option value="GK" <?php echo ($row['position'] == 'GK') ? 'selected' : ''; ?>>Goalkeeper</option>
                                <option value="LB" <?php echo ($row['position'] == 'LB') ? 'selected' : ''; ?>>Left Back</option>
                                <option value="RB" <?php echo ($row['position'] == 'RB') ? 'selected' : ''; ?>>Right Back</option>
                            </select>
                        </div>

                        <div>
                            <label for="nationality" class="block text-sm font-medium text-gray-700">Nationality:</label>
                            <input type="text" name="nationality" value="<?php echo $row['country']; ?>" id="nationality"  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                        </div>

                        <div>
                            <label for="club" class="block text-sm font-medium text-gray-700">Club URL:</label>
                            <input type="url" id="club" name="club" value="<?php echo $row['club']; ?>" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                        </div>

                        <div>
                            <label for="rating" class="block text-sm font-medium text-gray-700">Rating:</label>
                            <input type="number" name="rating" id="rating" value="<?php echo $row['rating']; ?>" min="1" max="100" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                        </div>

                        <div>
                            <label for="photo" class="block text-sm font-medium text-gray-700">Photo URL:</label>
                            <input type="url" id="photo" name="photo" value="<?php echo $row['photo']; ?>" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                        </div>

                        <div>
                            <label for="logo" class="block text-sm font-medium text-gray-700">Logo URL:</label>
                            <input type="url" id="logo" name="logo" value="<?php echo $row['logo']; ?>" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                        </div>

                        <div>
                            <label for="flag" class="block text-sm font-medium text-gray-700">Flag URL:</label>
                            <input type="url" id="flag" name="flag" value="<?php echo $row['flag']; ?>" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                        </div>

                        <!-- Outfield player stats -->
                        <div id="outfieldStats" class="hidden">
                            <h4 class="text-md font-semibold mt-4">Outfield Player Stats</h4>
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label for="pace" class="block text-sm font-medium text-gray-700">Pace:</label>
                                    <input type="number" id="pace" name="pace" value="<?php echo $row['pace']; ?>" min="0" max="99" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                </div>
                                <div>
                                    <label for="shooting" class="block text-sm font-medium text-gray-700">Shooting:</label>
                                    <input type="number" id="shooting" name="shooting" value="<?php echo $row['shooting']; ?>"  min="0" max="99" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                </div>
                                <div>
                                    <label for="passing" class="block text-sm font-medium text-gray-700">Passing:</label>
                                    <input type="number" id="passing" min="0" value="<?php echo $row['passing']; ?>"  name="passing" max="99" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                </div>
                                <div>
                                    <label for="dribbling" class="block text-sm font-medium text-gray-700">Dribbling:</label>
                                    <input type="number" id="dribbling" min="0" value="<?php echo $row['dribbling']; ?>"  name="dribbling" max="99" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                </div>
                                <div>
                                    <label for="defending" class="block text-sm font-medium text-gray-700">Defending:</label>
                                    <input type="number" id="defending" min="0" value="<?php echo $row['defending']; ?>"  name="defending" max="99" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                </div>
                                <div>
                                    <label for="physical" class="block text-sm font-medium text-gray-700">Physical:</label>
                                    <input type="number" id="physical" min="0" value="<?php echo $row['physical']; ?>"  name="physical" max="99" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                </div>
                            </div>
                        </div>

                        <!-- Goalkeeper stats -->
                        <div id="gkStats" class="hidden">
                            <h4 class="text-md font-semibold mt-4">Goalkeeper Stats</h4>
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label for="diving" class="block text-sm font-medium text-gray-700">Diving:</label>
                                    <input type="number" id="diving" value="<?php echo $row['diving']; ?>"  name="diving" min="0" max="99" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                </div>
                                <div>
                                    <label for="handling" class="block text-sm font-medium text-gray-700">Handling:</label>
                                    <input type="number" id="handling" value="<?php echo $row['handling']; ?>"  name="handling" min="0" max="99" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                </div>
                                <div>
                                    <label for="kicking" class="block text-sm font-medium text-gray-700">Kicking:</label>
                                    <input type="number" id="kicking" value="<?php echo $row['kicking']; ?>"  name="kicking" min="0" max="99" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                </div>
                                <div>
                                    <label for="reflexes" class="block text-sm font-medium text-gray-700">Reflexes:</label>
                                    <input type="number" id="reflexes" value="<?php echo $row['reflexes']; ?>"  name="reflexes" min="0" max="99" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                </div>
                                <div>
                                    <label for="speed" class="block text-sm font-medium text-gray-700">Speed:</label>
                                    <input type="number" id="speed" min="0" value="<?php echo $row['speed']; ?>" name="speed" max="99" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                </div>
                                <div>
                                    <label for="positioning" class="block text-sm font-medium text-gray-700">Positioning:</label>
                                    <input type="number" id="positioning" min="0" value="<?php echo $row['positioning']; ?>"  name="positioning" max="99" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                </div>
                            </div>
                            </div>
                        <button type="submit" class="w-full px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">submit change</button>

                    </form>

    <script src="./scripts.js"></script>
    <script>

document.addEventListener('DOMContentLoaded', function () {
    const selectedPosition = document.getElementById('position').value;
    const outfieldStats = document.getElementById('outfieldStats');
    const gkStats = document.getElementById('gkStats');

    if (selectedPosition === 'GK') {
        outfieldStats.style.display = 'none';
        gkStats.style.display = 'block';
    } else {
        outfieldStats.style.display = 'block';
        gkStats.style.display = 'none';
    }
});

    </script>
</body>
</html>


