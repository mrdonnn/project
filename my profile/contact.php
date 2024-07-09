<?php
$servername = "localhost";
$username = "your_username";
$password = "your_password";
$dbname = "contact_form_db";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    // Save to JSON file
    $formData = array(
        'name' => $name,
        'email' => $email,
        'message' => $message
    );
    $jsonData = json_encode($formData, JSON_PRETTY_PRINT);
    file_put_contents('submissions.json', $jsonData . PHP_EOL, FILE_APPEND);

    // Save to MySQL database
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $sql = "INSERT INTO submissions (name, email, message) VALUES ('$name', '$email', '$message')";
    if ($conn->query($sql) === TRUE) {
        header("Location: thankyou.html");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
}
?>
