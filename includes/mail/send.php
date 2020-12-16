<?php 
// TODO: Take care the form submission
ini_set('display_errors', 0);




// 4. it returns info in JSON
// a. What is AJAX?
// Ajax (also AJAX /ˈeɪdʒæks/; short for "Asynchronous JavaScript and XML")[1][2] is a set of web development techniques using many web technologies on the client side to create asynchronous web applications. With Ajax, web applications can send and retrieve data from a server asynchronously (in the background) without interfering with the display and behaviour of the existing page. By decoupling the data interchange layer from the presentation layer, Ajax allows web pages and, by extension, web applications, to change content dynamically without the need to reload the entire page.[3] In practice, modern implementations commonly utilize JSON instead of XML.

// b. What is JSON?
// A better option for XML for data transfers, JSON (JavaScript Object Notation) definitely requires less coding and has a smaller size, making it faster to process and transmit data. Moreover, though it is written in JavaScript, it is language-independent. But, that’s all JSON can do. It doesn’t have any of the powerful validation and schema related features that XML has.

// c. How to build JSON?
header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json: charset=utf-8');
$results = [];
$visitor_name = '';
$visitor_email = '';
$visitor_subject='';
$visitor_message = '';

// 1. Check the submission out -> validating the data
// $_POST['firstname']
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    if(empty($_POST['name'])) { 
        $results['message'] = 'name is required'; 
        echo json_encode($results);
        die(); 
    } else {
        $visitor_name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    }
    
    
    if (empty($_POST['email'])) {
        $results['message'] ='email is required';
        echo json_encode($results);
        die();
    } else if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $results['message'] ='email is invalid';
        echo json_encode($results);
        die();
    } else {
        $visitor_email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    }
    
    if (empty($_POST['subject'])) {
        $results['message'] = "subject is required";
        echo json_encode($results);
        die();
    } else {
        $visitor_subject = filter_var(htmlspecialchars($_POST['subject']), FILTER_SANITIZE_STRING);
    }
    
    
    if (isset($_POST['message'])) {
        $visitor_message = filter_var(htmlspecialchars($_POST['message']), FILTER_SANITIZE_STRING);
    }
    
    //g-recaptcha-response POST parameter when the user submits the form on your site
    $captcha='';
    if(isset($_POST['g-recaptcha-response'])){
        $captcha=$_POST['g-recaptcha-response'];
      }
    if(!$captcha){
        // if user didn't check reCAPYCHA box 
        echo json_encode(["message"=>"Are you a robot?"]);
          exit;
      }
    
    }


$results['name'] = $visitor_name;
$results['message'] = $visitor_message;

// 2. Prepare the email
$subject = $_POST['subject'];
$email_subject = $subject ?: 'Inquiry from Portfolio Site';
$email_recipient = 'mengzhu0204@gmail.com'; 
$email_message = sprintf('Name: %s, Email: %s, Subject: %s', $visitor_name, $visitor_email, $visitor_subject);

// make sure you run the code in PHP 7.4 +
//Otherwise, you wou;d need to make $email_headers as a string https://wwww.php.net/manual/en/function.mail.php
$email_headers = array(
    // Best practice, but it may need to have a mail set up in noreply@yourdomain.ca
    // 'From' =>$'noreply@yourdomain.ca',
    // 'Reply-tTo' =>$visitor_email,
    // 'From'=>$visitor_email // ex: emesmenda@gmail.com

    // You can still use it, if above too much work
    'From'=>'$noreply@meng-zhu.com'
);

// 3. Send the email
$email_result = mail($email_recipient, $email_subject, $email_message, $email_headers);
if($email_result){
    $results['message'] = sprintf('Thank You for contacting us, %s. You will get a reply within 24 hours', $visitor_name);
}else{
    $results['message'] = sprintf('We are sorry but the email did not go through.');
}
// $results = [
//     'key1'=> 'value1',
//     'key2'=> 'value2'
// ];

echo json_encode($results);