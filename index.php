<?php
session_start();


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
                    <label for="email">Email:</label>
                    <input type="email" name="email" id="email" class="form-input form-control" placeholder="Enter email">
                </div>

                <div class="form-group">
                    <label for="lozinku">Password:</label>
                    <input type="password" name="password" id="password" class="form-input form-control" placeholder="Enter password">
                </div>

                <div style="padding:5px;" class="text-danger">
				</div>
                
                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
          
                
            </form> 

        </div>
    </div>   

    <script type="text/javascript">

    $(document).ready(function() {
        
        $('#submit-form').on('submit', function(event) {
            event.preventDefault();

            var email = $('#email').val();
            var password = $('#password').val();
            var request_name ='login';
            //alert(email);
            
            $.ajax({

                url: 'requests.php',
                method: 'post',
                dataType: 'json',
                data: {email,password,request_name},
                
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