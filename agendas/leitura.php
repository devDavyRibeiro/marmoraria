<?php
include "funcoes.php";
include HEADER_TEMPLATE;

if (!empty($_GET['i'])){
    $vFk = base64_decode($_GET['i']);
   $vDates = leitura($vFk);    
}
else{
	$vDates = leitura();
}
?>
<br>
<?php if (!is_null($vDates) and ! is_bool($vDates)) : ?>
	<div class="boxleitura">
		<h1 class="text-center">Meus Agendamentos</h1>
		<hr>
		<div class="table-responsive">
			<table class="table table-striped table-hover table-dark">
				<thead>
					<tr>
						<th scope="col">Data da Visita</th>
						<th scope="col">Descrição</th>
						<th scope="col">Nome do Funcionário</th>
						<th scope="col">Telefone</th>
						<th>Opções</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($vDates as $vKey):?>
						<tr >
							<?php if($vKey['visita_agenda'] == '0000-00-00 00:00:00'): ?>
								<td scope="row">Nenhuma data de visita</td>
							<?php else: ?>
								<td scope="row"><?php echo formataData($vKey['visita_agenda'],"d/m/Y H:m") ; ?></td>
							<?php endif; ?>
							<td ><?php echo $vKey['descricao_agenda']; ?></td>
							<td ><?php echo $vKey['nome_funcionario']; ?></td>
							<td ><?php echo  formataTelefone($vKey['telefone_funcionario']); ?></td>
							<?php
							$vId = base64_encode($vKey['id_agenda']); //codifica o id
							$_GET['i'] = $vId; ?>
							<td>
								<?php if(!check_funcionario()): ?>
									<a class="btn buttone" href="edit.php?i=<?php echo $_GET['i'];?>">Editar</a>
									<a class="btn buttond" href="deletar.php?i=<?php echo $_GET['i'];?>">Deletar</a>
								<?php else:?>
									<a class="btn buttone" href="edit.php?i=<?php echo $_GET['i'];?>&f=Func">Editar</a>
									<a class="btn buttonp" href="deletar.php?i=<?php echo $_GET['i'];?>">Concluido</a>
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