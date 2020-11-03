<?php
//include_once ("Medoo.php");

require_once 'database.php';

use Medoo\Medoo;

if(isset($_POST['forminscription']))
{
    $pseudo = htmlspecialchars($_POST['pseudo']);
    $mail = htmlspecialchars($_POST['mail']);
    $mail2 = htmlspecialchars($_POST['mail2']);
    $mdp =($_POST['mdp']);
    $mdp2 =($_POST['mdp2']);
    $hashedpass = password_hash($mdp,PASSWORD_DEFAULT);

    if(!empty($_POST['pseudo']) AND !empty($_POST['mail']) AND !empty($_POST['mail2']) AND !empty($_POST['mdp']) AND !empty($_POST['mdp2']))
    { 
        $pseudolenght = strlen($pseudo);
        if($pseudolenght<=255)
        {
            if($mail == $mail2)
            {
                if(filter_var($mail, FILTER_VALIDATE_EMAIL))
                {
                    $data = $database->get('users','*',[
                        'email'=> $mail,
                    ]);

                    if(!$data)
                    {
                        $database->insert('membres',[
                            'pseudo'=> $pseudo,
                            'mail'=> $mail,
                            'motdepasse'=> $hashedpass,
                        ]);
                    }
                    
                        if($mdp == $mdp2)
                        {
                            
                            $erreur = "Votre compte a bien été créé <a href=\"connection.php\">Me connecter</a>";
                            header('Location: connection.php');
                        }
                        else
                        {
                            $erreur = "Les mots de passe doivent être identiques";
                        }
                    }
                    else
                    {
                        $erreur = "Cette adresse mail a déjà été utilisée";
                    }
                }
                else
                {
                    $erreur = "Votre adresse mail n'est pas valide";
                }
            }
            else
            {
                $erreur = "Vos adresses mail ne correspondent pas";
            }
        }
        else
        {
            $erreur = "Votre pseudo ne doit pas dépasser 255 caractères";
        }
    }
    else
    {
        $erreur = "Tous les champs doivent être remplis";
    }


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
</head>
<body>
    <div align="center">
        <h2>Inscription</h2>
        <br /><br /><br />
        <form method="POST" action="">
            <table>
                <tr>
                    <td align="right">
                        <label for="pseudo">Pseudo :</label>
                    </td>
                    <td>
                        <input type="text" placeholder="Votre pseudo" id="pseudo" name="pseudo" value="<?php if(isset($pseudo)) { echo $pseudo;}?>"/>
                    </td>
                </tr>
                <tr>
                    <td align="right">
                        <label for="mail">Mail :</label>
                    </td>
                    <td>
                        <input type="email" placeholder="Votre mail" id="mail" name="mail" value="<?php if(isset($mail)) { echo $mail;}?>"/>
                    </td>
                </tr>
                <tr>
                    <td align="right">
                        <label for="mail2">Confirmation du mail :</label>
                    </td>
                    <td>
                        <input type="email" placeholder="Confirmer votre mail" id="mail2" name="mail2" value="<?php if(isset($mail2)) { echo $mail2;}?>"/>
                    </td>
                </tr>
                <tr>
                    <td align="right">
                        <label for="mdp">Mot de passe :</label>
                    </td>
                    <td>
                        <input type="password" placeholder="Votre mot de passe" id="mdp" name="mdp"/>
                    </td>
                </tr>
                <tr>
                    <td align="right">
                        <label for="mdp2">Confirmation du mot de passe :</label>
                    </td>
                    <td>
                        <input type="password" placeholder="Confirmer le mot de passe" id="mdp2" name="mdp2"/>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td align="center">
                        <br />
                        <input type="submit" name="forminscription" value="Je m'inscris"/>
                    </td>
                </tr>
            </table>
        </form>
        <?php
        if(isset($erreur))
        {
            echo '<font color="red">'.$erreur.'</font>';
        }
        ?>
    </div>
</body>
</html>