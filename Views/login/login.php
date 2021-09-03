<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Tela de Login</title>
  <link rel="shortcut icon" href="<?= BASE_URL ?>assets/imagens/icons/small_suinin_logo.png" type="image/x-icon">

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="assets/css/adminlte.min.css">
</head>

<body class="hold-transition login-page">
  <div class="login-box">
    <!-- /.login-logo -->
    <div class="text-center">
      <img class="mb-4" src="https://img2.gratispng.com/20180724/vbc/kisspng-test-case-logo-software-testing-engineering-use-ca-5b57f03d5612b1.1497376915324897893526.jpg" alt="" width="72" height="72">
    </div>
    <div class="card card-outline card-primary">
      <div class="card-header text-center">
        <span style="color:#0D7BFF;"><b>Sistema </b>de autenticação</span>
      </div>
      <div class="card-body">
        <form action="<?= BASE_URL ?>login/signin" method="POST">
          <div class="input-group mb-3">
            <input type="text" class="form-control" name="username" placeholder="Usuário">
            <div class="input-group-append">
              <div class="input-group-text">
                <i class="fas fa-user"></i>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" class="form-control" name="pass" placeholder="Senha">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <button type="submit" class="btn btn-primary btn-block">
            <i class="fas fa-sign-in-alt mr-1"></i>
            Acessar</button>
          <?php if (!empty($msg)) : ?>
            <div class="warning">
              <?= $msg ?>
            </div>
          <?php endif; ?>
        </form>
        <div class="mt-3">
          <span>Não tem acesso?<a href="<?= BASE_URL ?>login/signup"> Cadastre-se</a>
        </div>
      </div>
    </div>
  </div>
  <div class="d-flex justify-content-around">
    <img class="mb-4 mt-4 mr-5" src="https://img2.gratispng.com/20180724/vbc/kisspng-test-case-logo-software-testing-engineering-use-ca-5b57f03d5612b1.1497376915324897893526.jpg" alt="" height="50" width="50">

    <img class="mb-4 mt-2 ml-5" height="80" width="80" src="https://img2.gratispng.com/20180724/vbc/kisspng-test-case-logo-software-testing-engineering-use-ca-5b57f03d5612b1.1497376915324897893526.jpg" alt="">
  </div>


  <!-- jQuery -->
  <script src="assets/js/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="assets/js/bootstrap.min.js"></script>
  <!-- AdminLTE App -->
  <script src="assets/js/adminlte.min.js"></script>
  <!-- SweetAlert -->
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
    const baseUrl = '<?= BASE_URL ?>';
    const primaryColor = '#007BFF';

    /** Toaster do SweetAlert2 */
    const Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: true,
      confirmButtonColor: primaryColor,
      timer: 2000,
      timerProgressBar: true,
      didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
      }
    })

    $(document).ready(function() {
      var sessionMsg = '<?= $_SESSION['msg'] ?>';
      <?php $_SESSION['msg'] = '' ?>;
      exibirToast(sessionMsg);
    });

    function exibirToast(tipo) {
      switch (tipo) {
        case 'usuario-criado':
          Toast.fire({
            title: 'Usuário criado com sucesso!',
            text: 'Contate um administrador do sistema para ativar seu acesso.',
            icon: 'success'
          })
          break;
        case 'usuario-inativo':
          Toast.fire({
            title: 'Usuário inativo!',
            text: 'Contate um administrador do sistema',
            icon: 'error'
          })
          break;
        case 'usuario-inexistente':
          Toast.fire({
            title: 'Usuário não cadastrado!',
            icon: 'error'
          })
          break;
        case 'usuario-logado':
          Toast.fire({
            title: 'Usuário logado com sucesso!',
            icon: 'success'
          })
          break;
        case 'usuario-deslogado':
          Toast.fire({
            title: 'Usuário deslogado com sucesso!',
            icon: 'success'
          })
          break;
        case 'usuario-senha-erro':
          Toast.fire({
            title: 'Senha errada!',
            icon: 'error'
          })
          break;
        case 'sem-username':
          Toast.fire({
            title: "Favor informar um nome de usuário!",
            icon: "warning"
          });
          break;
        case 'sem-senha':
          Toast.fire({
            title: "Favor informar uma senha!",
            icon: "warning"
          });
          break;
        case 'erro':
          Toast.fire({
            title: "Algo deu errado!",
            icon: "error"
          });
          break;
        default:
          break;
      }
    };
  </script>
</body>

</html>