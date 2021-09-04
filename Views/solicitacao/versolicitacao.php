<div class="content-wrapper h-100">
  <div class="container-fluid">
    <div class="card">
      <div class="card-header">
        <h3>Solicitação</h3>
      </div>
      <div class="card-body">
        <a href="<?= BASE_URL ?>solicitacao" class="btn btn-warning">Voltar</a>
        <hr>
        <!--conteudo-->
        <h2>Codigo: <?= $solicitacao['id'] ?></h2>
        <p><span class="text-bold">Data: </span><?= $solicitacao['data'] ?></p>
        <hr>
        <p><span class="text-bold">Nome do Solicitante: </span><?= $solicitacao['nome_usuario'] ?></p>
        <p><span class="text-bold">Email: </span><?= $solicitacao['email_usuario'] ?></p>
        <p><span class="text-bold">Username: </span><?= $user_solicitante ?></p>
        <hr>
        <h2>Dados Status da solicitação</h2>
        <p><span class="text-bold">Data da aprovação: </span><?= $solicitacao['data_aprovacao'] ?></p>
        <p><span class="text-bold">Usuario que aprovou ou rejeitou: </span><?= $username_aprovacao ?></p>
        <p><span class="text-bold">Status:</span>
          <?php if ($solicitacao['status_aprovacao'] == 0) : ?>
            <span class="badge badge-warning">PENDENTE</span>
          <?php elseif ($solicitacao['status_aprovacao'] == 1) : ?>
            <span class="badge badge-success">APROVADO</span>
          <?php elseif ($solicitacao['status_aprovacao'] == 2) : ?>
            <span class="badge badge-danger">REJEITADA</span>
          <?php else : ?>
            <span class="badge badge-dark">STATUS INVALIDO</span>
          <?php endif ?>
        </p>
        <hr>
        <!--end conteudo-->
      </div>
    </div>
  </div>
</div>