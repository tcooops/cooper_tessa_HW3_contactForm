<?php
header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json; charset=UTF-8');
$results = [];
$visitor_name = '';
$visitor_email = '';
$visitor_reason = '';
$visitor_message = '';



if (isset($_POST['firstname'])) {
    $visitor_name = filter_var($_POST['firstname'], FILTER_SANITIZE_STRING);
}

if (isset($_POST['lastname'])) {
    $visitor_name .= ' '.filter_var($_POST['lastname'], FILTER_SANITIZE_STRING);
}

if (isset($_POST['email'])) {
    $visitor_email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
}

if (isset($_POST['reason'])) { 
    $visitor_reason = filter_var($_POST['reason'], FILTER_SANITIZE_STRING); 
}

if (isset($_POST['message'])) {
    $visitor_message = filter_var(htmlspecialchars($_POST['message']), FILTER_SANITIZE_STRING);
}

$results['name'] = $visitor_name;
$results['message'] = $visitor_message;


$email_subject = sprintf('Inquiry From Portfolio Regarding: %s', $visitor_reason);
// this I figured out on my own based off this class build.


$email_recipient = 'tessa.m.cooper@gmail.com'; // this is your TO email
$email_message = sprintf('Name: %s, Email: %s, Message: %s', $visitor_name, $visitor_email, $visitor_message);

$email_headers = array(
    'From'=>'noreply@tbccreative.ca',
    'Reply-To'=>$visitor_email,
);


$email_result = mail($email_recipient, $email_subject, $email_message, $email_headers);
    if($email_result){
        $results['message'] = sprintf('Thank you for contacting us, %s! We will have a response within 24h.', $visitor_name);
    }else{
        $results['message'] = sprintf('Uh oh! Something went wrong. Please try again!');
    }

// spit out in json

echo json_encode($results);