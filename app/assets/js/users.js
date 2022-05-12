
//Valida os campos do cadastrar
$(document).ready(function (){

  $('#valida_cadastrar').on("submit", function() {

    usuario = document.forms[0].email.value.substring(0, document.forms[0].email.value.indexOf('@'));
    dominio = document.forms[0].email.value.substring(document.forms[0].email.value.indexOf('@') + 1, document.forms[0].email.value.length);

    if ($('#nome').val() === "") {
      $(".msg").html("<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo Nome!</div>");
      return false;
    } else if (
      $('#email').val() === "" || 
      usuario.length <= 3 ||
      dominio.length <= 5 || 
      document.forms[0].email.value.indexOf('@')==-1 || 
      document.forms[0].email.value.indexOf('.')==-1
    ) {
      $(".msg").html("<div class='alert alert-danger' role='alert'>Erro: E-mail Inválido! Favor preencher corretamente!</div>");
      return false;
    } else if (
      $('#telefone').val() === "" || 
      $('#telefone').val().length < 10
    ) {
      $(".msg").html("<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo Telefone!</div>");
      return false;
    } else if (
      $('#cpf').val() === "" || 
      validarCPF($('#cpf').val()) === false
    ) {
      $(".msg").html("<div class='alert alert-danger' role='alert'>Erro: CPF Inválido! Favor preencher corretamente!</div>");
      return false;
    }
  });
});

$(document).ready(function(){
  $('#valida_editar').on('submit', function(event){

    val_email = $('#emailModal').val();
    usuarioModal = val_email.substring(0, val_email.indexOf('@'))
    dominioModal = val_email.substring(val_email.indexOf('@') + 1, val_email.length);

    if($('#nomeModal').val() === ""){
      //Alerta de campo nome vazio
      $(".msg-error").html('<div class="alert alert-danger" role="alert">Necessário prencher o campo nome!</div>');
      return false;
    } else if(
      $('#emailModal').val() === "" || 
      usuarioModal.length <= 3 ||
      dominioModal.length <= 5 || 
      val_email.indexOf('@') == -1 || 
      val_email.indexOf('.') == -1
    ){
      //Alerta de campo email vazio
      $(".msg-error").html('<div class="alert alert-danger" role="alert">Erro: E-mail Inválido! Favor preencher corretamente!</div>');
      return false;
    } else if (
      $('#foneModal').val() === "" 
    ){
      $(".msg-error").html("<div class='alert alert-danger' role='alert'>Erro: Necessário prencher o campo Telefone!</div>");
      return false;
    } else if (
      $('#cpfModal').val() === "" || 
      validarCPF($('#cpfModal').val()) === false
    ) {
      console.log("CPF: " + $('#cpfModal').val())
      $(".msg-error").html("<div class='alert alert-danger' role='alert'>Erro: CPF Inválido! Favor preencher corretamente!</div>");
      return false;
    }


  });
});
//Carregar modal apagar
$(document).ready(function () {
  $('a[data-confirm]').click(function () {
      var href = $(this).attr('href');

      if (!$('#confirm-delete').length) {
          $('body').append('<div class="modal fade" id="confirm-delete" tabindex="-1" aria-labelledby="confirm-deleteLabel" aria-hidden="true"><div class="modal-dialog"><div class="modal-content"><div class="modal-header bg-danger"><h5 class="modal-title text-white" id="deleteDataLabel">EXCLUIR REGISTRO</h5><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></div><div class="modal-body">Tem certeza que deseja excluir o registro selecionado?</div><div class="modal-footer"><button type="button" class="btn btn-outline-success" data-dismiss="modal">Cancelar</button><a class="btn btn-outline-danger" id="dataComfirmOk">Apagar</a></div></div></div></div>');
      }

      $('#dataComfirmOk').attr('href', href);
      $('#confirm-delete').modal({show: true});
      return false;
  });

});

function validarCPF(cpf) {	
	cpf = cpf.replace(/[^\d]+/g,'');	
	if(cpf == '') return false;	
	// Elimina CPFs invalidos conhecidos	
	if (cpf.length != 11 || 
		cpf == "00000000000" || 
		cpf == "11111111111" || 
		cpf == "22222222222" || 
		cpf == "33333333333" || 
		cpf == "44444444444" || 
		cpf == "55555555555" || 
		cpf == "66666666666" || 
		cpf == "77777777777" || 
		cpf == "88888888888" || 
		cpf == "99999999999")
			return false;		
	// Valida 1o digito	
	add = 0;	
	for (i=0; i < 9; i ++)		
		add += parseInt(cpf.charAt(i)) * (10 - i);	
		rev = 11 - (add % 11);	
		if (rev == 10 || rev == 11)		
			rev = 0;	
		if (rev != parseInt(cpf.charAt(9)))		
			return false;		
	// Valida 2o digito	
	add = 0;	
	for (i = 0; i < 10; i ++)		
		add += parseInt(cpf.charAt(i)) * (11 - i);	
	rev = 11 - (add % 11);	
	if (rev == 10 || rev == 11)	
		rev = 0;	
	if (rev != parseInt(cpf.charAt(10)))
		return false;		
	return true;   
}