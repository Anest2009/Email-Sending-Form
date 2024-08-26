<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize form data
    $name = htmlspecialchars(trim($_POST["name"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $subject = htmlspecialchars(trim($_POST["subject"]));
    $message = htmlspecialchars(trim($_POST["message"]));

    // Validate form data
    if (!empty($name) && !empty($email) && !empty($subject) && !empty($message)) {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            // Prepare email content
            $to = "anestpetollari44@gmail.com";  // Your email address
            $email_subject = "New Contact Form Submission: $subject";
            $email_body = "You have received a new message from $name.\n\n".
                          "Email: $email\n\n".
                          "Message:\n$message\n";
            $headers = "From: $email\r\n";
            $headers .= "Reply-To: $email\r\n";
            $headers .= "Content-Type: text/plain; charset=UTF-8\r\n"; // Ensure proper content type

            // Send the email
            if (mail($to, $email_subject, $email_body, $headers)) {
                echo "<p class='success'>Message sent successfully!</p>";
            } else {
                echo "<p class='error'>Error sending message. Please try again later.</p>";
            }
        } else {
            echo "<p class='error'>Invalid email address.</p>";
        }
    } else {
        echo "<p class='error'>All fields are required.</p>";
    }
} else {
    echo "<p class='error'>Invalid request.</p>";
}
?>


