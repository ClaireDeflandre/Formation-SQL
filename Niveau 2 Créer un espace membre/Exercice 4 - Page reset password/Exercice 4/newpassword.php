
<?php

$bdd=new PDO('mysql:host=localhost;dbname=espace_membre;','root','');

if(isset($_POST['change_submit']))
    {
        if(isset($_POST['mdp'], $_POST['mdp2']))
        {
            $verif_confirme = $bdd->prepare('SELECT membres FROM espace_membre WHERE mail = ?');
            $verif_confirme->execute(array($_SESSION['recup_mail']));
            $verif_confirme = $verif_confirme->fetch();
            $verif_confirme = $verif_confirme['confirme'];
            if($verif_confirme == 1){
                $mdp = htmlspecialchars($_POST['change_mdp']);
                $mdp2 = htmlspecialchars($_POST['change_mdp2']);
                if(!empty($mdp) AND !empty($mdp2))
                {
                   
                    if($mdp == $mdp2)
                        {
                            $hashedpass = password_hash($mdp,PASSWORD_DEFAULT);
                            $insertmbr = $bdd->prepare('UPDATE membres SET motdepasse = ? WHERE mail = ?');
                            $insertmbr->execute(array($pseudo, $hashedpass, $mail));
                            $erreur = "Votre compte a bien été créé <a href=\"connection.php\">Me connecter</a>";
                            //header('Location: connection.php');
                        }
                        else
                        {
                            $erreur = "Les mots de passe doivent être identiques";
                        }     

                }
                else
                    {
                        $error = "Veuillez remplir tous les champs";
                    }
            } 
            else 
            {
                $error = "Veuillez valider votre mot de passe grâce au mail qui vous a été envoyé";
            }
            else
            {
                $error = "Veuillez remplir tous les champs";
            }
        }
    }
?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Récupération de mot de passe</title>
</head>
<body>
<div id="content">
    <div id="main-content">
      
        <article>
            <h4>Récupération de mot de passe</h4>
        
            Nouveau mot de passe 
            <br/><br/>
            <form method="post">
                <input type="password" placeholder="Nouveau mot de passe" name="mdp"/><br />
                <br/><br/>
                <input type="password" placeholder="Confirmation du mot de passe" name="mdp2"/><br />
                <br/><br/>
                <input type="submit" value="Valider" name="change_submit" />
            </form>
          
            <?php if(isset($error)) {echo '<span style="color:red">'.$error.'</span>';} else {echo "<br />";}  ?>
        </article>
    </div>

    

</div>

    
</body>
</html>