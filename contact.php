<?php
   $nameError = $prenomError = $paysError = $telephoneError = $emailError = $messageError = "";
    $name = $prenom = $pays = $telephone = $email = $message = "";
     $successMessage = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
       $name = htmlspecialchars($_POST["name"]);
       $prenom = htmlspecialchars($_POST["prenom"]);
      $pays = htmlspecialchars($_POST["pays"]);
       $telephone = htmlspecialchars($_POST["telephone"]);
      $email = htmlspecialchars($_POST["email"]);
      $message = htmlspecialchars($_POST["message"]);


      //validation champs 
      if(empty($name)){
        $nameError="veiller entre le nom";
      }


    if(empty($prenom)){
        $prenomError="entrez votre prenom";
    }

    if(empty($ppays)){
        $paysError="entrez le pays";

    }

   if (empty($telephone )){
    $telephoneError="entrez votre numero de telephone";
   }
   elseif (!preg_match("/[0-9]{10}$/",$telephone)){
    $telephoneError="le numero de telephone n' est pas vaalide";
   }
    
    if(empty($email)){
        $emailError = "Veuillez entrer votre email.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailError = "L'adresse email n'est pas valide.";
     
    }

    

    if (empty($message)) {
        $messageError = "Veuillez entrer votre message.";
    }

    //message de confirmation
    if (empty($nameError) && empty($prenomError) && empty($paysError) && empty($telephoneError) && empty($emailError) && empty($messageError)) {
        $successMessage = "Votre message a été envoyé avec succès.";
        
        $name = $prenom = $pays = $telephone = $email = $message = "";
    }


    // base de données
    try {
        $bdd = new PDO('mysql:host=localhost;dbname=exoformulcontact', 'root', '');  
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }

// Requête
$requete = $bdd->prepare("INSERT INTO contactform (nom,prenom,pays,telephone,email,message) VALUES (:nom,:prenom,:pays,:telephone,:email, :message)");


}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire de Contact</title>
    <link rel="stylesheet" href="contact.css">
</head>
<body>
    <div class="cont">
        <h2>Contact</h2>
            <?php if ($successMessage): ?>
            <div class="success-message"><?php echo $successMessage; ?></div>
           <?php endif; ?>
        
           <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                   <div class="case">
                      <label for="name">Nom :</label>
                       <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($name); ?>" required>
                      <span class="erreur"><?php echo $nameError; ?></span>
                  </div>   

                  <div class="case">
                <label for="prenom">Prénom :</label>
                <input type="text" id="prenom" name="prenom" value="<?php echo htmlspecialchars($prenom); ?>" required>
                <span class="erreur"><?php echo $prenomError; ?></span>
            </div>

                 <div class="case">
                     <label for="pays">Pays :</label>
                    <input type="text" id="pays" name="pays" value="<?php echo htmlspecialchars($pays); ?>" required>
                   <span class="erreur"><?php echo $paysError; ?></span>
                 </div>

                 <div class="case">
                <label for="telephone">Téléphone :</label>
                <input type="tel" id="telephone" name="telephone" value="<?php echo htmlspecialchars($telephone); ?>" required>
                <span class="erreur"><?php echo $telephoneError; ?></span>
            </div>
                   <div class="case">
                      <label for="email">Email :</label>
                        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
                     <span class="erreur"><?php echo $emailError; ?></span>
            </div>

            <div class="case">
                <label for="message">Message :</label>
                <textarea id="message" name="message" rows="4" required><?php echo htmlspecialchars($message); ?></textarea>
                <span class="erreur"><?php echo $messageError; ?></span>
            </div>
                       <button type="submit">Envoyer</button>
</form>
</body>
</html>
