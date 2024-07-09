<?php
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    // Validate and sanitize input (you can add more validation as needed)
    $fname = htmlspecialchars(trim($fname));
    $lname = htmlspecialchars(trim($lname));
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    $message = htmlspecialchars(trim($message));

    // Database connection details
    $servername = "localhost"; // Replace with your server name
    $username = "username"; // Replace with your database username
    $password = "password"; // Replace with your database password
    $dbname = "mydatabase"; // Replace with your database name

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // SQL query to insert data into table
    $sql = "INSERT INTO contacts (first_name, last_name, email, message) VALUES ('$fname', '$lname', '$email', '$message')";

    if ($conn->query($sql) === TRUE) {
        // Display success message and redirect to index.html
        echo "<script>alert('Form submitted successfully!');</script>";
        echo "<script>window.location.href = 'index.html';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close connection
    $conn->close();
}
?>
