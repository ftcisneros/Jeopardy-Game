<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jeopardy</title>
    <link rel="stylesheet" href="categories.css">
</head>
<body>
    <div>
        <img src="logo/jeopardylogo.png" alt="Jeopardy logo">
    </div>
    
    <?php
    session_start();
    include('functions.php');

    $_SESSION["player"];
    if (!isset($_SESSION['player'])){
        header('Location: homepage.html');
    } else{
        $pluspts = '';
        $minuspts = '';
        $totalPoint = getTotalPts();
        $questionValue = getPtsVal();
        $_SESSION['max'] = $totalPoint;
        if ($questionValue > 0){
            $pluspts = $_SESSION['player'] . ", You Got $" . $questionValue . " Dollars!";
        } else if ($questionValue < 0){
            $minuspts = $_SESSION['player'] . ", You Lost $" . $questionValue . " Dollars!";
        }
    }
    ?>

    <h1><?php echo $pluspts ?></h1>
    <h1><?php echo $minuspts ?></h1>

    <?php 
    if ( isset($_GET['answered'])){
        echo "<h2> Question has already been answered </h2>";
    }
    ?>

    <table class="gameboard">
        <tr>
            <th>Pop Culture</th>
            <th>Technology</th>
            <th>Sports and Games</th>
            <th>Science</th>
            <th>Foods</th>
        </tr>
        <tr>
            <td><a href="question.php?question_id=1&category=Pop%20Culture">$200</a></td>
            <td><a href="question.php?question_id=6&category=Technology">$200</a></td>
            <td><a href="question.php?question_id=11&category=Sports%20and%20Games">$200</a></td>
            <td><a href="question.php?question_id=16&category=Science">$200</a></td>
            <td><a href="question.php?question_id=21&category=Foods">$200</a></td>
        </tr>
        <tr>
            <td><a href="question.php?question_id=2&category=Pop%20Culture">$400</a></td>
            <td><a href="question.php?question_id=7&category=Technology">$400</a></td>
            <td><a href="question.php?question_id=12&category=Sports%20and%20Games">$400</a></td>
            <td><a href="question.php?question_id=17&category=Science">$400</a></td>
            <td><a href="question.php?question_id=22&category=Foods">$400</a></td>
        </tr>
        <tr>
            <td><a href="question.php?question_id=3&category=Pop%20Culture">$600</a></td>
            <td><a href="question.php?question_id=8&category=Technology">$600</a></td>
            <td><a href="question.php?question_id=13&category=Sports%20and%20Games">$600</a></td>
            <td><a href="question.php?question_id=18&category=Science">$600</a></td>
            <td><a href="question.php?question_id=23&category=Foods">$600</a></td>
        </tr>
        <tr>
            <td><a href="question.php?question_id=4&category=Pop%20Culture">$800</a></td>
            <td><a href="question.php?question_id=9&category=Technology">$800</a></td>
            <td><a href="question.php?question_id=14&category=Sports%20and%20Games">$800</a></td>
            <td><a href="question.php?question_id=19&category=Science">$800</a></td>
            <td><a href="question.php?question_id=24&category=Foods"> $800</a></td>
        </tr>
        <tr>
            <td><a href="question.php?question_id=5&category=Pop%20Culture">$1000</a></td>
            <td><a href="question.php?question_id=10&category=Technology">$1000</a></td>
            <td><a href="question.php?question_id=15&category=Sports%20and%20Games">$1000</a></td>
            <td><a href="question.php?question_id=20&category=Science">$1000</a></td>
            <td><a href="question.php?question_id=25&category=Foods">$1000</a></td>
        </tr>
    </table>

    <div class="scoreboard-container">
        <table class="scoreboard">
            <tr>
                <th>Current Score</th>
            </tr>

            <tr>
                <td>
                <?php
                    echo '$'. $totalPoint; 
                ?>
                </td>
            </tr>
        </table>
    </div>


    <div class="container">
    <form action="endgame.php" method="post">
        <input type="submit" name="endgame" value="End Game">
    </form>
    </div>
</body>
</html>