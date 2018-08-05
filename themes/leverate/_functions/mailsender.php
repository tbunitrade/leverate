<?php

// initial functions to functions.php
//
// ===================================================
// ==== Email sender functions  ==========================
// ===================================================
add_action ('wp_ajax_nopriv_datasend', 'datasend');
add_action ('wp_ajax_datasend', 'datasend');

function datasend() {
    header("Content-type:application/json");
    $email = $_POST["email"];
    $password = $_POST["password"];

    global $wpdb;
    $hash = wp_hash_password( $password);

    $wpdb->query("INSERT INTO wp_lerevate (email, password) VALUES('".$email."', '".$hash."')");

    echo json_encode(array("success" => true));die();

//    $tosuperadmin = 'head_office@starplast.com';
//    $tovetal = 'vitaliy@grapps.io';
//    $toroma = 'mr.romateslenko@gmail.com';
//    $tome = 'tbunitrade@gmail.com';
//
//    $to = $tosuperadmin .','. $tovetal ;
//
//    $message = 'name :'. $name . '
//    <br> phone :'. $phone. '
//    <br> email :'. $email . '
//    <br> subject :'. $subject .'
//    <br> message :' . $textarea;
//
//    $headers = array(
//        'From: Starplast <test@starplast.com>',
//        'content-type: text/html',
//        'Cc: admin Q admin <test@starplast.com>',
//        'Cc: test@starplast.com', // тут можно использовать только простой email адрес
//    );
//    $subject = 'Contact us page';
//
//    wp_mail( $to, $subject, $message, $headers  );


}
//
//add_action ('wp_ajax_nopriv_checkout', 'checkout');
//add_action ('wp_ajax_checkout', 'checkout');
//
//function checkout() {
//    header("Content-type:application/json");
//    $productname = $_POST["productname"];
//    $productsku = $_POST["productsku"];
//    $clientfileurl = $_POST["clientfileurl"];
//    $name = $_POST["name"];
//    $email = $_POST["email"];
//    $phone = $_POST["phone"];
//    $phonecode = $_POST["phonecode"];
//    $country = $_POST["country"];
//    $subject = $_POST["subject"];
//    $partnumbers = $_POST["partnumbers"];
//    $colors = $_POST["colors"];
//    $quantity = $_POST["quantity"];
//    $adress = $_POST["adress"];
//    $qty = $_POST["qty"];
//    $zipcode = $_POST["zipcode"];
//    $region = $_POST["region"];
//    $shipping = $_POST["shipping"];
//    $phonebottom = $_POST["phonebottom"];
//    $phonecodebottom = $_POST["phonecodebottom"];
//    $textarea = $_POST["textarea"];
//
//    //use FormGuide\Handlx\FormHandler;
//   // $pp = new FormHandler();
//    //$pp->attachFiles(['file']);
//
//    $tosuperadmin = 'head_office@starplast.com';
//    $tovetal = 'vitaliy@grapps.io';
//    $toroma = 'mr.romateslenko@gmail.com';
//    $tome = 'tbunitrade@gmail.com';
//
//    $to = $tosuperadmin .','. $tovetal ;
//
//    $message = 'name :'. $name . '
//    <br> productname :'. $productname . '
//    <br> productsku :'. $productsku . '
//    <br> email :'. $email . '
//    <br> phone :'. $phone . '
//    <br> phonecode :'. $phonecode  . '
//    <br> country :'. $country   . '
//    <br> subject :'. $subject .'
//    <br> part :'. $partnumbers   . '
//    <br> colors :'. $colors   . '
//    <br> quantity :'. $quantity   . '
//    <br> adress :'. $adress   . '
//    <br> qty :'. $qty   . '
//    <br> zipcode :'. $zipcode   . '
//    <br> region :'. $region   . '
//    <br> shipping :'. $shipping   . '
//    <br> Phonecode :'. $phonecodebottom   . '
//    <br> Phone :'. $phonebottom   . '
//    <br> message :' . $textarea
//
//    ;
//   // echo $pp->process($_POST);
//    $headers = array(
//        'From: Starplast <test@starplast.com>',
//        'content-type: text/html',
//        'Cc: admin Q admin <test@starplast.com>',
//        'Cc: test@starplast.com', // тут можно использовать только простой email адрес
//    );
//    $subject = 'After sale service';
//
//    wp_mail( $to, $subject, $message, $headers  );
//
//    echo json_encode(array("success" => true));die();
//}
//



