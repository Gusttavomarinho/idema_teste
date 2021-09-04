<!DOCTYPE html>
<html lang="pt-br">

<?php $this->loadViewInTemplate('head', $viewData); ?>

<body class="hold-transition sidebar-mini layout-fixed" data-panel-auto-height-mode="height">
  <div class="wrapper">
    <!-- Navbar -->
    <?php $this->loadViewInTemplate('navbar', $viewData); ?>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <?php $this->loadViewInTemplate('sidebar', $viewData); ?>
    <!--END Main Sidebar Container -->

    <?php $this->loadViewInTemplate($viewName, $viewData); ?>


  </div>
  <!-- ./wrapper -->

  <!-- jQuery -->
  <script src="<?= BASE_URL ?>assets/js/jquery.min.js"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script src="<?= BASE_URL ?>assets/js/jquery-ui.min.js"></script>
  <script>
    $.widget.bridge('uibutton', $.ui.button)
  </script>
  <!-- Bootstrap 4 -->
  <script src="<?= BASE_URL ?>assets/js/bootstrap.min.js"></script>
  <script src="<?= BASE_URL ?>assets/js/popper.min.js"></script>
  <script src="<?= BASE_URL ?>assets/js/jquery.overlayScrollbars.min.js"></script>
  <!-- AdminLTE App -->
  <script src="<?= BASE_URL ?>assets/js/adminlte.min.js"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  <script src="<?= BASE_URL ?>assets/js/script.js"></script>
  <script src="<?= BASE_URL ?>assets/js/jquery.dataTables.min.js"></script>
  <script src="<?= BASE_URL ?>assets/js/toastr.min.js"></script>
  <script src="<?= BASE_URL ?>assets/js/chosen.jquery.js"></script>
  <script src="<?= BASE_URL ?>assets/js/add_processos_a_solicitacao.js"></script>
  <!-- select2 -->
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

  <script>
    var baseUrl = '<?= BASE_URL ?>';
    //criar os datatabless
    $(document).ready(function() {
      $('#myTable-processos').DataTable();
    });
    $(document).ready(function() {
      $('#myTable-solicitacoes-pendentes').DataTable();
    });

    $(document).ready(function() {
      $('#Mytable-processos_da_solicitacao').DataTable();
    });
  </script>
</body>

</html>
}
?>