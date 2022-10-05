<?php
session_start();
//ini_set('display_errors',0);

if (isset($_POST['form'])) {
    
    $validation = true;
    $message = '';
    $response = array();

    $form = array();
    parse_str($_POST['form'], $form);

    

   

    include 'function.php';

    
    $provera = prazna_polja($form);
     
    if ($provera['status'] == 0) {

        $validation = false;
        $message .= $provera['message'];
    }

    
    if($validation) {

        $lozinka = $form['lozinku'];
        $email =  htmlspecialchars($form['email']);
        $pass =  htmlspecialchars($form['lozinku']);

        $logovanje_korisnika = logovanje_korisnika($email,$pass);

        if ($logovanje_korisnika['status'] == 0) {

            $validation = false;
            $message .= $logovanje_korisnika['message'];
        }
        else {

            $url = $logovanje_korisnika['redirect_url'];
            $response['redirect_url'] = $url;
        }  
    }

    $response['status'] = $validation;
    $response['message'] = $message;

    echo json_encode($response);
}