<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = htmlspecialchars(trim($_POST['first_name']));
    $last_name = htmlspecialchars(trim($_POST['last_name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $phone = htmlspecialchars(trim($_POST['phone']));
    $not_robot = isset($_POST['not_robot']) ? 'Yes' : 'No';
    
    $to = "core@fibodo.com";
    $subject = "New Registration - Launch Offer";
    
    $message = "New Registration Submission\n\n";
    $message .= "First Name: " . $first_name . "\n";
    $message .= "Last Name: " . $last_name . "\n";
    $message .= "Email: " . $email . "\n";
    $message .= "Phone: " . $phone . "\n";
    $message .= "Not a Robot: " . $not_robot . "\n";
    $message .= "\nSubmitted on: " . date('Y-m-d H:i:s') . "\n";
    
    $headers = "From: " . $email . "\r\n";
    $headers .= "Reply-To: " . $email . "\r\n";
    $headers .= "X-Mailer: PHP/" . phpversion();
    
    if (mail($to, $subject, $message, $headers)) {
        echo json_encode(['success' => true, 'message' => 'Registration submitted successfully']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to send registration']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}
?>
