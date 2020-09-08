<?php
    $file = 'contractors.json';
    $json = file_get_contents($file,0,null,null);
    $data = json_decode($json);


    $mysqli = new mysqli('127.0.0.1', 'root', 'password', 'contractorsdb');

    if ($mysqli->connect_errno) {
        echo "could not connect";
        echo "Errno: " . $mysqli->connect_errno . "\n";
        exit;
    }
    
    $keys = ["business","contact","phoneNumber","secondPhone","applicantPhone","email","address","city","state","zip","typeOfWOrk"];

   

    foreach ($data as &$record){

        foreach ($keys as &$key){
            if(isset($record->$key) == false){
                $record->$key = "NULL";
            }
        }
    
        $sql = "INSERT INTO contractors (business,contact,phoneNumber,secondPhone,applicantPhone,email,address,city,state,zip,typeOfWOrk)
        VALUES (\"$record->business\",\"$record->contact\",\"$record->phoneNumber\",\"$record->secondPhone\",\"$record->applicantPhone\",
        \"$record->email\",\"$record->address\",\"$record->city\",\"$record->state\",\"$record->zip\",\"$record->typeOfWOrk\")";

       
        //echo $sql;
    
        if (!$result = $mysqli->query($sql)) {
            // Oh no! The query failed. 
            echo "Sorry, the website is experiencing problems.";
        
            // Again, do not do this on a public site, but we'll show you how
            // to get the error information
            echo "Error: Our query failed to execute and here is why: \n";
            echo "Query: " . $sql . "\n";
            echo "Errno: " . $mysqli->errno . "\n";
            echo "Error: " . $mysqli->error . "\n";
            exit;
        }
    }
    
?>