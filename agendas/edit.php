<?php
include "funcoes.php";
include HEADER_TEMPLATE;

if (empty($_GET['i'])) {
    header("Location: ../index.php");
}
$vId = base64_decode($_GET['i']);
$vValue = editar($vId);
$vF = null;
if (isset($_GET['f'])) {
    $vF = $_GET['f'];
}
?>
<br>
<div class="boxcadastro">
    <?php if (!is_null($vF)) : ?>
        <h1 class="text-center">Alterar Data da Visita</h1>
    <?php else : ?>
        <h1 class="text-center">Alterar o Agendamento</h1>
    <?php endif; ?>
    <hr>
    <div class="formulario container">
        <form action="#" method="post">
            <?php if (!is_null($vF)) : ?>
                <div class="row">
                    <p><a style="color: green; text-decoration: underline;" href="https://wa.me/5515997285951?text=Oi,%20estou%20entrando%20em%20contato%20através%20do%20site.%20Gostaria%20de%20fazer%20uma%20encomenda%20por%20favor">Agende sua visita conosco </a></p>
                </div>
                <div class="row">
                    <div class="mt-4 mb-3 col-11">
                        <label class="ms-1 form-label" for="descp">Descrição</label>
                        <textarea name="descricao" class="form-control" id="descp" cols="30" rows="10"> <?php echo $vValue['descricao_agenda'] ?></textarea>
                    </div>
                </div>
            <?php else : ?>
                <div class="row">
                    <div class="mb-3 col-11">
                        <label for="alterarDT" class="form-label">Alterar Data de Visita?</label>
                        <select class="form-select" id="alterarDT" onchange="DataAlterada()">
                            <option selected value="n">Não</option>
                            <option value="s">Sim</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="mb-3 col-11">
                        <label class="ms-1 form-label" for="dtVisita">Data da Visita</label>
                        <input type="datetime-local" class="form-control" name="visita" id="dtVisita" min="<?php echo date('Y-m-d\TH:i'); ?>" value="<?php echo $vValue['visita_agenda']; ?>" disabled required>
                    </div>
                </div>
                <script>
                    function DataAlterada() {
                        var selectAlterar = document.getElementById("alterarDT");
                        var dtVisita = document.getElementById("dtVisita");


                        if (selectAlterar.value === "s") {
                            dtVisita.removeAttribute("disabled");
                        } else {
                            dvData.style.display = 'none';
                            dtVisita.setAttribute("disabled", "disabled");
                        }
                    }
                </script>
            <?php endif; ?>
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