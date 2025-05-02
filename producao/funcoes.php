<?php
require "../config.php";
include DATABASE;
valid_login();
invalid_Clientes(); 
//confere se o formulário foi completado corretamente
function leitura(){
    try {
        $vSelect = "op.id_orcamento_produto, o.entrega_orcamento, p.nome_produto,p.foto_produto,o.material_orcamento,o.servico_orcamento,o.foto_orcamento,op.status_orcamento_produto";
        $vResult = readInner($vSelect,"Orcamento_Produtos op","Orcamentos o","op.fk_orcamento","o.id_orcamento","Produtos p","id_produto",null,null,"fk_produto");
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
                $vProducao = $_POST;
                update($vId,$vProducao,"_orcamento_Produtos");
                $vValue = readId($vId, "Orcamento_Produtos");
                return $vValue;
            }
            else {
                throw new Exception("Erro no formulário");
            }
        } else {
            if (isset($vId)) {
                $vValue = readId($vId, "Orcamento_Produtos");
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
        if(deleteImageOrcamento($vId,"Orcamento_Produtos op","id_orcamento","op.fk_orcamento","op.id_orcamento_produto")){
            deleteReferencia("o","Orcamentos o","Orcamento_Produtos oc","o.id_orcamento", "oc.fk_orcamento",$vId);	
            delete($vId,"_orcamento_Produtos");
        }
        else {
            throw new Exception("Erro ao Deletar foto de Orçamento");
        }
        
    } catch (Exception $objErr) {
        echo "<script>abrirErro();</script".$objErr->getMessage(); 
    }
}
?>