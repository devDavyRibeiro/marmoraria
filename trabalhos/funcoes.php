<?php
require "../config.php";
include DATABASE;

function produtos(){
    try {
        $vResults = readBase("Produtos");
        return $vResults;
    } catch (Exception $objErr) {
        echo "<script>abrirErro();</script".$objErr->getMessage(); 
    }
}


?>