<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jeopardy</title>
    <link rel="stylesheet" href="question.css">
</head>
<body>

    <?php
    include('functions.php');

    $ptVals = [
        '$200'  => 200,
        '$400'  => 400,
        '$600'  => 600,
        '$800'  => 800,
        '$1000' => 1000,
    ];

    $data = array("1", "Question Text", "ans", "ans", "ans", "ans", "3",);
        // (Question ID, Question, Answer 1, Answer 2, Answer 3, Answer 4, Correct answer position)

        $parameter = isset($_GET['question_id']) ? $_GET['question_id'] : null;

    session_start();

    $ansUnser = @$_SESSION['arrAns'];
    $arrAnswers = (array) unserializeIfNeeded($ansUnser);

    //checks if question is already answered
    if (isset($arrAnswers[$parameter])) {
        if ($arrAnswers[$parameter]['point'] > 0){
            header('Location: categories.php?answered=' . $parameter);
            exit;
        }

        else {
            header('Location: categories.php?answered=' . $parameter);
            exit;
        }
    }

    //gets question data
    $txt_file  = file_get_contents('questions.txt');
    $rows = explode("\n", $txt_file);
    foreach ($rows as $row => $p){
        $row_data = explode(',', $p);
        if ($row_data[0] == $parameter){
            $data = $row_data;
        }
    }

    //gets selected answer and correct answer
    if (isset($_POST['ans'])){
        $answer = trim($_POST['ans']);
        $val = trim($data[7]);
        $index = $data[0];

        // find selected answer position 
        $selected_position = null;
        for ($i = 2; $i <= 5; $i++) {
            if ($data[$i] === $answer) {
                $selected_position = $i;
                break;
            }
        }

        // compare input to answer in data array 
        if ($selected_position == $data[6]) {
            $point = (float) @$ptVals[$val];
        } else {
            $point = -(float) @$ptVals[$val];
        }

        $arrAnswers[$index] = [
            'index' => $index,
            'point' => $point,
        ];

        $_SESSION['arrAns'] = serializeIfNeeded($arrAnswers);
        header('Location: categories.php');
        exit;
    }
    ?>

    <div class="question-container">
        <?php
            $category = isset($_GET['category']) ? htmlspecialchars($_GET['category']) : 'Unknown Category';
        ?>
        <h1><?php echo $category . " • <span>" . htmlspecialchars($data[7]) . "</span>"; ?></h1>
        <div>
            <p><?php echo htmlspecialchars($data[1]); ?></p>
        </div>
   
        <form method="post">
            <div class="button-container">
                <h2><input type="radio" name="ans" value="<?php echo htmlspecialchars($data[2]); ?>"> <?php echo htmlspecialchars($data[2]); ?></h2>
                <h2><input type="radio" name="ans" value="<?php echo htmlspecialchars($data[3]); ?>"> <?php echo htmlspecialchars($data[3]); ?></h2>
                <h2><input type="radio" name="ans" value="<?php echo htmlspecialchars($data[4]); ?>"> <?php echo htmlspecialchars($data[4]); ?></h2>
                <h2><input type="radio" name="ans" value="<?php echo htmlspecialchars($data[5]); ?>"> <?php echo htmlspecialchars($data[5]); ?></h2>
            </div>
        
            <div class="button-container">
                <button class="button" type="submit">Submit answer</button>
            </div>
        </form>
    </div>

</body>
</html>