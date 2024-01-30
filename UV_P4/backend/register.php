<?php
require_once "connect.php";

error_reporting(E_ALL);
ini_set('display_errors', 1);
 
$email = $password = $confirm_password = "";
$email_err = $password_err = $confirm_password_err = "";
 
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $name = trim($_POST["name"]);
    
    
    if(empty(trim($_POST["email"]))){
        $email_err = "Veuillez entrer un email.";
    } else{
        $sql = "SELECT id FROM users WHERE email = ?";
        
        if($stmt = mysqli_prepare($connection, $sql)){
            mysqli_stmt_bind_param($stmt, "s", $param_email);
            
            $param_email = trim($_POST["email"]);
            
            if(mysqli_stmt_execute($stmt)){
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $email_err = "Cet email est déjà enregistré.";
                } else{
                    $email = trim($_POST["email"]);
                }
            } else{
                echo "Oups ! Quelque chose s'est mal passé. Veuillez réessayer plus tard.";
            }

            mysqli_stmt_close($stmt);
        }
    }
    
    if(empty(trim($_POST["password"]))){
        $password_err = "Veuillez entrer un mot de passe.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Le mot de passe doit comporter au moins 6 caractères.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Veuillez confirmer le mot de passe.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Les mots de passe ne correspondent pas.";
        }
    }
    
    if (empty(trim($_POST["clé_API"]))) {
        $clé_API_err = "Veuillez entrer une clé API.";
    } else {
        $clé_API = trim($_POST["clé_API"]);
    }
    
    
    if (empty($email_err) && empty($password_err) && empty($confirm_password_err)&& empty($clé_API_err) ) {
        $sql = "INSERT INTO users (name, email, password, clé_API) VALUES (?, ?, ?, ?)";
        $stmt = mysqli_prepare($connection, $sql);
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "ssss", $param_name, $param_email, $param_password, $param_clé_API);


            $param_name = $name;
            $param_email = $email;
            $param_password = password_hash($password, PASSWORD_DEFAULT); 
            $param_clé_API = $clé_API;

            if (mysqli_stmt_execute($stmt)) {
                header("location: login.php");
            } else {
                echo "Quelque chose s'est mal passé. Veuillez réessayer plus tard.";
                print_r($stmt->error_list);
            }

            mysqli_stmt_close($stmt);
        }
    }

    mysqli_close($connection);
}
?>

<?php require('../frontend/templates/header.php') ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="stylesheet" type="text/css" href="/UV_P4/frontend/css/style2.css">
</head>
<body>
<div class="login-container">
    <div class="login-panel">
        <div class="login-image"></div>
        <h2>Inscription</h2>
        <p>Veuillez remplir ce formulaire pour créer un compte.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label>Nom</label>
                <input type="text" name="name" class="form-control" value="">
            </div>    
            <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                <label>Email</label>
                <input type="email" name="email" class="form-control" value="<?php echo $email; ?>" required>
                <span class="help-block"><?php echo $email_err; ?></span>
            </div>    
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Mot de passe</label>
                <input type="password" name="password" class="form-control" value="<?php echo $password; ?>" required>
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <label>Confirmer le mot de passe</label>
                <input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>" required>
                <span class="help-block"><?php echo $confirm_password_err; ?></span>
            </div>
            <div class="form-group">
                <label>Clé API</label>
                <input type="text" name="clé_API" class="form-control" value="">
            </div>
            <div class="form-group">
                <input type="submit" class="btn" value="Soumettre">
                <input type="reset" class="btn" value="Réinitialiser">
            </div>
            <p>Vous avez déjà un compte ? <a href="login.php">Connectez-vous ici</a>.</p>
        </form>
    </div>
</div>
</body>
</html>

<?php require('../frontend/templates/footer.php') ?>
