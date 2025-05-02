<?php
include "funcoes.php";
include HEADER_TEMPLATE;
form();
?>
<br>
<div class="boxcadastro">
    <h1 class="text-center">Cadastro de Produtos</h1>
    <hr>
    <div class="formulario container">
        <form action="#" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="mb-3 col-11">
                    <label class="ms-1 form-label">Nome</label>
                    <input type="text" class="form-control" name="nome" required maxlength="100" placeholder="Nome do Produto">
                </div>
            </div>
            <div class="row">
                <div class="mb-3">
                <label for="" class="form-label">Foto do Produto</label>
                <input type="file" class="form-control" name="foto" id=""placeholder="Foto do Produto">
                </div>
            </div>
            <div class="row">
                <div>
                    <button type="submit" class="btn buttone text-center">Criar</button>
                    <a href="../index.php" type="reset" class="btn buttond2 text-center">Cancelar</a>
                </div>
            </div>
        </form>
    </div>
    <br>
</div>
<?php include FOOTER_TEMPLATE; ?>