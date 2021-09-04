<div class="content-wrapper h-100">
  <div class="container-fluid">
    <div class="card">
      <div class="card-header">
        <h3>Central de Atendimento </h3>
        <h3>Lista de solicitações pendentes</h3>
      </div>
      <div class="card-body">
        <!-- feedback para o usuario -->
        <?= isset($_SESSION['semnet']) ? $_SESSION['semnet'] : '' ?>
        <?php unset($_SESSION['semnet']) ?>
        <!--conteudo-->
        <table class="table" id="myTable-solicitacoes-pendentes">
          <thead>
            <tr>
              <th scope="col">Codigo</th>
              <th scope="col">Nome</th>
              <th scope="col">Email</th>
              <th scope="col">Data de Solicitação</th>
              <th scope="col"></th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($solicitacoes as $key => $solicitacao) : ?>
              <tr>

                <th scope="row"><?= $solicitacao['id'] ?></th>
                <td><?= $solicitacao['nome_usuario'] ?></td>
                <td><?= $solicitacao['email_usuario'] ?></td>
                <td><?= $solicitacao['data'] ?></td>
                <td>
                  <div class="btn-group">
                    <a href="<?= BASE_URL ?>solicitacao/verprocessos/?id=<?= $solicitacao['id'] ?>" class="btn btn-warning">Ver Processos</a>
                    <a href="<?= BASE_URL ?>solicitacao/validar/?id=<?= $solicitacao['id'] ?>" class="btn btn-primary">Validar</a>
                  </div>
                </td>
              </tr>
            <?php endforeach ?>
          </tbody>
        </table>
        <hr>
        <h2>Ultimas Solicitações Analisadas</h2>
        <hr>
        <table class="table" id="myTable-solicitacoes-pendentes">
          <thead>
            <tr>
              <th scope="col">Codigo</th>
              <th scope="col">Nome</th>
              <th scope="col">Data de Solicitação</th>
              <th scope="col">Ação</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($solicitaoes_ultimas as $key => $solicitacao) : ?>
              <tr>

                <th scope="row"><?= $solicitacao['id'] ?></th>
                <td><?= $solicitacao['nome_usuario'] ?></td>
                <td><?= $solicitacao['data'] ?></td>
                <td><a href="<?= BASE_URL ?>solicitacao/versolicitacao/?id=<?= $solicitacao['id'] ?>" class="btn btn-info">Abrir</a></td>
              </tr>
            <?php endforeach ?>
          </tbody>
        </table>

        <!--end conteudo-->
      </div>
    </div>
  </div>
</div>