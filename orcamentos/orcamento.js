
function ReadOnlyData() {
    var divData = document.getElementById("divDataEntrega");
    var selectElement = document.getElementById("pag");
    var dataInput = document.getElementById("data");

    var divMaster = document.getElementById("DivMaster");
    var inputServico = document.getElementById("inputServico");
    var inputMaterial = document.getElementById("inputMaterial");
    var inputImagem  = document.getElementById("inputImagem");
    var inputFormapag  = document.getElementById("pagamento");
    var inputValor = document.getElementById("inputValor");
    var inputNParcelas  = document.getElementById("Nparcelas");

    if (selectElement.value === "s") {
        dataInput.removeAttribute('disabled');
        dataInput.removeAttribute("required");
        divMaster.style.display = "none";
        divData.style.display = "block";
        inputServico.setAttribute('disabled','true');
        inputMaterial.setAttribute('disabled','true');
        inputImagem.setAttribute('disabled','true');
        inputFormapag.setAttribute('disabled','true');
        inputValor.setAttribute('disabled','true');
        inputNParcelas.setAttribute('disabled','true');
    } else {
        dataInput.setAttribute("required", "required");
        dataInput.setAttribute('disabled','true');
        divMaster.style.display = "block";
        divData.style.display = "none";
        inputServico.removeAttribute('disabled');
        inputMaterial.removeAttribute('disabled');
        inputImagem.removeAttribute('disabled');
        inputFormapag.removeAttribute('disabled');
        inputValor.removeAttribute('disabled');
        inputNParcelas.removeAttribute('disabled');
    }

}

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

function previewImagem(event) {
    var input = event.target;
    if (input.files && input.files[0]) {
      var leitor = new FileReader();

      leitor.onload = function (e) {
        document.getElementById('imagemPreview').src = e.target.result;
      };

      leitor.readAsDataURL(input.files[0]);
    }
  }