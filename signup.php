<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!--BOOTSTRAP-->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
        <!---FONTS-->
        <link href="https://fonts.googleapis.com/css2?family=Courgette&family=Pacifico&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
        <!--CUSTOM CSS-->
        <link rel="stylesheet" type="text/css" href="css/signup.css">
        <title>Create New Account</title>

    <head>
    <body>
        <div class="signup-form">
            <form action="" method="post">
                <div class="form-header">
                    <h2>Sign Up</h2>
                    <p>Fill out this form and start chatting with your friends</p> 
                </div>
                <div class="form-group">
                     <label>Username</label>
                     <input type="text " class="form-control" name="user_name" placeholder="Harry" autocomplete="off" required>
                </div>
                <div class="form-group">
                     <label>Email</label>
                     <input type="email" class="form-control" name="user_ email" placeholder="someone@site.com" autocomplete="off" required>
                </div>
                <div class="form-group">
                     <label>Password</label>
                     <input type="password" class="form-control" name="user_pass" placeholder="Password" autocomplete="off" required>
                </div>
                <div class="form-group">
                     <label>Country </label>
                     <select class="form-control" name="user_country" required>
                        <option disabled="">Select a country</option>
                        <option>United States of America</option>
                        <option>United Kingdom</option>
                        <option>Spain</option>
                        <option>France</option>
                        <option>Canada</option>
                        <option>Belgium</option>
                        <option>Germany</option>
                        <option>Ireland</option>
                        <option>Holland</option>
                        <option>Italy</option>
                     </seclect> 
                </div>
                <br>

                <div class="form-group">
                    <label>Gender</label>
                    <select class="form-control" name="user_gender1" required>
                        
                        
                    </select>
                </div>
                <div class="form-group">
                    <label>Gender</label>
                    <select class="form-control" name="user_gender" required>
                        <option disabled="">Select your gender</option>
                        <option>Male</option>
                        <option>Female</option>
                        <option>Others</option>
                    </select>
                </div>
                <br> 
                <div class="form-group">
                     <label class="checkbox-inline"><input type="checkbox" required> I accept the <a href="#">Terms of use</a> &amp; <a href="#">Privacy Policy</a></label>
                </div>
                <br>
                <div class="form-group">
                     <button type="submit" class="btn btn-primary brn-block btn-lg" name="sign_up">Sign up </button>
                     </div class="text-center small" style="color: #67428B;">Alredy have an account? <a href="signin.php">Sign in</a></div>
                </div>
                
                 <?php include("signup_user.php"); ?>
            </form>
        </div>


    </body>
</html> 
