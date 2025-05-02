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
            invalid_Clientes();
            $vFkProdutos = $_POST['fk_produto'];
            unset($_POST['fk_produto']);
            $vOrcamentos = $_POST;
            if (is_null($vFk)) {
                if($vIdFuncionario = readOutros("id_funcionario","Funcionarios","cargo_funcionario","orçamento"))
                foreach ($vIdFuncionario as $key) {

                    $vOrcamentos['fk_funcionario'] = $key['id_funcionario'];
               } 
                else
                    throw new Exception("Sem funcionários da funcionalidade 'Orçamento'");
            }
            if (!empty($_FILES["foto"]["name"]) ) {
                if (!$vOrcamentos['foto'] = upload()) {
                    throw new Exception("Erro no upload");    
                }
            } else {
                throw new Exception("Vazio o campo Files");
            }
            var_dump($vOrcamentos['foto']);
            if(isset( $vOrcamentos['parcelas']))
                $vOrcamentos['valorParcelas'] = $vOrcamentos['valorTotal'] / $vOrcamentos['parcelas'];
            else
                 $vOrcamentos['valorParcelas'] = 0;
            $vOrcamentos['conclupag'] = "n";
            $vOrcamentos['fk_funcionario'] = $vFk;
            
            $vIdOrcamento = add($vOrcamentos,"_orcamentos",false);

            $vProducoes = array(
                'fk_orcamento'=> $vIdOrcamento,
                'fk_produto' => $vFkProdutos,
                'status' => 'A Pagar'
            );
            add($vProducoes,"_orcamento_produtos");
            
        } catch(Exception $objErr){
            echo "<script>abrirErro();</script>" . $objErr->getMessage();
        }
      
    }

}
function leitura($vFk = null){
    try {
        if (!is_null($vFk)) { //Cliente
            $vSelect = "o.id_orcamento, o.entrega_orcamento, o.parcelas_orcamento, o.valorTotal_orcamento,o.valorParcelas_orcamento, o.formapag_orcamento, o.conclupag_orcamento, o.servico_orcamento,o.material_orcamento";
            $vWhere = "o.fk_cliente = ?";
            $vResult = readInner($vSelect, "Orcamentos o ", "Funcionarios f", "o.fk_funcionario", "f.id_funcionario",null,null,$vWhere,$vFk);
            
        }
        else { //Funcionario
            $vSelect = "o.id_orcamento, o.entrega_orcamento, o.parcelas_orcamento, o.valorTotal_orcamento,o.valorParcelas_orcamento, o.formapag_orcamento, o.conclupag_orcamento, o.servico_orcamento,o.material_orcamento, o.foto_orcamento, c.nome_cliente";
            $vResult = readInner($vSelect, "Orcamentos o ", "Funcionarios f", "o.fk_funcionario", "f.id_funcionario", "Clientes c","c.id_cliente",null,null,"o.fk_cliente");
        }

        return $vResult;
    } catch(Exception $objErr){
        echo "<script>abrirErro();</script".$objErr->getMessage(); 
    }
}
function editar($vId)
{
    valid_login();
    Invalid_Clientes();
    try {
        if(isset($vId)){
            $vValue = readId($vId,"Orcamentos");
            if ($_SERVER['REQUEST_METHOD'] == "POST") {
                if (!empty($_POST)) {
                    $vOrcamentos = $_POST;
                    $vFkProduto = $vOrcamentos['fk_produto'];
                    unset($vOrcamentos['fk_produto']);
                   
                    if ($vOrcamentos['conclupag'] == "n") {
                        $vOrcamentos['entrega'] = null;
                        if (isset($vOrcamentos['parcelas']) and $vOrcamentos['parcelas'] != 0)
                            $vOrcamentos['valorParcelas'] = $vOrcamentos['valorTotal'] / $vOrcamentos['parcelas'];
                        else
                            $vOrcamentos['valorParcelas'] = 0;
                        if (!empty($_FILES["foto"]["name"])) {
                            if ($vFotoNova =  upload()){
                                if (unlink($vValue['foto_orcamento'])) {
                                    $vOrcamentos['foto'] = $vFotoNova;
                                }
                                else {
                                    unlink($vFotoNova);
                                    throw new Exception("Erro ao sunstituir foto");                
                                }
                            }
                             else {
                                throw new Exception("Erro no upload");
                            }
                        } else {
                            $vOrcamentos['foto'] = $vValue['foto_orcamento'];
                        }
                    }else {
                        if (DataLivre($vOrcamentos['entrega'])) {
                            
                        }
                    }
                    update($vId, $vOrcamentos, "_orcamentos",false);
                    $vProducao = array(
                        'fk_produto' => $vFkProduto
                    );
                    if ($vOrcamentos['conclupag'] == 's') {
                        $vProducao['status'] = "Em Produção"; 
                    }
                    else {
                        $vProducao['status'] = "A Pagar"; 
                    }

                    $vIdProduto = ReadOne("id_orcamento_produto","Orcamento_Produtos","fk_orcamento",$vId);
                      
                    update($vIdProduto['id_orcamento_produto'],$vProducao,"_orcamento_produtos");

                } else {
                    throw new Exception("Erro no formulário");
                }
            }
            return $vValue;
        }
        
    } catch (Exception $objErr) {
        echo "<script>abrirErro();</script".$objErr->getMessage(); 
    }
}
function deletar($vId){
    valid_login();
    invalid_Clientes();
    try {
        
        $vFoto = readId($vId,"Orcamentos");
        if(unlink($vFoto['foto_orcamento']))
        {
            deleteReferencia("oc","Orcamento_Produtos oc","Orcamentos o","oc.fk_orcamento", "o.id_orcamento",$vId);	
            delete($vId,"_orcamentos");
        }
        else {
            throw new Exception("Não foi possível apagar imagem");    
        }
       header("Location:index.php");
    } catch (Exception $objErr) {
        echo "<script>abrirErro();</script".$objErr->getMessage(); 
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
    }catch(Exception){
        return false;
    }
    
}
function DataLivre($vData){
    if (!readOutros("visita_agenda","Agendas","visita_agenda",$vData))
        return true;  
    else 
        return false;
}
function TodosClientes(){
    $vCliente = readInner("DISTINCT c.id_cliente, c.nome_cliente","Clientes c","Agendas a","id_cliente","fk_cliente");
    return $vCliente;
}
function NomeCliente($vId){
    $vCliente = readOutros("c.nome_cliente","Orcamentos o inner join Clientes c on o.fk_cliente = c.id_cliente","id_orcamento",$vId);
    foreach ($vCliente as $vKey) {
        $vNome = $vKey['nome_cliente'];
    }
    return $vNome;
}
function TodosProdutos(){
    $vProdutos = readOutros("id_produto, nome_produto, foto_produto","Produtos");
    return $vProdutos;
}
function FKProduto ($vId){
    $vFk = readInner("op.fk_produto","Orcamento_Produtos op","Orcamentos o", "op.fk_orcamento","o.id_orcamento",null,null,"o.id_orcamento=?",$vId);
   
    $vFkProduto = 0;
    foreach ($vFk as $vKey) {
        $vFkProduto = $vKey['fk_produto'];
    }
    return $vFkProduto;
}
?>