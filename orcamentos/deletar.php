
<?php
    include "funcoes.php";
    if (empty($_GET['i'])) {
        throw new Exception("Id não foi passado corretamente");      
    }
    $vId = base64_decode($_GET['i']);
    deletar($vId);
   // header("Location: ../index.php");
?>

