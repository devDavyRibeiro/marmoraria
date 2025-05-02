<?php
include "funcoes.php";
include HEADER_TEMPLATE;
if (empty($_GET['i'])) {
    header("Location: index.php");
}

$vId = base64_decode($_GET['i']);
$vValue = editar($vId);
$vNome = NomeCliente($vId);
$vProdutos = TodosProdutos();
$vFkProduto = FKProduto($vId);

?>
<br>
<div class="boxcadastro">
    <h1 class="text-center">Edição do Orçamento: <?php echo $vNome; ?></h1>
    <hr>
    <div class="formulario container">
        <form action="#" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="mb-3 col-11">
                    <label for="pag" class="form-label">Pagamento Concluído?</label>
                    <select class="form-select" name="conclupag" id="pag" onchange="ReadOnlyData()">
                        <?php if ($vValue['conclupag_orcamento'] == "n") : ?>
                            <option selected value="n">Não</option>
                            <option value="s">Sim</option>
                        <?php else : ?>
                            <option value="n">Não</option>
                            <option selected value="s">Sim</option>
                        <?php endif; ?>
                    </select>
                </div>
            </div>
            <div class="row" id="divDataEntrega" <?php if ($vValue['conclupag_orcamento'] == "s") : ?> style="display: block;" <?php else : ?> style="display: none;" <?php endif; ?>>
                <?php
                if (is_null($vValue['entrega_orcamento'])) {
                    $vEntrega = null;
                } else {
                    $vEntrega = formataData($vValue['entrega_orcamento'], "d/m/Y");
                }
                ?>
                <div class="mb-3 col-11">
                    <label for="data">Data de Entrega</label>
                    <input type="date" name="entrega" class="form-control" <?php if ($vValue['conclupag_orcamento'] == "n") : ?> disabled <?php endif; ?> id="data" <?php if ($vValue['conclupag_orcamento'] == "n") : ?> <?php endif; ?> value="<?php echo $vEntrega ?>">
                </div>
            </div>

            <div id="DivMaster" <?php if ($vValue['conclupag_orcamento'] == "s") : ?> style="display: none;" <?php else : ?> style="display: block;" <?php endif; ?>>
                <?php if (is_array($vProdutos)) : ?>
                    <div class="row">
                        <div class="mb-3 col-11">
                            <label>Produto</label>
                            <select name="fk_produto" id="fk_produto" class="form-select">
                                <?php foreach ($vProdutos as $vKey) : ?>
                                    <?php if($vFkProduto == $vKey['id_produto']):?>
                                        <option selected value="<?php echo $vKey['id_produto']; ?>"><?php echo $vKey['nome_produto']; ?>
                                    <?php else: ?>
                                        <option value="<?php echo $vKey['id_produto']; ?>"><?php echo $vKey['nome_produto']; ?></option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                <?php endif; ?>
                <div class="row">
                    <div class="mb-3 col-11">
                        <label for="inputServico">Serviço a Ser Prestado </label>
                        <input type="text" class="form-control" id="inputServico" value="<?php echo $vValue['servico_orcamento']; ?>" name="servico" required>
                    </div>
                </div>
                <div class="row">
                    <div class="mb-3 col-11">
                        <label for="inputMaterial">Material </label>
                        <input type="text" class="form-control" id="inputMaterial" value="<?php echo $vValue['material_orcamento']; ?>" name="servico" required>
                    </div>
                </div>
                <div class="row">
                    <div class="mb-3 col-11">
                        <label class="ms-1 form-label" for="inputImagem">Projeto de Bancada (desenho técnico)</label> <br>
                        <img class="img-fluid rounded mb-4" id="imagemPreview" src="<?php echo $vValue['foto_orcamento']; ?>" alt="Imagem do Projeto de Bancada" style="border:3px solid white;">
                        <input type="file" name="foto" class="form-control" id="inputImagem" onchange="previewImagem(event)" accept="image/*">
                    </div>
                </div>
                <div class="row">
                    <div class="mb-3 col-11">
                        <label class="form-label">Forma de Pagamento</label>
                        <select class="form-select" name="formapag" id="pagamento" onchange="Parcelas()">
                            <?php if ($vValue['formapag_orcamento'] == "Pix") : ?>
                                <option selected value="Pix">Pix</option>
                                <option value="Cartão de Crédito">Cartão de crédito</option>
                                <option value="Transferência">Transferência</option>
                            <?php elseif ($vValue['formapag_orcamento'] == "Cartão de Crédito") : ?>
                                <option value="Pix">Pix</option>
                                <option selected value="Cartão de Crédito">Cartão de crédito</option>
                                <option value="Transferência">Transferência</option>
                            <?php else : ?>
                                <option value="Pix">Pix</option>
                                <option value="Cartão de Crédito">Cartão de crédito</option>
                                <option selected value="Transferência">Transferência</option>
                            <?php endif; ?>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="mb-3 col-11">
                        <label class="ms-1 form-label ">Valor</label>
                        <input type="number" class="form-control" id="inputValor" name="valorTotal" value="<?php echo $vValue['valorTotal_orcamento'] ?>" required min="0">
                    </div>
                </div>

                <div class="row" id="parcelaDiv" <?php if ($vValue['formapag_orcamento'] != "Cartão de Crédito") : ?> style="display:none;" <?php endif; ?>>
                    <div class="mb-3 col-11">
                        <label class="ms-1 form-label">Número de Parcelas</label>
                        <input type="number" class="form-control" id="Nparcelas" name="parcelas" value="<?php echo $vValue['parcelas_orcamento']; ?>">
                    </div>
                </div>
            </div>

            <script src="orcamento.js"></script>
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