$('#img_file').on('change', function(){
    $('#img_file').css('display', 'none');
});

$('#file-upload').on('change', function(){
  $('.custom-file-upload').css('display', 'none');
  $('.files-full-upload').css('display', 'block');
});



var loadFile = function(event) {
  var output = document.getElementById('output');
  output.src = URL.createObjectURL(event.target.files[0]);
};

function carregamento() {
  document.getElementById('loader').style.display = 'block';
  document.getElementById('body-form').style.display = 'none';
  document.getElementById('titulo_va').style.display = 'none';
  document.getElementById('cx-header').style.display = 'none';
}