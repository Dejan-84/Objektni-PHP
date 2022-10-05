<?php
session_start();

//print_r($_SESSION);

/*if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']) {

    header('Location: index.php');
}*/



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

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

            <form id="submit-form" method="post" action="javascript:void(0);" novalidate="novalidate">


                <div class="form-group">
                    <label for="email">Email adresa:</label>
                    <input type="email" name="email" class="form-input form-control" placeholder="Unesite email">
                </div>

                <div class="form-group">
                    <label for="lozinku">Lozinka:</label>
                    <input type="password" name="lozinku" class="form-input form-control" placeholder="Unesite lozinku">
                </div>

                <div style="padding:5px;" class="text-danger">
				</div>
                
                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                
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
        
    <script type="text/javascript">

    $(document).ready(function() {
        
        $(document).on('submit', '#submit-form', function(event) {
            event.preventDefault();

           

            var form = $(this).serialize();
            //alert(form);
            $.ajax({

                url: 'requests.php',
                method: 'post',
                dataType: 'json',
                data: {form},
                
                success: function(response) {

                    console.log(response);
                    
                    if(response.status) {

                        window.location.href = response.redirect_url;
                    }
                    else{

                        $('.text-danger').html(response.message);
                    }
                }

            });


            
        });
    });

    </script>   
</body> 
</html>