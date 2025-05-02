<?php
require "../config.php";
include DATABASE;
valid_login();
if($_SESSION['cargo'] != "orçamento" and $_SESSION['cargo'] != "admin" and $_SESSION['cargo'] != "Cliente")
    header("Location: ../index.php");   
//confere se o formulário foi completado corretamente
function form($vFk=null){
    if(!empty($_POST)){

        try{
            $vAgendas = $_POST;
            $vAgendas['fk_cliente'] = $vFk;
            if($vIdFuncionario = readOutros("id_funcionario","Funcionarios","cargo_funcionario","orçamento"))
                foreach ($vIdFuncionario as $key) {
                     $vAgendas['fk_funcionario'] = $key['id_funcionario'];
                }    
           
            else
                throw new Exception("Sem funcionários da funcionalidade 'Orçamento'");
                
            add($vAgendas,"_agendas");

        } catch(Exception $objErr){
            echo "<script>abrirErro();</script".$objErr->getMessage(); 
        }
    }
}
function leitura($vFk = NULL){
    try {
        $vSelect = "a.id_agenda, a.descricao_agenda,a.visita_agenda,f.nome_funcionario,f.telefone_funcionario";
        if (!empty($vFk)) {
            $vWhere = "a.fk_cliente = ?";
            $vResult = readInner($vSelect,"Agendas a","Funcionarios f","a.fk_funcionario","id_funcionario",null,null,$vWhere,$vFk);
        }
        else {
            $vResult = readInner($vSelect, "Agendas a ", "Funcionarios f", "a.fk_funcionario", "f.id_funcionario");
        }
        return $vResult;
    } catch(Exception $objErr){
        echo "<script>abrirErro();</script".$objErr->getMessage(); 
    }
}
function editar($vId)
{
    valid_login();
    try {
        if($_SERVER['REQUEST_METHOD'] =="POST"){
            if (!empty($_POST)) {
                $vAgendas = $_POST;
                if (isset($vAgendas['visita'])) {
                    if (DataLivre($vAgendas['visita'])){
                    update($vId,$vAgendas,"_agendas");
                    $vValue = readId($vId, "Agendas");
                    return $vValue;
                   
                    } 
                    else
                        throw new Exception("Essa data (".formataData($vAgendas['visita'],"d/m/y H:m").") já esta preenchida. Por favor escolha outra data, ou horário"); 
                }
                else {
                    update($vId,$vAgendas,"_agendas");
                    $vValue = readId($vId, "Agendas");
                    return $vValue;
                }

               
               
            }
            else {
                throw new Exception("Erro no formulário");
            }
        } else {
            if (isset($vId)) {
                $vValue = readId($vId, "Agendas");
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
        if(isset($vId)){
            delete($vId,"_agendas");
        }
       header("Location:index.php");
    } catch (Exception $objErr) {
        echo "<script>abrirErro();</script".$objErr->getMessage(); 
    }
}
function DataLivre($vData){
 
    $vValue = readOutros("visita_agenda","Agendas","visita_agenda",$vData);

    if (!$vValue)
        return true;  
    else
        return false;
} 
?>