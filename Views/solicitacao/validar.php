<div class="content-wrapper h-100">
  <div class="container-fluid">
    <div class="card">
      <div class="card-header">
        <h3>Solicitação</h3>
        <div class="" id="modal_loadin">
        </div>
      </div>
      <div class="card-body">
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
        <p><span class="text-bold">Usuario que aprovou ou rejeitou: </span><?= $solicitacao['user_id_aprovacao'] ?></p>
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
        <h3>Ação</h3>
        <br />
        <form name="form_status_solicitacao" method="POST" action="" id="form_status_solicitacao">
          <input type="hidden" name="usuario_email" value="<?= $solicitacao['email_usuario'] ?>">
          <input type="hidden" name="solicitao_id" value="<?= $solicitacao['id'] ?>">
          <div class="form-group">
            <label for="select_status">Status:</label>
            <select class="form-control" id="select_status" name="select_status">
              <option value="1">APROVADO</option>
              <option value="2">REJEITADA</option>
            </select>
            <label for="motivo">Motivo:</label>
            <textarea class="form-control" id="motivo" rows="3"></textarea><br />
            <input type="submit" class="btn btn-dark" value="Alterar Status" name="alterarstatus">
          </div>
        </form>
        <!--end conteudo-->
      </div>
    </div>
  </div>
</div>