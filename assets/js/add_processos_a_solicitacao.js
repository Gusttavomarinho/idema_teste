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
