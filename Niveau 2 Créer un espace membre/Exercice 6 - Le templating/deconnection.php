<?php
// Le haut de l'interface est ajouté avant le contenu
require 'header.php'; ?>
<?php
session_start();
$_SESSION = array();
session_destroy();
header("Location:connection.php");
?>
<?php
// Le haut de l'interface est ajouté avant le contenu
require 'footer.php'; ?>