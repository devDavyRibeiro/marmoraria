<?php
require "../config.php";
include DATABASE;

//confere se o formulário foi completado corretamente
function form(){
    if(!empty($_POST)){
        try{
            $vClientes = $_POST;
            $vClientes['senha'] = criptografia($vClientes['senha']);
            if($vClientes['concordo'] == 1){
                $vClientes['concordo'] = 1;
            }
            else {
                $vClientes['concordo'] = 0;
            }
            
            add($vClientes,"_clientes");
            
        } catch(Exception $objErr){
            echo "<script>abrirErro();</script".$objErr->getMessage(); 
        }
    }
}
function editar($vId)
{
    valid_login();
    try {
        if($_SERVER['REQUEST_METHOD'] =="POST"){
            if (!empty($_POST)) {
                $vClientes = $_POST;
                $vClientes['senha'] = criptografia($vClientes['senha']);
                
                update($vId,$vClientes,"_clientes");
                $vValue = readId($vId, "Clientes");
                return $vValue;
            }
            else {
                throw new Exception("Erro no formulário");
            }
        } else {
            if (isset($vId)) {
                $vValue = readId($vId, "Clientes");
                return $vValue;
            } else {
                throw new Exception("Id não foi passado corretamente");
            }
        }

    } catch (Exception $objErr) {
       echo "<script>abrirErro();</script".$objErr->getMessage(); 
    }
}
function deletar($vId){
    try {
        valid_login();
        deleteReferencia("a","Agendas a","Clientes c","a.fk_cliente", "c.id_cliente",$vId);
        if(deleteImageOrcamento($vId,"Clientes","o.fk_cliente","c.id_cliente","c.id_cliente")){
            deleteReferencia("o","Orcamentos o","Clientes c","o.fk_cliente", "c.id_cliente",$vId);
        }       
        delete($vId,"_clientes");
        logout();
        header("Location:../index.php");
    } catch (Exception $objErr) {
        echo "<script>abrirErro();</script".$objErr->getMessage(); 
    }
}


?>