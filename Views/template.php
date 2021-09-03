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

    <!-- Footer -->
    <?php $this->loadViewInTemplate('footer', $viewData); ?>
    <!-- Footer -->
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

  <script>
    var baseUrl = '<?= BASE_URL ?>';
  </script>
</body>

</html>
}
?>