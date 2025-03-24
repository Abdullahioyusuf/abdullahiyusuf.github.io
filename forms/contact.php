<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $to = "abdullahioyusuf21@gmail.com"; // Your email
    $from_name = strip_tags($_POST['name']);
    $from_email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $subject = strip_tags($_POST['subject']);
    $message = htmlspecialchars($_POST['message']);

    if (!filter_var($from_email, FILTER_VALIDATE_EMAIL)) {
        die("Invalid email format");
    }

    $headers = "From: $from_name <$from_email>\r\n";
    $headers .= "Reply-To: $from_email\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    // Send email
    if (mail($to, $subject, $message, $headers)) {
        echo "Message sent successfully!";
    } else {
        echo "Message sending failed.";
    }
} else {
    die("Invalid request.");
}
?>
