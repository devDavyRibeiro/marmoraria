<?php
include "funcoes.php";
include HEADER_TEMPLATE;
if (empty($_GET['i'])) {
    header("Location: index.php");
}

$vId = base64_decode($_GET['i']);
$vValue = editar($vId);
?>
<br>
<div class="boxcadastro">
    <h1 class="text-center">Edição de Produtos</h1>
    <hr>
    <div class="formulario container">
        <form action="edit.php?i=<?php echo $_GET['i']; ?>" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="mb-3 col-11">
                    <label class="ms-1 form-label">Nome</label>
                    <input type="text" class="form-control" name="nome" value="<?php echo $vValue['nome_produto'] ?>" required maxlength="100">
                </div>
            </div>
            <div class="row">
                <div class="mb-3 col-11">
                <label for="" class="form-label">Foto do Produto</label>
                <input type="file" class="form-control" name="foto" placeholder="Foto do Produto">
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