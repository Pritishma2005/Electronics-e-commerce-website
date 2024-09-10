<?php
$servername = "http://localhost/phpmyadmin/";
$username = "root";
$password = "";
$dbname = "printer";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $productName = $_POST["productName"];
    $productDescription = $_POST["productDescription"];

    // Handle file upload for product image
    $targetDir = "uploads/";
    $targetFile = $targetDir . basename($_FILES["productImage"]["name"]);
    move_uploaded_file($_FILES["productImage"]["tmp_name"], $targetFile);

    // Insert data into database
    $sql = "INSERT INTO your_table_name (productName, productDescription, productImage) VALUES ('$productName', '$productDescription', '$targetFile')";
    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
