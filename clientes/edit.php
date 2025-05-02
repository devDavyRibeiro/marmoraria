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
  <h1 class="text-center">Edição do Perfil</h1>
  <hr>
    <div class="formulario container">
        <form action="#" method="post">
            <div class="row">
                <div class="mb-3 col-11">
                    <label class="ms-1 form-label">Nome</label>
                    <input type="text" class="form-control" name="nome"value="<?php echo $vValue['nome_cliente'] ?>" required maxlength="100">
                </div>
            </div>
            <div class="row">
                <div class="mb-3 col-11">
                    <label class="ms-1 form-label ">Telefone</label>
                    <input type="text" class="form-control" name="telefone"value="<?php echo $vValue['telefone_cliente'] ?>" required pattern="[0-9]{11}" maxlength="11">
                </div>
            </div>
            <div class="row">
                <div class="mb-3 col-11">
                    <label class="ms-1 form-label ">Email</label>
                    <input type="email" class="form-control" name="email" value="<?php echo $vValue['email_cliente'] ?>"required maxlength="100">
                </div>
            </div>
            <div class="row">
                <div class="mb-3 col-11">
                    <label class="ms-1 form-label ">RG</label>
                    <input type="text" class="form-control" name="rg"value="<?php echo $vValue['rg_cliente'] ?>" required pattern="[0-9]{9}" maxlength="9">
                </div>
            </div>
            <div class="row">
                <div class="mb-3 col-11">
                    <label class="ms-1 form-label ">Endereço</label>
                    <input type="text" class="form-control" name="endereco" value="<?php echo $vValue['endereco_cliente'] ?>"required maxlength="250">
                </div>
            </div>
            <div class="row">
                <div class="mb-4 col-11">
                    <label class="form-label">Senha</label>
                    <input type="password" class="form-control" name="senha" maxlength="50">
                </div>
            </div>
            <div class="row">
                <div>
                    <button type="submit" class="btn buttone text-center">Salvar</button>
                    <a href="../index.php" type="reset" class="btn buttond2 text-center">Cancelar</a>
                    <a href="<?php echo BASEURL; ?>clientes/deletar.php?i=<?php echo $_SESSION['id']; ?>">
                            <button class="btn glow-on-hover">Deletar Perfil</button>
                        </a>
                </div>
            </div>
        </form>
    </div>
    <br>
</div>
<?php include FOOTER_TEMPLATE; ?>