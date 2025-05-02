<?php
require "../config.php";
include DATABASE;

function login(){
    if(!empty($_POST)){ 
        $objDatabase = open_db();
        $vLogin = $_POST;
        $vLogin['senha'] = criptografia($vLogin['senha']);

        try {
            $vSql = "SELECT id_cliente, email_cliente, senha_cliente FROM Clientes WHERE email_cliente = ? and senha_cliente = ?";
            $vStmt = $objDatabase->prepare($vSql); //Sql de Clinetes

            $vStmt->execute([$vLogin['email'],$vLogin['senha']]);
            if ($vStmt->rowCount() > 0){ //verifica o número de linhas dada pelo Sql
                $vResultado = $vStmt->fetch(); //retorna os valores dado no Select
                $_SESSION['id'] = base64_encode($vResultado['id_cliente']);
                $_SESSION['email'] = $vResultado['email_cliente'];
                $_SESSION['senha'] = $vResultado['senha_cliente'];
                $_SESSION['cargo'] = "Cliente";
				header('location:../index.php');
                
            }
            else {
                $vStmt = $objDatabase->prepare("SELECT id_funcionario, email_funcionario, senha_funcionario, nivel_funcionario, cargo_funcionario FROM Funcionarios WHERE email_funcionario= ? and senha_funcionario= ?");
                $vStmt->execute([$vLogin['email'],$vLogin['senha']]);
                
                if ($vStmt->rowCount() > 0){
                    $vResultado = $vStmt->fetch();
                    $_SESSION['id'] = base64_encode($vResultado['id_funcionario']);
                    $_SESSION['email'] = $vResultado['email_funcionario'];
                    $_SESSION['senha'] = $vResultado['senha_funcionario'];
                    $_SESSION['nivel'] = $vResultado['nivel_funcionario'];
                    $_SESSION['cargo'] = $vResultado['cargo_funcionario'];
                    close_db($objDatabase);
					header('location:../index.php');
                }
                else {
                    throw new Exception("Email ou senha inválidos");  // caso não ache nenhum resultado, retorna um Erro
                }
            }
        } catch (Exception $objErr) {
            close_db($objDatabase);
            echo "<script>abrirErro();</script".$objErr->getMessage(); 
            header("Location:".BASEURL);
        }
    }
}

login();
?>
