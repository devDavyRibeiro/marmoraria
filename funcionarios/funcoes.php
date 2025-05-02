<?php
include "../config.php";
include DATABASE;
valid_login();
$vDates = null;
$vValue = null;
function form(){
    try{
        valid_admin();
        if(!empty($_POST)){
            $vFuncionarios = $_POST;
            $vFuncionarios['senha'] = criptografia($vFuncionarios['senha']);
            $vFuncionarios['nivel'] = 1;
            if($vFuncionarios['cargo'] == "Orçamento"){
                if (readCount(null,"Funcionarios","cargo_funcionario","Orçamento")>1) {
                    throw new Exception("Não é possível ter mais funcionários com o cargo Orçamento. Só é possível ter um e já existe");   
                }
            }
            add($vFuncionarios,"_funcionarios");
               
        }
    }catch(Exception $objErr){
        echo "<script>abrirErro();</script".$objErr->getMessage(); 
    } 
    
}

function leitura(){
    try {
        valid_admin();
        $vResults = readBase("Funcionarios");
        return $vResults;
    } catch (Exception $objErr) {
        echo "<script>abrirErro();</script".$objErr->getMessage(); 
    }
}
function editar($vId)
{
    try {
        valid_admin_funcionario();
        if($_SERVER['REQUEST_METHOD'] =="POST"){
            if (!empty($_POST)) {
                $vFuncionarios = $_POST;
                $vFuncionarios['senha'] = criptografia($vFuncionarios['senha']);
                if(isset($vFuncionarios['cargo']) and $vFuncionarios['cargo'] == "Orçamento"){
                    if (readCount(null,"Funcionarios","cargo_funcionario","Orçamento")>1) {
                        throw new Exception("Não é possível ter mais funcionários com o cargo Orçamento. Só é possível ter um e já existe");   
                    }
                }
                update($vId,$vFuncionarios,"_funcionarios");
                $vValue = readId($vId, "Funcionarios");
                return $vValue;
            }
            else {
                throw new Exception("Erro no formulário");
            }
        } else {
            if (isset($vId)) {
                $vValue = readId($vId, "Funcionarios");
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
        valid_admin();
        if ($vId != 1) {
            deleteReferencia("a","Agendas a","Funcionarios f","a.fk_funcionario", "f.id_funcionario",$vId);
            if(deleteImageOrcamento($vId,"Funcionarios f","o.fk_funcionario","f.id_funcionario","f.id_funcionario")){
                deleteReferencia("o","Orcamentos o","Funcionarios f","o.fk_funcionario", "f.id_funcionario",$vId);	
            } 
	
            delete($vId,"_funcionarios");
        }
        else {
            throw new Exception("Não é possível deletar o Administrador");
        }
        header("Location:../index.php");
    } catch (Exception $objErr) {
        echo "<script>abrirErro();</script".$objErr->getMessage(); 
    }
}