<?php
require "../config.php";
include DATABASE;

function produtos(){
    try {
        $vResults = readBase("Produtos");
        return $vResults;
    } catch (Exception $objErr) {
            echo "<script>console.error(" . json_encode($objErr->getMessage()) . ");</script>";
            echo "<script>abrirErro();</script>" . $objErr->getMessage(); 
    }
}


?>