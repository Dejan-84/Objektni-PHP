<?php
session_start();

//print_r($_SESSION);

if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']) {

    header('Location: index.php');
}

//create a key for hash_hmac function
if (empty($_SESSION['key'])) {

    $_SESSION['key'] = bin2hex(random_bytes(32));
}
    
//create CSRF token
$csrf = hash_hmac('sha256', 'this is some string: index.php', $_SESSION['key']);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">

    <style>
        .row {
            margin-top: 80px;
        }

        form {
            border: 1px solid grey;
            padding: 20px;
        }

    </style>

</head>
<body>
    <div class="row">

        <div class="col-md-4 offset-md-4">

            <form method="post" action="<?php echo htmlspecialchars('login_korisnika.php');?>">


                <div class="form-group">
                    <label for="email">Email adresa:</label>
                    <input type="email" name="email" class="form-control" placeholder="Unesite email">
                </div>

                <div class="form-group">
                    <label for="lozinku">Lozinka:</label>
                    <input type="password" name="lozinku" class="form-control" placeholder="Unesite lozinku">
                </div>

                <input type="hidden" name="csrf" value="<?php echo $csrf ?>">
            
                <button type="submit" name="submit" class="btn btn-primary">Potvrdi</button>

            </form> 

        </div>
    </div>   
   
        <?php
            /*
            if (isset($_SESSION) && isset($_SESSION['success'])) {

                $html = '<div class="alert alert-success">';

                $ime = '';
                $prezime = '';

                if (isset($_SESSION['ime'])) {
                    $ime = $_SESSION['ime'];
                }

                (isset($_SESSION['prezime'])) ? $prezime = $_SESSION['prezime'] : '';

                $html .= 'Uspesno ste se registrovali: ' .$ime .' '. $prezime; 

                $html .= '</div>';
                
                echo $html;
            }
            */
        ?>
    
</body> 
</html>