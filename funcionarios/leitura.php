<?php
 include "funcoes.php";
include HEADER_TEMPLATE;
$vDates = leitura();							
?>

<br>
<?php if (!is_null($vDates) and ! is_bool($vDates)) : ?>
<div class="boxleitura">
<h1 class="text-center">Funcionários</h1>
<hr>
<div class="table-responsive">
	<table class="table table-striped table-hover table-dark">
		<thead>
			<tr>
				<th scope="col">Nome</th>
				<th scope="col">Telefone</th>
				<th scope="col">Email</th>
				<th scope="col">RG</th>
				<th scope="col">Endereço</th>
				<th scope="col">Salário</th>
				<th scope="col">Cargo</th>
				<th scope="col">Opção </th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($vDates as $vKey):?>
				<tr >
					<td  scope="row"><?php echo $vKey['nome_funcionario']; ?></td>
					<td ><?php echo $vKey['telefone_funcionario']; ?></td>
					<td ><?php echo $vKey['email_funcionario']; ?></td>
					<td ><?php echo $vKey['rg_funcionario']; ?></td>
					<td ><?php echo $vKey['endereco_funcionario']; ?></td>
					<td ><?php echo $vKey['salario_funcionario']; ?></td>
					<td ><?php echo $vKey['cargo_funcionario']; ?></td>
					<?php
						$vId = base64_encode($vKey['id_funcionario']); //codifica o id
						$_GET['i'] = $vId; ?>
					<td><a class=" btn buttone" href="edit.php?i=<?php echo $_GET['i'];?>">Editar</a>
					<a class=" btn buttond" href="deletar.php?i=<?php echo $_GET['i'];?>">Deletar</a></td>
				</tr>
			<?php endforeach;?>
		</tbody>
	</table>
	<a class="btn buttond botao-direita" href="../index.php">Voltar</a>
	<br>
			<br>
</div>
</div>
<?php else: ?>
	<h3>Nenhum Trabalho.</h3>
<?php endif; ?>
<br>
<?php include FOOTER_TEMPLATE; ?>
