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
            <td><a href="question.php?1">$200</a></td>
            <td><a href="question.php?6">$200</a></td>
            <td><a href="question.php?11">$200</a></td>
            <td><a href="question.php?16">$200</a></td>
            <td><a href="question.php?21">$200</a></td>
        </tr>
        <tr>
            <td><a href="question.php?2">$400</a></td>
            <td><a href="question.php?7">$400</a></td>
            <td><a href="question.php?12">$400</a></td>
            <td><a href="question.php?17">$400</a></td>
            <td><a href="question.php?22">$400</a></td>
        </tr>
        <tr>
            <td><a href="question.php?3">$600</a></td>
            <td><a href="question.php?8">$600</a></td>
            <td><a href="question.php?13">$600</a></td>
            <td><a href="question.php?18">$600</a></td>
            <td><a href="question.php?23">$600</a></td>
        </tr>
        <tr>
            <td><a href="question.php?4">$800</a></td>
            <td><a href="question.php?9">$800</a></td>
            <td><a href="question.php?14">$800</a></td>
            <td><a href="question.php?19">$800</a></td>
            <td><a href="question.php?24"> $800</a></td>
        </tr>
        <tr>
            <td><a href="question.php?5">$1000</a></td>
            <td><a href="question.php?10">$1000</a></td>
            <td><a href="question.php?15">$1000</a></td>
            <td><a href="question.php?20">$1000</a></td>
            <td><a href="question.php?25">$1000</a></td>
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

    <form action="endgame.php" method="post">
        <input type="submit" name="endgame" value="End Game">
    </form>

</body>
</html>