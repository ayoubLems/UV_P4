<?php
session_start();

require_once "connect.php";

$nouveau_mot_de_passe = $confirmer_mot_de_passe = "";
$nouveau_mot_de_passe_err = $confirmer_mot_de_passe_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){

    if(empty(trim($_POST["nouveau_mot_de_passe"]))){
        $nouveau_mot_de_passe_err = "Veuillez entrer le nouveau mot de passe.";
    } elseif(strlen(trim($_POST["nouveau_mot_de_passe"])) < 6){
        $nouveau_mot_de_passe_err = "Le mot de passe doit contenir au moins 6 caractères.";
    } else{
        $nouveau_mot_de_passe = trim($_POST["nouveau_mot_de_passe"]);
    }

    if(empty(trim($_POST["confirmer_mot_de_passe"]))){
        $confirmer_mot_de_passe_err = "Veuillez confirmer le mot de passe.";
    } else{
        $confirmer_mot_de_passe = trim($_POST["confirmer_mot_de_passe"]);
        if(empty($nouveau_mot_de_passe_err) && ($nouveau_mot_de_passe != $confirmer_mot_de_passe)){
            $confirmer_mot_de_passe_err = "Les mots de passe ne correspondent pas.";
        }
    }

    if(empty($nouveau_mot_de_passe_err) && empty($confirmer_mot_de_passe_err)){
        $sql = "UPDATE utilisateurs SET mot_de_passe = ? WHERE id = ?";

        if($stmt = $connection->prepare($sql)){
            $stmt->bind_param("si", $param_mot_de_passe, $param_id);

            $param_mot_de_passe = password_hash($nouveau_mot_de_passe, PASSWORD_DEFAULT);
            $param_id = $_SESSION["id"];

            if($stmt->execute()){
                session_destroy();
                header("location: login.php");
                exit();
            } else{
                echo "Oups ! Quelque chose s'est mal passé. Veuillez réessayer plus tard.";
            }

            $stmt->close();
        }
    }

    $connection->close();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/UV_P4/frontend/css/style2.css">
    <title>Réinitialiser le mot de passe</title>
</head>
<body>
    <?php require('../frontend/templates/header.php') ?>
    <div class="login-container">
        <div class="login-panel">
        <div class="login-image"></div>
            <h2>Réinitialiser le mot de passe</h2>
            <p>Veuillez remplir ce formulaire pour réinitialiser votre mot de passe.</p>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"> 
                <div class="form-group <?php echo (!empty($nouveau_mot_de_passe_err)) ? 'has-error' : ''; ?>">
                    <label>Nouveau mot de passe</label>
                    <input type="password" name="nouveau_mot_de_passe" class="form-control" value="<?php echo $nouveau_mot_de_passe; ?>">
                    <span class="help-block"><?php echo $nouveau_mot_de_passe_err; ?></span>
                </div>
                <div class="form-group <?php echo (!empty($confirmer_mot_de_passe_err)) ? 'has-error' : ''; ?>">
                    <label>Confirmer le mot de passe</label>
                    <input type="password" name="confirmer_mot_de_passe" class="form-control">
                    <span class="help-block"><?php echo $confirmer_mot_de_passe_err; ?></span>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Soumettre">
                    <a class="btn btn-link" href="login.php">Annuler</a>
                </div>
            </form>
        </div>
    </div>
    <?php require('../frontend/templates/footer.php') ?>
</body>
</html>
