<?php
include "funcoes.php";
include HEADER_TEMPLATE;

if (empty($_GET['i'])) {
    header("Location: ../index.php");
}
$vId = base64_decode($_GET['i']);
$vValue = editar($vId);
?>
<br>
<div class="boxcadastro">
    <h1 class="text-center">Edição da Produção</h1>
    <hr>
    <div class="formulario container">
        <form action="#" method="post">
            <br>
            <div class="row">
                <div class="mb-3 col-11">
                    <label id="Status" class="ms-1 form-label ">Status da Produção</label>
                    <select class="form-select" name="status" id="Status">
                        <?php if($vValue['status_orcamento_produto'] == "Em Produção"): ?>
                            <option selected value="Em Produção">Em Produção</option>
                            <option value="Concluído">Concluído</option>
                        <?php else: ?>
                            <option  value="Em Produção">Em Produção</option>
                            <option selected value="Concluído">Concluído</option>
                        <?php endif; ?>
                    </select>
                </div>
            </div>
            <div class="row">
                <div>
                    <button type="submit" class="btn buttone text-center">Salvar</button>
                    <a href="../index.php" type="reset" class="btn buttond2 text-center">Cancelar</a>
                </div>
            </div>
        </form>
    </div>
    <br>
</div>
<?php include FOOTER_TEMPLATE; ?>