<?php
include "funcoes.php";
include HEADER_TEMPLATE;

if (!empty($_GET['i'])) {
    $vId = base64_decode($_GET['i']);
    form($vId);
}
$vProdutos = TodosProdutos();
$vClientes = TodosClientes();
?>
<br>
<div class="boxcadastro">
    <h1 class="text-center">Criar um Orçamento</h1>
    <hr>
    <div class="formulario container">
        <form action="#" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="mb-3 col-11">
                    <label class="ms-1 form-label">Cliente</label>
                    <select name="fk_cliente" class="form-select">
                        <?php foreach ($vClientes as $vCliente) : ?>
                            <option value="<?php echo $vCliente['id_cliente'] ?>"><?php echo $vCliente['nome_cliente']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <?php if (is_array($vProdutos)) : ?>
                <div class="row">
                    <div class="mb-3 col-11">
                        <label>Produto</label>
                        <select name="fk_produto" id="fk_produto" class="form-select">
                            <?php foreach ($vProdutos as $vValue) : ?>
                                <option value="<?php echo $vValue['id_produto']; ?>"><?php echo $vValue['nome_produto']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            <?php endif; ?>
            <div class="row">
                <div class="mb-3 col-11">
                    <label class="ms-1 form-label ">Material do Pedido</label>
                    <input type="text" class="form-control" name="material" required>
                </div>
            </div>
            <div class="row">
                <div class="mb-3 col-11">
                    <label class="ms-1 form-label ">Serviço a Ser Prestado</label>
                    <input type="text" class="form-control" name="servico" required>
                </div>
            </div>
            <div class="row">
                <div class="mb-3 col-11">
                    <label class="ms-1 form-label" for="inputImagem">Projeto de Bancada (desenho técnico)</label> <br>
                    <img class="img-fluid rounded mb-4" id="imagemPreview" src="#" alt="Imagem do Projeto de Bancada" style="border:3px solid white;">
                    <input type="file" required name="foto" class="form-control" id="inputImagem" onchange="previewImagem(event)"accept="image/*">
                </div>
            </div>
            <script src="orcamento.js" ></script>
    <div class="row">
        <div class="mb-3 col-11">
            <label class="form-label">Forma de Pagamento</label>
            <select class="form-select" id="pagamento" name="formapag" onchange="Parcelas()">
                <option selected value="Pix">Pix</option>
                <option value="Cartão de Crédito">Cartão de crédito</option>
                <option value="Transferência">Transferência</option>
            </select>
        </div>
    </div>

    <div class="row">
        <div class="mb-3 col-11">
            <label class="ms-1 form-label ">Valor do Orçamento</label>
            <input type="number" class="form-control" name="valorTotal" required step="5" placeholder="R$00,00">
        </div>
    </div>

    <div class="row" id="parcelaDiv" style="display:none;">
        <div class="mb-3 col-11">
            <label class="ms-1 form-label ">Número de Parcelas</label>
            <input type="number" name="parcelas" class="form-control" id="Nparcelas" disabled step="1" min="2" value="2">
        </div>
    </div>

<script>
    function Parcelas() {
        var formaPagamento = document.getElementById('pagamento').value;
        var ParcelasDiv = document.getElementById('parcelaDiv');
        var nParcelas = document.getElementById('Nparcelas');
        if (formaPagamento === 'Cartão de Crédito') {
            ParcelasDiv.style.display = 'block';
            nParcelas.removeAttribute('disabled');
        } else {
            ParcelasDiv.style.display = 'none';
            nParcelas.setAttribute('disabled', 'true');
        }
    }
</script>
            <div class="row">
                
                <div>
                    <button type="submit" class="btn buttone text-center">Criar</button>
                    <a href="../index.php" type="reset" class="btn buttond2 text-center">Cancelar</a>
                </div>
                <br>
            </div>
        </form>
    </div>
    <br>
</div>
<?php include FOOTER_TEMPLATE; ?>