<?php
include "funcoes.php";
include HEADER_TEMPLATE;
$vDates = produtos();
$vCol = 0;
?>
<br>
<div class="container mt-4">

<div class="boxtitulo text-center">
    <h2>Balcões</h2>
    
</div>

    <div class="row">
        <?php if(!is_null($vDates)):?>
            <?php foreach ($vDates as $vKey): ?>
                <?php if ($vCol % 3 == 0): ?>
                    </div><div class="row"> <!-- Fecha a linha anterior e começa uma nova linha a cada 3 colunas -->
                <?php endif; ?>
                <div class="col-lg-4 col-md-6 mb-4">
                <section class="articles">
                <br>
            <article>
                <div class="article-wrapper">
                <figure>
                    <img src="<?php echo IMAGEM . $vKey['foto_produto']; ?>" alt="Imagem" onclick="abrirImagem(this)">
                </figure>
                
                    
                    <?php if (check_login() && check_admin()): ?>
                        <div class="article-body">
                        <h2 class="text-center"><?php echo $vKey['nome_produto']; ?></h2>
                        <a href='../produtos/edit.php?i=<?php echo base64_encode($vKey['id_produto']); ?>' class="read-more">Editar
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </a>
                        </div>
                    <?php endif; ?>
                
                </div>
            </article>
            
        </section>
                </div>
                <?php $vCol++; ?>
                <?php if ($vCol == 3): ?>
                    <div class="boxtitulo text-center">
                        <h2>Banheiro</h2>
                    </div>
                <?php endif; ?>
                <?php if ($vCol == 6): ?>
                    <div class="boxtitulo text-center">
                        <h2>Outros produtos</h2>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        <?php else: ?>
            <h3>Nenhum Trabalho.</h3>
        <?php endif; ?>
    </div>
</div>

<style>
    .modal {
      display: none;
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.7);
      justify-content: center;
      align-items: center;
    }

    .modal-content {
      max-width: 100%;
      max-height: 100%;
    }
  </style>

<div id="myModal" class="modal" onclick="fecharImagem()">
  <img src="" alt="Imagem Ampliada" class="modal-content">
</div>

<script>
  function abrirImagem(imagemClicada) {
    var modal = document.getElementById("myModal");
    var modalImg = document.querySelector(".modal-content");

    modal.style.display = "flex";
    modalImg.src = imagemClicada.src;
  }

  function fecharImagem() {
    var modal = document.getElementById("myModal");
    modal.style.display = "none";
  }
</script>

<?php include FOOTER_TEMPLATE; ?>

