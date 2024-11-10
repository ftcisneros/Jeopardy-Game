<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jeopardy</title>
    <link rel="stylesheet" href="homepage.css">
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

    $parameter = $_SERVER['QUERY_STRING'];
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

        //compare input to answer in data array
        if ($answer == $data[6]){
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
    }
    ?>

    <div>
        <img src="logo/jeopardylogo.png" alt="Jeopardy logo">
    </div>


    <div class="">
      <h1><?php echo $data[1]?></h1>
   
    <form method="post">
        <div class="">
            <h2> <?php echo $data[2] ?> <input type="radio" name="ans" value="2" /> </h2>
            <h2> <?php echo $data[3] ?> <input type="radio" name="ans" value="3" /> </h2>
            <h2> <?php echo $data[4] ?> <input type="radio" name="ans" value="4" /> </h2>
            <h2> <?php echo $data[5] ?> <input type="radio" name="ans" value="5" /> </h2>
         </div>
         <input type="submit" value="Submit" class="" />
    </form>
    </div>
</body>
</html>