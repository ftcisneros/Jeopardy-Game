<?php
session_start();

if (!isset($_SESSION['player'])) {
    header('Location: homepage.html');
    exit;
}

include('functions.php');
$playerName = $_SESSION['player'];
$totalPoints = getTotalPts();

//write player name and points to the file
$file = 'leaderboard.txt';
$entry = $playerName . ' ' . $totalPoints . "\n";

file_put_contents($file, $entry, FILE_APPEND);

header('Location: leaderboard.php');
exit;
?>
