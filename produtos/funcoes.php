<?php
include "../config.php";
include DATABASE;

valid_admin();

$vDates = null;
$vValue = null;

function form(){
    try{
        if(!empty($_POST)){
            $vProdutos = $_POST;
            $vProdutos['foto'] = upload();
            add($vProdutos,"_produtos");
            
        }
    }catch(Exception $objErr){
        echo "<script>abrirErro();</script>" . $objErr->getMessage();
    } 
    
}

function leitura(){
    try {
        $vResults = readBase("Produtos");
        return $vResults;
    } catch (Exception $objErr) {
        echo "<script>abrirErro();</script>" . $objErr->getMessage();
    }
}
function editar($vId)
{
    $vValue = null;
    $vFotoNova = null;
    try {
        if($_SERVER['REQUEST_METHOD'] =="POST"){
            $vValue = readId($vId, "Produtos");
            if (!empty($_POST)) {
                $vProdutos = $_POST;
                
                if (!empty($_FILES["foto"]["name"])) {
                    if ($vFotoNova =  upload() and unlink($vValue['foto_produto'])) {
                       $vProdutos['foto'] = $vFotoNova;
                    }
                    else{
                        throw new Exception("Erro no upload");  
                    }
                
                } 
                else {
                    $vProdutos['foto'] = $vValue['foto_produto'];
                }
                
                var_dump($vProdutos);
                update($vId,$vProdutos,"_produtos");
                $vValue = readId($vId, "Produtos");
                return $vValue;
            }
            else {
                throw new Exception("Erro no formulário");
            }
        } else {
            if (isset($vId)) {
                $vValue = readId($vId, "Produtos");
                return $vValue;
            } else {
                throw new Exception("Id não foi passado corretamente");
            }
        }

    } catch (Exception $objErr) {
        echo "<script>abrirErro();</script>" . $objErr->getMessage();
    }
}
function upload()
{	
    try{
        $vDiretorio = "imagens/";
        $vCaminho = $vDiretorio . basename($_FILES["foto"]["name"]);
        $vExtension = strtolower(pathinfo($vCaminho, PATHINFO_EXTENSION));
        $vCheck = getimagesize($_FILES["foto"]["tmp_name"]);
    
        if (!$vCheck) {
            throw new Exception("O arquivo não é uma imagem");
        }
        // Check if file already exists
        if (file_exists($vCaminho)) {
            throw new Exception("O Arquivo já existe");
        }
    
        // Check file size
        if ($_FILES["foto"]["size"] > 500000) { //arquivo acima de 500 KB
            throw new Exception("Arquivo muito grande");
        }
    
        // Allow certain file formats
        if ($vExtension != "jpg" && $vExtension != "png" && $vExtension != "jpeg") {
            throw new Exception("Só aceitamos arquivos nos formatos> JPG, JPEG e PNG");
        }
        // Check if $uploadOk is set to 0 by an error   
        
        if (move_uploaded_file($_FILES["foto"]["tmp_name"], $vCaminho)) {
            return $vCaminho;
        } else {
            throw new Exception("Não foi possível colocar o arquivo no diretório");
        }
    }catch(Exception $objErr){
        return false;        
    }
    
}
function deletar($vId){
    try {
        if(isset($vId)){
            $vProdutos = readId($vId,"Produtos");

            if(unlink($vProdutos['foto_produto'])){
                if(!is_null($vIdProducao = ReadOne("op.id_orcamento_produto","Produtos p","p.id_produto", $vId, "Orcamento_Produtos op on p.id_produto = op.fk_produto"))){
                    if(deleteImageOrcamento($vIdProducao['id_orcamento_produto'],"Orcamento_Produtos op","id_orcamento","op.fk_orcamento","op.id_orcamento_produto")){
                        deleteReferencia("oc","Orcamento_Produtos oc","Produtos p","oc.fk_produto", "p.id_produto",$vId);	
                    }
                    else {
                        throw new Exception("Erro ao Deletar foto de Orçamento");
                    }
                }
                delete($vId,"_produtos");
            } 
            else {
                throw new Exception("Erro ao deletar a foto");
            }
        }
        header("Location:../index.php");
    } catch (Exception $objErr) {
        echo "<script>abrirErro();</script>" . $objErr->getMessage();
    }
}