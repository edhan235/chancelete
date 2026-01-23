<?php
// form-handler.php

// Prevent direct access
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    header("Location: apply.html");
    exit;
}

// Get form data
$firstName = strip_tags(trim($_POST["firstName"]));
$lastName = strip_tags(trim($_POST["lastName"]));
$birthYear = strip_tags(trim($_POST["birthYear"]));
$sport = strip_tags(trim($_POST["sport"]));
$city = strip_tags(trim($_POST["city"]));
$parentName = strip_tags(trim($_POST["parentName"]));
$email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
$phone = strip_tags(trim($_POST["phone"]));

// Validate required fields
if (empty($firstName) || empty($lastName) || empty($birthYear) || empty($sport) || empty($city) || empty($parentName) || empty($email) || empty($phone)) {
    header("Location: apply.html?error=missing");
    exit;
}

// Validate email
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header("Location: apply.html?error=email");
    exit;
}

// Email settings
$to = "holler@chanceletes.org";
$subject = "New Chanceletes Application - $firstName $lastName";

// Email body
$emailBody = "New application submitted:\n\n";
$emailBody .= "ATHLETE INFORMATION\n";
$emailBody .= "-------------------\n";
$emailBody .= "First Name: $firstName\n";
$emailBody .= "Last Name: $lastName\n";
$emailBody .= "Birth Year: $birthYear\n";
$emailBody .= "Sport: $sport\n";
$emailBody .= "City of Residence: $city\n\n";
$emailBody .= "PARENT/GUARDIAN INFORMATION\n";
$emailBody .= "---------------------------\n";
$emailBody .= "Name: $parentName\n";
$emailBody .= "Email: $email\n";
$emailBody .= "Phone: $phone\n\n";
$emailBody .= "Submitted: " . date('Y-m-d H:i:s') . "\n";

// Email headers
$headers = "From: applications@chanceletes.org\r\n";
$headers .= "Reply-To: $parentName <$email>\r\n";
$headers .= "X-Mailer: PHP/" . phpversion();

// Send email
if (mail($to, $subject, $emailBody, $headers)) {
    // Success - redirect to thank you page
    header("Location: thank-you.html");
} else {
    // Error - redirect back with error
    header("Location: apply.html?error=send");
}

exit;
?>
