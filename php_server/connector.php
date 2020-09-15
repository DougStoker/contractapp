<?php
header('Content-Type: application/json');


// Temporary shortcircuit

$jdata = file_get_contents('./contractors.json');

echo $jdata;

exit;

$mysqli = new mysqli('127.0.0.1', 'root', 'password', 'contractorsdb');


// if (isset($_GET['aid']) && is_numeric($_GET['aid'])) {
//     $aid = (int) $_GET['aid'];
// } else {
//     $aid = 1;
// }

if ($mysqli->connect_errno) {
    echo "could not connect";
    echo "Errno: " . $mysqli->connect_errno . "\n";
    exit;
}
// WHERE contractors_id = $aid
$sql = "SELECT * FROM contractors";
// $sql = "SELECT contractors_id, business, contact, phoneNumber,secondPhone,applicantPhone,email,
// address,city,state,zip,typeOfWOrk FROM contractors";
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
// if ($result->num_rows === 0) {
//     echo "We could not find a match for ID $aid, sorry about that. Please try again.";
//     exit;
// }
// $result -> fetch_all(MYSQLI_NUM);
// $result -> free_result();

//$result = mysqli_query($con, $sql);   
while($row = mysqli_fetch_assoc($result))
    $data[] = $row; 


echo json_encode($data);
?>