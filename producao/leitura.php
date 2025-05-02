<?php
include "funcoes.php";
include HEADER_TEMPLATE;
$vDates = leitura();
?>
<br>
<?php if (!is_null($vDates) and ! is_bool($vDates)) : ?>
	<div class="boxleitura">
		<h1 class="text-center">Todos Em Produção</h1>
		<hr>
		<div class="table-responsive">
			<table class="table table-striped table-hover table-dark">
				<thead>
					<tr>

						<th scope="col">Data de Entrega</th>
						<th scope="col">Produto</th>
						<th scope="col">Foto do Produto</th>
						<th scope="col">Material</th>
						<th scope="col">Serviço</th>
						<th scope="col">Projeto de Bancada</th>
						<th scope="col">Status</th>
						<th>Opções</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($vDates as $vKey) : ?>
					<tr>
						<td><?php echo formataData($vKey['entrega_orcamento'], "d/m/Y"); ?></td>
						<td><?php echo $vKey['nome_produto']; ?></td>
						<td><img class="img-fluid" style="" src="../produtos/<?php echo $vKey['foto_produto']; ?>" alt="Foto do Produto"></td>
						<td><?php echo $vKey['material_orcamento']; ?></td>
						<td><?php echo $vKey['servico_orcamento']; ?></td>
						<td><img class="img-fluid" src="../orcamentos/<?php echo $vKey['foto_orcamento']; ?>" alt="Imagem do Projeto de Bancada"></td>
						<td><?php echo $vKey['status_orcamento_produto'] ?></td>
						<?php
						$vId = base64_encode($vKey['id_orcamento_produto']); //codifica o id
						$_GET['i'] = $vId; ?>
						<?php if($vKey['status_orcamento_produto'] == "Concluído") : ?>
							<td>
								<a class="btn buttone" href="edit.php?i=<?php echo $_GET['i']; ?>">Editar</a>
								<a class="btn buttond" href="deletar.php?i=<?php echo $_GET['i']; ?>">Deletar</a>
							</td>
						<?php else: ?>
							<td>-</td>
						<?php endif; ?>
					</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
			<a class="btn buttond botao-direita" href="../index.php">Voltar</a>
			<br>
			<br>
		</div>
	</div>
<?php else : ?>
	<h1>Nenhum Produção</h1>
<?php endif; ?>
<?php include FOOTER_TEMPLATE; ?>