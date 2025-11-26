<?php
header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $first_name = isset($_POST['first_name']) ? htmlspecialchars(trim($_POST['first_name'])) : '';
        $last_name = isset($_POST['last_name']) ? htmlspecialchars(trim($_POST['last_name'])) : '';
        $email = isset($_POST['email']) ? htmlspecialchars(trim($_POST['email'])) : '';
        $phone = isset($_POST['phone']) ? htmlspecialchars(trim($_POST['phone'])) : '';
        $not_robot = isset($_POST['not_robot']) ? 'Yes' : 'No';
        
        if (empty($first_name) || empty($last_name) || empty($email) || empty($phone)) {
            echo json_encode(['success' => false, 'message' => 'All fields are required']);
            exit;
        }
        
        $to = "core@fibodo.com";
        $subject = "New Registration - Launch Offer";
        
        $message = "New Registration Submission\n\n";
        $message .= "First Name: " . $first_name . "\n";
        $message .= "Last Name: " . $last_name . "\n";
        $message .= "Email: " . $email . "\n";
        $message .= "Phone: " . $phone . "\n";
        $message .= "Not a Robot: " . $not_robot . "\n";
        $message .= "\nSubmitted on: " . date('Y-m-d H:i:s') . "\n";
        
        $headers = "From: noreply@fibodo.com\r\n";
        $headers .= "Reply-To: " . $email . "\r\n";
        $headers .= "X-Mailer: PHP/" . phpversion();
        
        $mailSent = mail($to, $subject, $message, $headers);
        
        if ($mailSent) {
            echo json_encode(['success' => true, 'message' => 'Registration submitted successfully']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to send email. Please contact support.']);
        }
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => 'Server error: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}
?>
