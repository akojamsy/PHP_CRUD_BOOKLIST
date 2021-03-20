<?php
session_start();


$serverName = "localhost";
$root = "root";
$password = "";
$dbName ="crud";

$mysqli = new mysqli($serverName, $root, $password, $dbName) or die (mysqli_error($mysqli));

$bookName = '';
$publisher = "";
$country ="";
$price = "";
$update =false;
$id = 0;

if(isset($_POST['save'])){
    $bookName = $_POST['bookname'];
    $publisher = $_POST['publisher'];
    $country = $_POST['country'];
    $price = $_POST['price'];

    $mysqli->query("INSERT INTO data (bookname, publisher, country, price) VALUES('$bookName', '$publisher', '$country', '$price')") or die($mysqli->error);
    
    $_SESSION['message'] = "Book has been added sucessfully!";
    $_SESSION['msg-type'] = "success";

    header('location: index.php');
}
if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    $mysqli->query("DELETE FROM data WHERE id=$id") or die(mysqli_error($mysqli));

    $_SESSION['message'] = "Book has been deleted sucessfully!";
    $_SESSION['msg-type'] = "danger";

    header('location: index.php');
}
if(isset($_GET['edit'])){
    $id = $_GET['edit'];
    $result = $mysqli->query("SELECT * FROM data WHERE id=$id") or die(mysqli_error($mysqli));
   
    if($result){
        $update = true;
        $row = $result->fetch_array();
        $bookName = $row['bookName'];
        $country = $row['country'];
        $publisher = $row['publisher'];
        $price = $row['price'];
    }
}

if(isset($_POST['update'])){
    $id = $_POST['id'];
    $bookName = $_POST['bookname'];
    $publisher = $_POST['publisher'];
    $country = $_POST['country'];
    $price = $_POST['price'];

    $mysqli->query("UPDATE data SET bookName = '$bookName', publisher = '$publisher', country = '$country', price = '$price' WHERE id=$id") or die($mysqli->error);
    
    $_SESSION['message'] = "Record has been Updated!";
    $_SESSION['msg-type'] = "warning";

    header('location: index.php');
}
