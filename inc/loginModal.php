<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered custom-modal-size modal-with-background" >
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-center-title" id="loginModalLabel">Entrar</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="meuModal">
        <!-- Coloque aqui o formulário de login existente no seu código -->
        <form action="<?php echo BASEURL; ?>inc/login.php" method="post" >
                <br>
                <div class="mb-2 row">
                    <label class="col-3 col-form-label text-start">Email</label>
                    <div class="col-9">
                      <input type="email" class="form-control" name="email" required>
                    </div>
                  </div>
                  <div class="mb-2 row">
                    <label class="col-3 col-form-label text-start">Senha</label>
                    <div class="col-9">
                      <input type="password" class="form-control" name="senha" required>
                    </div>
                  </div>
                  <br>
                  <div class="row mb-3">
                    <div class="col-6">
                      <a class="h6" href="#">Esqueci minha Senha</a>
                    </div>
                    <div class="col-6 text-end">
                      <a class="h6" href="<?php echo BASEURL; ?>clientes/cadastrar.php">Não possuo cadastro</a>
                    </div>
                  </div>
                
              </div>
              <div class="modal-footer d-flex justify-content-center">
                <button type="submit" class="btn button1">Entrar</button>
                <button type="button" class="btn button2" data-bs-dismiss="modal">Fechar</button>
        </form>
      </div>
    </div>
  </div>
</div>
