<?php
$file = 'leaderboard.txt';
$leaderboard = file($file, FILE_IGNORE_NEW_LINES);

//convert leaderboard data into an array
$players = [];
foreach ($leaderboard as $entry) {
    list($username, $points) = explode(' ', $entry);
    $players[] = ['username' => $username, 'points' => (int)$points];
}

//sort players by points in descending order
usort($players, function($a, $b) {
    return $b['points'] - $a['points']; //Sort descending by points
});

//get top 3 players
$topPlayers = array_slice($players, 0, 3);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leaderboard</title>
    <link rel="stylesheet" href="leaderboard.css">
</head>
<body>
    <h1>Leaderboard</h1>
    <table>
        <tr>
            <th>Rank</th>
            <th>Player</th>
            <th>Points</th>
        </tr>

        <?php
        $rank = 1;
        foreach ($topPlayers as $player) {
            echo "<tr>
                    <td>{$rank}</td>
                    <td>{$player['username']}</td>
                    <td>\${$player['points']}</td>
                  </tr>";
            $rank++;
        }
        ?>

    </table>
    <br>
    <a class="button" href ="logout.php">Logout</a>
</body>
</html>
