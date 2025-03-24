<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $to = "abdullahioyusuf21@gmail.com"; // Your email
    $from_name = filter_var(trim($_POST['name']), FILTER_SANITIZE_STRING);
    $from_email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $subject = filter_var(trim($_POST['subject']), FILTER_SANITIZE_STRING);
    $message = strip_tags($_POST['message']); // Remove HTML tags

    if (!filter_var($from_email, FILTER_VALIDATE_EMAIL)) {
        http_response_code(400);
        echo json_encode(["status" => "error", "message" => "Invalid email format."]);
        exit;
    }

    $headers = "From: $from_name <$from_email>\r\n";
    $headers .= "Reply-To: $from_email\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    // Send email
    if (mail($to, $subject, $message, $headers)) {
        http_response_code(200);
        echo json_encode(["status" => "success", "message" => "Message sent successfully!"]);
    } else {
        http_response_code(500);
        echo json_encode(["status" => "error", "message" => "Message sending failed."]);
    }
} else {
    http_response_code(405);
    echo json_encode(["status" => "error", "message" => "Invalid request method."]);
}
?>
