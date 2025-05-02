<?php
session_start(); //inicializa a Session
$objDatabase = null;
date_default_timezone_set("America/Sao_Paulo");
function open_db()
{ // conexão com o banco de dados 
	$vServer = "localhost"; //nome do servidor 
	$vUser = "root"; //nome do usuário
	$vPassword = ""; //senha
	$vName = "marmoraria_bd"; //nome do banco
	try {
		$vConexao = new PDO("mysql:host=$vServer;dbname=$vName", $vUser, $vPassword);
		$vConexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$_SESSION['success'] = "Conexão feita com sucesso";
		return $vConexao;
	} catch (PDOException $vErr) {
		$_SESSION['danger'] = "Erro ao conectar ao banco" .  $vErr->getMessage();
	}
}
function close_db($obj)
{ //desconexão do bando de dados
	$obj = null;
}


// função que organiza e insere dados nas tabelas. OBS: em $vTabela deve estar no seguinte formato: _NomeDaTabela
// em $Post deve colocar a variável global $_POST 
function add($vPost, $vTabela, $vSuccess = null)
{
	$objDatabase = open_db();

	$vUpdate = null;
	$vValues = null;

	foreach ($vPost as $vKey => $vDado) {
		if (strpos($vKey,"_")) {
			$vUpdate.= $vKey.',';
			$vValues.="'$vDado',";
			continue;
		}
		$vUpdate .=  trim($vKey . rtrim($vTabela, 's'), "'") . ","; // parte do campo . Tira as aspas  e 's'. Também coloca o underlin
		$vValues .= "'$vDado',"; // coloca as aspas e virgula. Parte dos valores
	}

	$vUpdate = rtrim($vUpdate, ','); // tira a última vírgula
	$vValues = rtrim($vValues, ',');
	
	$vTabela = ltrim($vTabela, "_");
	$vTabela = ucfirst($vTabela);

	$vSql = "INSERT INTO $vTabela($vUpdate)VALUES($vValues)"; //sql da inserção

	try {
		$vStmt = $objDatabase->prepare($vSql); //prepara para execução
		$vStmt->execute(); // executa o código sql
		
		if ($vStmt->rowCount() > 0) {
			if(is_null($vSuccess) or $vSuccess == true)
				echo '<script>abrirAlerta();</script>';
			else{
				$vId = $objDatabase->lastInsertId();
				return $vId;
			}
		}
		close_db($objDatabase);
	} catch (Exception $objErr) {
		close_db($objDatabase);
		echo "<script>abrirErro();</script>" . $objErr->getMessage();
	}
}

function readBase($vTabela = null)
{
	$objDatabase = open_db();
	try {
		$vSql = "SELECT * FROM $vTabela";
		$vStmt = $objDatabase->query($vSql);
		if ($vStmt->rowCount() > 0) {

			$vResult = $vStmt->fetchAll();
			$objDatabase = close_db($objDatabase);
			return  $vResult; //$vFound;
		}
		else{
			 return false;
		}
		close_db($objDatabase);
	} catch (Exception $objErr) {
		close_db($objDatabase);
		echo "<script>abrirErro();</script>";
	}
}
function readId($vId, $vTabela)
{
	$objDatabase = open_db();
	try {
		$vCampo = "id_" . lcfirst(rtrim($vTabela, 's'));
		$vSql = "SELECT * FROM $vTabela WHERE $vCampo = ?";
		$vStmt = $objDatabase->prepare($vSql);
		$vStmt->execute([$vId]);

		if ($vStmt->rowCount() > 0) {
			$vResult = $vStmt->fetch(PDO::FETCH_ASSOC);
			return $vResult;
		} else {
			return null;
		}
		close_db($objDatabase);
	} catch (Exception $objErr) {
		close_db($objDatabase);
		echo "<script>abrirErro();</script>" . $objErr->getMessage();
	}
}
function readOutros($vSelect, $vTabela, $vCampo = null, $vPesquisa = null)
{
	$objDatabase = open_db();
	try {
		if (!is_null($vCampo) and !is_null($vPesquisa)) {
			$vSql = "SELECT $vSelect FROM $vTabela WHERE $vCampo = ?";
		}
		else {
			$vSql = "SELECT $vSelect FROM $vTabela";
		}
		
		$vStmt = $objDatabase->prepare($vSql);
		if (!is_null($vCampo) and !is_null($vPesquisa)) {
			$vStmt->execute([$vPesquisa]);
		}
		else {
			$vStmt->execute();
		}
		if ($vStmt->rowCount() > 0) {
			$vResult = $vStmt->fetchAll();
			return $vResult;
		} else {
			return false;
		}
		close_db($objDatabase);
	} catch (Exception $objErr) {
		close_db($objDatabase);
		echo "<script>abrirErro();</script>" . $objErr->getMessage();
	}
}
function readCount($vCount = null,$vTabela,$vCampo =null,$vPesquisa = null):int{
	$objDatabase = open_db();
	try {
		if(is_null($vCount)){
			$vText = "*";
		}
		else {
			$vText = $vCount; 
		}
		if (!is_null($vCampo) and !is_null($vPesquisa)) {
			$vSql = "SELECT COUNT($vText) FROM $vTabela WHERE $vCampo = ?";
		}
		else {
			$vSql = "SELECT COUNT($vText) FROM $vTabela";
		}
		
		$vStmt = $objDatabase->prepare($vSql);
		if (!is_null($vCampo) and !is_null($vPesquisa)) {
			$vStmt->execute([$vPesquisa]);
		}
		else {
			$vStmt->execute();
		}
		$vResult = $vStmt->fetchColumn();
	
		return $vResult;
		close_db($objDatabase);
	} catch (Exception $objErr) {
		close_db($objDatabase);
		echo "<script>abrirErro();</script>" . $objErr->getMessage();
	}
}
function ReadOne($vSelect,$vTabela,$vCampo,$vValor,$vInner = null){
	$objDatabase = open_db();
	try {
		if (isset($vInner)) {
			$vSql = "SELECT $vSelect FROM $vTabela INNER JOIN $vInner WHERE $vCampo = ?";
		}
		else {
			$vSql = "SELECT $vSelect FROM $vTabela WHERE $vCampo = ?";
		}
		var_dump($vSql);
		$vStmt = $objDatabase->prepare($vSql);
		$vStmt->execute([$vValor]);
		if($vStmt->rowCount()>0){
			$vResult = $vStmt->fetch();
			return $vResult;
		}
		else {
			$vResult = null;
			return $vResult;
		}
		close_db($objDatabase);
	} catch (Exception $objErr) {
		close_db($objDatabase);
		echo "<script>abrirErro();</script>" . $objErr->getMessage();
	}
}
function readInner($vSelect, $vTabela1,$vTabela2,$vCTabela1,$vCTabela2,$vTabela3 = null, $vCTabela3 = null,$vWhere = null,$vValor=null,$vNCTabela1 = null){
	$objDatabase = open_db();
	try {
		if (is_null($vTabela3) and is_null($vTabela3)) {
			$vSql = "SELECT $vSelect FROM $vTabela1 INNER JOIN $vTabela2 ON $vCTabela1 = $vCTabela2";
		}
		else {
			if(is_null($vNCTabela1)){
				$vSql = "SELECT $vSelect FROM $vTabela1 INNER JOIN $vTabela2 ON $vCTabela1 = $vCTabela2 INNER JOIN $vTabela3 ON $vCTabela1 = $vCTabela3";	
			}
			else{
				$vSql = "SELECT $vSelect FROM $vTabela1 INNER JOIN $vTabela2 ON $vCTabela1 = $vCTabela2 INNER JOIN $vTabela3 ON $vNCTabela1 = $vCTabela3";		
			}

		}
		
		if (!is_null($vWhere)) {
			if (is_null($vValor)) {
				throw new Exception("Valor Nulo para a clásula where");
			}
			$vSql.= " WHERE $vWhere";
		}
		
	
		$vStmt = $objDatabase->prepare($vSql);

		if(is_null($vValor)) {
			$vStmt->execute();
		}
		else {
			$vStmt->execute([$vValor]);
		} 
	
		if ($vStmt->rowCount() > 0) {
			$vResult = $vStmt->fetchAll();
			$objDatabase = close_db($objDatabase);
			return  $vResult;
		} else {
			return false;
		}
		close_db($objDatabase);
	} catch (Exception $objErr) {
		close_db($objDatabase);
		echo "<script>abrirErro();</script>" . $objErr->getMessage();
	}
}
function update($vId, $vPost, $vTabela, $vSuccess = null)
{
    $objDatabase = open_db();
    try {
        $vColumn = null;
        foreach ($vPost as $vPreColumn => $vDado) {
			if (strpos($vPreColumn,"_")) {
				$vColumn .= $vPreColumn . "=" . "'$vDado',";
				continue;
			}
            $vColumn .= $vPreColumn . rtrim($vTabela, 's') . '=' . "'$vDado',";
        }
    	$vColumn = rtrim($vColumn, ',');
    	$vTabela = ltrim($vTabela, "_");
    	$vSql = "UPDATE $vTabela SET $vColumn WHERE id_" . rtrim($vTabela, 's') . " = ?";
		
	    $vStmt = $objDatabase->prepare($vSql);
		$vStmt->execute([$vId]);
        if ($vStmt->rowCount() > 0) {
            // Atualização bem-sucedida, mostra o alerta
			if(is_null($vSuccess) or $vSuccess == true)
				echo '<script>abrirAlerta();</script>';
        }
		close_db($objDatabase);
    } catch (Exception $objErr) {
        // Trate a exceção conforme necessário
		close_db($objDatabase);
        echo "<script>abrirErro();</script>" . $objErr->getMessage();
    }
}
function delete($vId, $vTabela)
{
	$objDatabase = open_db();
	$vCampo = NULL;
	try {
		$vCampo = "id" . rtrim($vTabela, 's');
		$vTabela = ltrim($vTabela, "_");
		$vTabela = ucfirst($vTabela);

		$vSql = "DELETE FROM $vTabela WHERE $vCampo = ?";
		$vStmt = $objDatabase->prepare($vSql);
		$vStmt->execute([$vId]);
		if ($vStmt->rowCount() <= 0) {
			throw new Exception("Erro ao deletar");
		}
		close_db($objDatabase);
	} catch (Exception $objErr) {
		close_db($objDatabase);
		echo "<script>abrirErro();</script>" . $objErr->getMessage();
	}
}
function deleteImageOrcamento($vId,$vTabela,$vCTabelaOrc,$vCTabela,$vCampo){
	$objDatabase = open_db();
	try {
		$vSql = "SELECT o.foto_orcamento FROM Orcamentos o INNER JOIN $vTabela ON $vCTabelaOrc = $vCTabela WHERE $vCampo = ?";
		$vStmt = $objDatabase->prepare($vSql);
		$vStmt->execute([$vId]);
		if ($vStmt->rowCount() > 0) {
			$vValue = $vStmt->fetch();
			if (unlink("../orcamentos/".$vValue['foto_orcamento'])) {
				return true;
			}
		}
		else {
			return false;
		}
		$vValue = $vStmt->fetch();

		close_db($objDatabase);
	} catch (Exception){	
		close_db($objDatabase);
		return false;
	}
}
function criptografia($senha)
{ //criptografa a senha
	$custo = "08";
	$salt = "CflfllePArKlBJomMOF6aJ";
	$hash = crypt($senha, "$2a$" . $custo . "$" . $salt . "$");
	return $hash;
}

function check_login()
{ //checa se o Session está preenchido
	if (isset($_SESSION['email']) and $_SESSION['senha']) {
		if ($_SESSION['email'] == "" and $_SESSION['senha'] == "") return false;
		else return true;
	} else {
		$_SESSION['nivel'] = "0";
		return false;
	}
}
function check_funcionario()
{
	if ($_SESSION['nivel'] == 1) return true;
	else return false;
}
function check_admin()
{ //checa se o usuario é um admin
	if ($_SESSION['nivel'] == 2) return true;
	else return false;
}
function check_admin_funcionario()
{ //checa se o usuario é um admin
	if ($_SESSION['nivel'] == 2 or $_SESSION['nivel'] == 1) return true;
	else return false;
}
function valid_login()
{ //valida o check_login
	if (!check_login()) {
		//throw new Exception("Erro no Login");
		header("Location:" . BASEURL);
	}
}
function valid_id($vId){
	if ($vId != base64_encode( $_SESSION['id'])) {
		header("Location:" . BASEURL);
	}
}
function valid_admin()
{
	if (!check_admin()) { //valida o check_admin
		//throw new Exception("Inválido o nível do funcionário");
		header("Location:" . BASEURL . "funcionarios/");
	}
}
function valid_funcionario()
{
	if (!check_funcionario()) { //valida o check_admin
		//throw new Exception("Inválido o nível do funcionário");
		header("Location:" . BASEURL . "funcionarios/");
	}
}
function valid_admin_funcionario()
{
	if (!check_admin_funcionario()) { //valida o check_admin
		//throw new Exception("Inválido o nível do funcionário");
		header("Location:" . BASEURL . "funcionarios/");
	}
}

function check_cliente(){
	if(check_login() and $_SESSION['nivel'] == 0){
		return true;
	}
	else{
		false;
	}
}
function check_cargoOrcamento(){
	if($_SESSION['cargo'] == "orçamento" or $_SESSION['cargo'] == "admin"){
		return true;
	}
	else{
		false;
	}
}
function valid_cliente(){
	if(!check_cliente()){
		header("Location:" . BASEURL);
	}
}
function invalid_Clientes(){
    if (check_cliente()) {
        header("Location: ../index.php");
    }
}
function logout()
{ // saída do usuário
	$_SESSION['email'] = "";
	$_SESSION['senha'] = "";
	$_SESSION['id'] = "";
	$_SESSION['nivel'] = "0";
	header("location: ".BASEURL);
}

function formataTelefone($fone){
	return "(" . substr($fone,0,2) . ")" .
		substr($fone,2,5) . "-" . substr($fone,7,4);
}
function formataData ($data, $formato){
	$d = new DateTime($data);
	return $d->format($formato);
}
function deleteReferencia($vLetra,$vTabelaFk,$vTabelaId, $vCodigoFk,$vCodigoId,$vId) {
	$objDatabase = open_db();
	try { 
		$vSql="DELETE $vLetra
		FROM $vTabelaFk
		INNER JOIN $vTabelaId ON $vCodigoFk = $vCodigoId
		WHERE $vCodigoId=?"; 
		$vStmt = $objDatabase->prepare($vSql);
		$vStmt->execute([$vId]);
		if ($vStmt->rowCount() > 0) {
			return true;
		}
		close_db($objDatabase);
	} catch (Exception) {
		close_db($objDatabase);
		return false;
	}	
}
