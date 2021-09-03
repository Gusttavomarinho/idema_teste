<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Cadastro</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/adminlte.min.css">
</head>

<body class="hold-transition login-page">
  <div class="login-box">
    <div class="container">
      <div class="card card-outline card-primary">
        <div class="card-header text-center">
          <img src="img/small_suinin_logo.png" alt="" srcset="">
          <span class="h1"><b>Cadastre-se</b></span>
        </div>
        <div class="card-body">
          <form action="<?= BASE_URL ?>login/signup" method="POST">
            <div class="input-group mb-3">
              <input type="text" class="form-control" name="username" placeholder="Usuario" value="<?= isset($_POST['username']) ? $_POST['username'] : ''; ?>">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-envelope"></span>
                </div>
              </div>
            </div>
            <div class="input-group mb-3">
              <input type="password" class="form-control" name="pass" placeholder="Senha" value="<?= isset($_POST['pass']) ? $_POST['pass'] : ''; ?>">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-lock"></span>
                </div>
              </div>
            </div>
            <div class="input-group mb-3">
              <input type="password" class="form-control" name="pass_confirm" placeholder="Confirmar Senha" value="<?= isset($_POST['pass_confirm']) ? $_POST['pass_confirm'] : ''; ?>">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-lock"></span>
                </div>
              </div>
            </div>
            <div class="form-group">
              <button type="submit" class="btn btn-primary btn-block" name="btn-acessar">Cadastrar</button>
            </div>
          </form>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="<?= BASE_URL ?>assets/js/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="<?= BASE_URL ?>assets/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?= BASE_URL ?>assets/js/adminlte.min.js"></script>
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
          case 'senhas-diferentes':
            Toast.fire({
              title: 'As senhas precisam ser iguais!',
              icon: 'warning'
            })
            break;
          case 'usuario-existente':
            Toast.fire({
              title: 'Usuário já cadastrado!',
              icon: 'error'
            })
            break;
          case 'usuario-invalido':
            Toast.fire({
              title: 'Usuário inválido!',
              text: 'Digite apenas letras e números',
              icon: 'error'
            })
            break;
          case 'obrigatorios':
            Toast.fire({
              title: 'Todos os campos devem ser preenchidos!',
              icon: 'warning'
            })
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