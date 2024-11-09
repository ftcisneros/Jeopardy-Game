<body>
<?php 
    session_start();
    $score = 0;
    $dataPush = array(
        'UserName' => $_POST['Username'],
        'Password' =>  $_POST['Password'],
        'Score' => $score
    );

    $handle = fopen("registered.txt", "a+");
    $isValid = false;
    if($handle){
        while (!feof($handle)){
            $line = fgets($handle);
            $str_arr = preg_split("/\,/", $line);
            if ($str_arr[0] == $dataPush['UserName']) {
                $isValid = true;    
            }
        }

        if ($isValid != true){
            $user_details = $dataPush;
            $new_data = implode(",", $user_details);
            file_put_contents("registered.txt", PHP_EOL.$new_data, FILE_APPEND);
            header('Location: login.php');
        }
        
        fclose($handle);
    } 

    else {
        echo "cannot read file";
    }
            
?>
</body>