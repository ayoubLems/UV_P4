<?php
session_start();

require_once "connect.php";

$email = $password = "";
$email_err = $password_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty(trim($_POST["email"]))) {
        $email_err = "Veuillez entrer votre email.";
    } else {
        $email = trim($_POST["email"]);
    }

    if (empty(trim($_POST["password"]))) {
        $password_err = "Veuillez entrer votre mot de passe.";
    } else {
        $password = trim($_POST["password"]);
    }

    if (empty($email_err) && empty($password_err)) {
        $sql = "SELECT id, email, password, role, clé_API FROM users WHERE email = ?";

        if ($stmt = $connection->prepare($sql)) {
            $stmt->bind_param("s", $param_email);

            $param_email = $email;

            if ($stmt->execute()) {
                $stmt->store_result();

                if ($stmt->num_rows == 1) {
                    $stmt->bind_result($id, $email, $hashed_password, $role, $api_key);
                    if ($stmt->fetch()) {
                        if (password_verify($password, $hashed_password)) {
                            session_start();

                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["email"] = $email;
                            $_SESSION["role"] = $role;
                            $_SESSION["api_key"] = $api_key;

                            header("location: app.php");
                        } else {
                            $password_err = "Le mot de passe que vous avez entré n'est pas valide.";
                        }
                    }
                } else {
                    $email_err = "Aucun compte trouvé avec cet email.";
                }
            } else {
                echo "Oups ! Quelque chose s'est mal passé. Veuillez réessayer plus tard.";
            }

            $stmt->close();
        }
    }

    $connection->close();
}
?>

<?php require('../frontend/templates/header.php') ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <?php if (isset($_SESSION["api_key"])) : ?>
  <script src="https://maps.googleapis.com/maps/api/js?key=<?php echo $_SESSION["api_key"]; ?>&libraries=places" defer></script>
  <?php else : ?>
  <script>
    // Affichez un message d'erreur si la clé API n'est pas disponible
    console.error("La clé API n'est pas disponible. Vous devez vous connecter pour l'obtenir.");
  </script>
  <?php endif; ?>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../frontend/css/styles.css">
  <script src="app.js"></script>
</head>
<body>
    <header>
      <img src="../frontend/img/logo.png" alt="icon">
      <p>Localiser votre enfant grâce à l'application FindMe</p>
    </header>
 
    <main>
      <div id="map"></div>
    </main>
    <div><button onclick="startTracking()">Suivre la localisation</button></div>
</body>
</html>

<?php require('../frontend/templates/footer.php') ?>
