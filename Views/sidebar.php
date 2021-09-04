<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="<?= BASE_URL; ?>" class="brand-link">
    <i class="fas fa-cubes brand-image img-circle elevation-3" alt="AdminLTE Logo" style="opacity: .8"></i>
    <span class="brand-text font-weight-light">Idema Processos</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <i class="fas fa-user img-circle elevation-2" alt="User Image"></i>
      </div>
      <div class="info">
        <a href="<?= BASE_URL; ?>" class="d-block">
          <?= isset($_SESSION['global_user_info']) ? $_SESSION['global_user_info']['username'] : 'Usuario Não Logado'  ?></a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
          <a href="<?= BASE_URL ?>processo" class="nav-link">
            <i class="fas fa-list"></i>
            <p>
              Listar Processos
            </p>
          </a>
        </li>
        <?php if ($_SESSION['global_user_info']['perfil'] == 1) : ?>
          <li class="nav-item">
            <a href="<?= BASE_URL ?>solicitacao" class="nav-link">
              <i class="fas fa-link"></i>
              <p>
                Solicitações Pendentes
              </p>
            </a>
          </li>
        <?php endif ?>
        <li class="nav-item">
          <a href="<?= BASE_URL ?>home/sair" class="nav-link">
            <i class="fas fa-sign-out-alt nav-icon"></i>
            <p>Sair</p>
          </a>
        </li>
        </li>
      </ul>
    </nav>
  </div>
  <!-- /.sidebar -->
</aside>