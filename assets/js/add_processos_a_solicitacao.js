$('.btn-add-p-solicitacao').click(function () {
  var id_processo = $(this).val();
  var text = 'Processo de codigo:' + id_processo;

  //remover a mensagem para add processos na solicitação
  if (!$('#msg_form_add_processos').hasClass('d-none')) {
    $('#msg_form_add_processos').addClass('d-none');
  }
  //=======================================================

  //add checkboxs a cada clique no adicionar solicitação
  $('#checkboxs').append(
    '<input type="checkbox" value="' +
      id_processo +
      '" checked name="processos[]"/> ' +
      text +
      '<br />'
  );
  //=========================================================
});

//script do select2
$(document).ready(function () {
  $('.js-processos-multiple').select2();
  console.log('testou select2');
});
////=========================================================

//fazer  o submit do form de solicitações
$('#form-solicitacao').on('submit', function (event) {
  event.preventDefault();
  const nome = $('input[name="nome"]').val();
  const email = $('input[name="email"]').val();
  const processos = $('#select2_processos').val();
  const url = baseUrl + 'solicitacao/criar';
  console.log('nome:' + nome);
  console.log('email:' + email);
  console.log('processos:' + processos);
  console.log('url:' + url);
  $.ajax({
    url: url, // caminho para o script que vai processar os dados
    type: 'POST',
    data: {
      nome: nome,
      email: email,
      processos: processos,
    },
    success: function (response) {
      //passar retorno para o usuario
      //$('#retorno-form-solicitacao').html(response);
      Swal.fire('Solicitação', 'Cadastrada com sucesso!', 'success');
      //===========================================
      //limpar inputs
      $('input[name="nome"]').val('');
      $('input[name="email"]').val('');
      $('#select2_processos').val('');
      //========================================
      console.log(response);
    },
    error: function (xhr, status, error) {
      Swal.fire('Error!', error, 'warning');
      console.log('aconteceu algum error!  ' + error);
      alert(xhr.responseText);
    },
  });
  return false;
});

//fazer  o submit do form de validar ou rejeitar solicitacoes
$('#form_status_solicitacao').on('submit', function (event) {
  //colocar o loading
  $('#modal_loadin').addClass('modal_loadin');
  //===================================================
  event.preventDefault();
  const email_usuario = $('input[name="usuario_email"]').val();
  //console.log('email_usuario:' + email_usuario);
  const solicitacao_id = $('input[name="solicitao_id"]').val();
  //console.log('solicitacao_id:' + solicitacao_id);
  const select_status = $('#select_status').val();
  //console.log('select_status:' + select_status);
  const motivo = $('#motivo').val();
  //console.log('motivo:' + motivo);
  const url = baseUrl + 'solicitacao/validar_action';
  const url_redirect = baseUrl + 'solicitacao/?msg=togglestatus';
  $.ajax({
    url: url, // caminho para o script que vai processar os dados
    type: 'POST',
    data: {
      email_usuario: email_usuario,
      solicitacao_id: solicitacao_id,
      select_status: select_status,
      motivo: motivo,
    },
    success: function (response) {
      //passar retorno para o usuario
      //$('#retorno-form-solicitacao').html(response);
      window.location.replace(url_redirect);
      Swal.fire('Solicitação', 'Status Alterado!', 'success');
      //===========================================
      console.log(response);
    },
    error: function (xhr, status, error) {
      Swal.fire('Error!', error, 'warning');
      console.log('aconteceu algum error!  ' + error);
      alert(xhr.responseText);
    },
  });
  return false;
});
