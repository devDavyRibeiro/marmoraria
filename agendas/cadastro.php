<?php
include "funcoes.php";
include HEADER_TEMPLATE;

if (!empty($_GET['i'])) {
    $vId = base64_decode($_GET['i']);
    form($vId);
} else {
    header("Location:../index.php");
}

?>
<br>
<div class="boxcadastro">
    <h1 class="text-center">Data da Visita</h1>
    <hr>
    <div class="formulario container">
        <form action="#" method="post" enctype="multipart/form-data">
            <div class="row">
                <p><a style="color: green; text-decoration: underline;" href="https://wa.me/5515997285951?text=Oi,%20estou%20entrando%20em%20contato%20através%20do%20site.%20Gostaria%20de%20fazer%20uma%20encomenda%20por%20favor">Agende sua visita conosco </a></p>
            </div>
            <div class="row">
                <div class="mb-3 col-11">
                    <label class="ms-1 form-label" for="descrição">Descrição</label>
                    <textarea name="descricao" class="form-control" id="descrição" cols="30" rows="5" placeholder="Descricão da Visita" required></textarea>
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