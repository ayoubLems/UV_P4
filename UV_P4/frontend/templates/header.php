<?php 

$server = 'http://' . $_SERVER['SERVER_NAME'] . '/UV_P4/';

$user_logged = isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true;

?>
<!DOCTYPE html>
<html>
<head>
    <title>NutriSuivi</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
  
    <link rel="stylesheet" href="<?php echo $server; ?>css/style.css" >
 
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
</head>
<body>
<header class="d-flex w-100">
    <nav class="navbar navbar-expand-lg w-100 bg-light">
        <div class="navbar-collapse collapse justify-content-between">
            <ul class="navbar-nav" id="navbar">
                <li class="nav-item active">
                    <a class="nav-link text-dark" href="<?php echo $server; ?>backend/app.php"><i class="fa fa-building text-dark"></i> Accueil</a>
                </li>
                



            </ul>
            
            <ul class="navbar-nav">
                <?php 
                if ($user_logged) { ?>
                    <li class="nav-item mr-sm-2">
                        <a class="nav-link btn btn-dark text-white" href="<?php echo $server; ?>backend/logout.php"><span><i class="fa fa-sign-out text-white"></i></span>Sign Out</a>
                    </li>
                <?php } else { ?>
                    <li class="nav-item mr-sm-2">
                        <a class="nav-link btn btn-primary text-white" href="<?php echo $server; ?>backend/login.php"><span><i class="fa fa-sign-in text-white"></i></span> Sign In</a>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </nav>
</header>

<div class="container-fluid page-container">
    <div class="main-content">
    </div>
</div>
</body>
</html>
