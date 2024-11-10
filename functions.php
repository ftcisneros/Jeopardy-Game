<?php

//checks if string can be turned into array in php
function isSerializedString($string){
    $data = @unserialize($string);
    if ($data !== false){
        return true;
    } else {
        return false;
    }
}

//checks if data is an array, and turns into data string
function serializeIfNeeded($data){
    if (is_array($data) || is_object($data)){
        return serialize($data);
    }


    if (isSerializedString($data, false)){
        return serialize($data);
    }

    return $data;
}

//checks if data is in string form and turns into array
function unserializeIfNeeded($data){
    if (isSerializedString($data)){
        return @unserialize(trim($data));
    }
    return $data;
}
if (isset($_GET['clear-point'])){
    $_SESSION['arrAns'] = '';
}

//returns value of points in answered question array
function getPtsVal(){
$questionValue = 0;
    if (isset($_SESSION['arrAns'])){
        $dataAns = $_SESSION['arrAns'];
        $dataAnsArr = unserializeIfNeeded($dataAns);
        if (is_array($dataAnsArr)){
            foreach ($dataAnsArr as $k => $item){
                if (isset($item['point'])){
                    $questionValue = (float) $item['point'];
                }
            }
        }
    }
    
    return $questionValue;
}


function getTotalPts(){
    $total = 0;
    if (isset($_SESSION['arrAns'])){
        $dataAns = $_SESSION['arrAns'];
        $dataAnsArr = unserializeIfNeeded($dataAns);
        if (is_array($dataAnsArr)){
            foreach ($dataAnsArr as $k => $item){
                if (isset($item['point'])){
                    $total += (float) $item['point'];
                }
            }
        }
    }

    return $total;
}