<?php
include "funcoes.php";
include HEADER_TEMPLATE;
$vFk = null;
/*
	Fk nulo --> funcionario
	Fk preenchido --> cliente
*/
if (!empty($_GET['i'])){
    $vFk = base64_decode($_GET['i']);
   $vDates = leitura($vFk);    
}
else{
	$vDates = leitura();
}
?>
<?php if (!is_null($vDates) and ! is_bool($vDates)) : ?>
	<br>
<div class="boxleitura">
	<h1 class="text-center">Meus Orçamentos</h1>
	<hr>
	<div class="table-responsive">
		<table class="table table-striped table-hover table-dark" style="text-align: center;">
			<thead>
				<tr>
					<?php if(is_null($vFk)): ?>
						<th scope="col" >Nome do Cliente</th>
					<?php endif; ?>
                    <th scope="col">Data da Entrega</th>
					<th scope="col">Material</th>
					<th scope="col">Serviço</th>
					<th scope="col">Número de Parcelas</th>
					<th scope="col">Valor Parcela</th>
					<th scope="col">Valor Total</th>
					<th scope="col">Forma de Pagamento</th>
					<th scope="col">Pagamento Feito</th>
                    <th scope="col">Opções</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($vDates as $vKey):?>
					
					<?php
						if($vKey['conclupag_orcamento'] == "n"){
							$vEntrega = "A Pagar";
							$vConclupag = "Não";
						}
						else {
							$vEntrega = formataData($vKey['entrega_orcamento'],"d/m/Y") ;
							$vConclupag = "Sim";
						}
					?>
					<tr>
						<?php if(is_null($vFk)):?>
							<td><?php echo $vKey['nome_cliente']; ?></td>
						<?php else: ?>
							<td><?php echo $vKey['nome_funcionario'] ?></td>
						<?php endif; ?>
						<td><?php echo $vEntrega; ?></td>
						<td><?php echo $vKey['material_orcamento']; ?></td>
						<td><?php echo $vKey['servico_orcamento']; ?></td>
						<td ><?php echo $vKey['parcelas_orcamento']; ?></td>
						<td ><?php echo $vKey['valorParcelas_orcamento']; ?></td>
						<td ><?php echo $vKey['valorTotal_orcamento']; ?></td>
						<td><?php echo $vKey['formapag_orcamento']; ?></td>
						<td><?php echo $vConclupag; ?></td>
						<?php
						$vId = base64_encode($vKey['id_orcamento']); //codifica o id
						?>
						<td>
							<?php if(!check_cliente()): ?>
								<a class=" btn buttone" href="edit.php?i=<?php echo $vId;?>">Editar</a>
								<a class=" btn buttond" href="deletar.php?i=<?php echo $vId;?>">Deletar</a>
								<?php if($vConclupag == "Sim"):?>
									<a class=" btn buttonp" href="../producao/leitura.php">Produção</a>
								<?php endif; ?>
							<?php endif; ?>
						</td>
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
	<h1>Nenhuma Agenda</h1>
<?php endif; ?>
<?php include FOOTER_TEMPLATE; ?>