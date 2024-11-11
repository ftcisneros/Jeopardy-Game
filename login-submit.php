<body>
    <?php
    session_start();
    $csv_file = file_get_contents('registered.txt');
    $file = fopen("php://temp", 'r+');
    fputs($file,$csv_file);
    rewind($file);
    $users = [];

    while(($data = fgetcsv($file)) !== FALSE){
        $users[] = $data;
    }
    
    $loginFailed = TRUE;

    for($i = 0; $i < count($users); $i++){
        if(!isset($users[$i][0])){
            continue;
        }
        else{
            if($_POST['Username'] == $users[$i][0] && $_POST['Password'] == $users[$i][1]){
                $_SESSION['player'] = $users[$i][0];
                $loginFailed = FALSE;
            }
        }
    }
    print_r($users);
    if($loginFailed == TRUE){
        $_SESSION['loginFail'] = TRUE;
        $_SESSION['errorMessage'] = 'Invalid username or password.';
        header("Location: login.php");
    }
    else{
        header("Location: categories.php");
    }
    ?>
    </body>