<?php

$bdd=new PDO('mysql:host=localhost;dbname=espace_membre;','root','');

?>

<?php
// Le haut de l'interface est ajouté avant le contenu
require 'header.php'; ?>

<?php


if(isset($_POST['validemail']))
{
    $mail= htmlspecialchars($_POST['mail']);
    $reqmail = $bdd->prepare('SELECT * FROM membres WHERE mail=?');
    $reqmail->execute(array($mail));
    $userinfo = $reqmail->fetch();

    if($userinfo)
    {
        include ("sendemail.php");

        $usermdp = $userinfo['motdepasse'];
        $userid = $userinfo["id"];
        $token = uniqid();
        $expire = time() + 60;

        $requser = $bdd->prepare("DELETE FROM membres WHERE mail=?");
        $requser->execute(['$id']);

        $reset = $bdd->prepare("INSERT INTO membres (mail,token,expire)VALUES(?,?,?)");
        $reset->execute(array($id,$token,$expire));

        $subject ="Pour réinitialiser votre mot de passe, merci de cliquer sur ce lien";
        $mailto = "claire83440@gmail.com";
        $body =  "Pour réinitialiser votre mot de passe, merci de cliquer sur ce lien\n\n".$_SERVER['SERVER_NAME']."/sitejsp1/membres/reset.php?id={$user->id}&token=".$expire;
        
        mail($mailTo, "Réinitialisez votre mot de passe", $body);
        header("Location: connection.php");

        function send_mail($mail, $subject, $body){
          
        
        }
    }
    else
    {
        echo "Aucun compte n'est associé à cette adresse email";
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mot de passe oublié</title>
</head>
<body>
    <div align="center">
        <form method="POST" action="">
            <p>Veuillez entrer votre adresse mail</p>
            <input type="email" name="mail">
            <br/><br/>
            <input type="submit" name="validemail">
        </form>

        <?php if (isset($_POST["submit"]) && !$userinfo) { ?>
        <p class="message--error">
            <?= "$email n'existe pas."; ?>
        </p>
    <?php } ?>
    <?php
// Le haut de l'interface est ajouté avant le contenu
require 'footer.php'; ?>
    </div>
</body>
</html>