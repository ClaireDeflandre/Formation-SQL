<?php 
if(isset($_POST['mailform']))
{
$header="MIME-Version: 1.0\r\n";
$header.='From: "claire-deflandre.fr"<claire83440@gmail.com>'."\n";
$header.='Content-Type:text/html; charset="utf-8"'."\n";
$header.='Content-Transfert-Encoding: 8bit';

$message='
<html>
    <body>
        <div align="center">
            <br/>
            J\'ai envoyé ce mail avec PHP !
            <br/>
            <img href>
        </div>
    </body>
</html>

';

mail("claire83440@gmail.com","Salut", $message, $header);
}
?>

<form method="POST" action="">
    <input type="submit" value="Recevoir un mail !" name="mailform"/>