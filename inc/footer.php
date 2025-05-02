  	</main>
  <br>
	<footer class="footer">  <!-- criei uma classe no css para formatar o footer-->
	<div class="">
  
      <div class="row my-4">
   
        <div class="col-lg-4 col-md-6 mb-4 mb-md-0">

          <div class="rounded-circle shadow-1-strong d-flex align-items-center justify-content-center mb-4 mx-auto" style="width: 150px; height: 150px;">  <!-- Define o tamanho e a forma do quadro da imagem-->
            <img src="<?php echo BASEURL;?>/inc/logofooter.jpg" height="150" alt="">  <!-- Adiciona a logo no footer-->
          </div>

          <p class="text-center"></p>

          <ul class="list-unstyled d-flex flex-row justify-content-center">
            <li>
              <a href="https://wa.me/5515997285951?text=Oi,%20estou%20entrando%20em%20contato%20através%20do%20site.%20Gostaria%20de%20fazer%20uma%20encomenda%20por%20favor" class="float" target="_blank">
                <i class="fab fa-whatsapp my-float"></i>
              </a>
            </li>
            <li>
            <a class="text-white px-2" href="https://www.instagram.com/chiovetto_/" target="_blank">
                <i class="fab fa-instagram"></i>  <!-- Quando o cliente clicar, será enviado para o instagram do senhor chiovetto-->
              </a>
            </li>
          </ul>

        </div>

        <div class="col-lg-4 col-md-6 mb-4 mb-md-0"> <!-- esta div inteira se trata dos links colocados na parte de suporte do footer-->
          <h5 class="text-uppercase mb-4">Suporte</h5>

          <ul class="list-unstyled">


            <li class="mb-2">
              <a href="<?php echo BASEURL; ?>inc/Política de Privacidade.pdf" class="text-white">Política de privacidade</a>
            </li>
          </ul>
        </div>
 
        
        <div class="col-lg-4 col-md-6 mb-4 mb-md-0"> <!-- esta div inteira se trata dos links colocados na parte de contatos do footer (preciso de ideias de maneiras de contato inclusive kkkk)-->
          <h5 class="text-uppercase mb-4">Contatos</h5>

          <ul class="list-unstyled">
            <li>
              <p><i class="fas fa-phone pe-2"></i>+55 (15) 99728 5951</p>
            </li>
            <li>
              <p><i class="fas fa-envelope pe-2 mb-"></i>Veraluciasantosdelima88@gmail.com</p>
            </li>
          </ul>
        </div>
   
      </div>
  
    </div>

    <!-- Copyright -->
    <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2)">
      © 2023 Copyright:
      <a class="text-white" href="https://mdbootstrap.com/">MarmorariaChiovetto.com</a>
    </div>
    <!-- Copyright -->
<!-- fim do .container -->
	</footer>
</body>

 <script src="<?php echo BASEURL; ?>js/jquery-3.6.0.min.js"></script>
 <script src="<?php echo BASEURL; ?>js/popper.min.js"></script>
 <script src="<?php echo BASEURL;?>js/bootstrap/bootstrap.min.js"></script> 
 <script src="<?php echo BASEURL;?>js/fontawesome/all.min.js"></script>

</html>
<?php 
include 'loginModal.php';
?>
