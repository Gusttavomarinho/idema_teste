<div class="content-wrapper h-100">
  <div class="container-fluid">
    <div class="card">
      <div class="card-header">
        <h3>Central de Atendimento </h3>
        <h2>Lista de processos da solicitação codigo : <?= $id_solicitacao ?></h2>
      </div>
      <div class="card-body">
        <a href="<?= BASE_URL ?>solicitacao" class="btn btn-warning">Voltar</a>
        <hr>
        <table class="table" id="Mytable-processos_da_solicitacao">
          <thead>
            <tr>
              <th scope="col">Codigo do Processo</th>
              <th scope="col">Data</th>
              <th scope="col">Usuario</th>
              <th scope="col">Documentos</th>
            </tr>
          </thead>
          <?php foreach ($processos as $key => $processo) : ?>
            <tbody>
              <tr>
                <th scope="row"><?= $processo['id'] ?></th>
                <td><?= $processo['create_at'] ?></td>
                <td><?= $processo['users_id'] ?></td>
                <td>
                  <?php foreach ($processo['documentos_do_processo'] as $key => $documento) : ?>
                    <?php foreach ($documento as $key => $documentofinal) : ?>
                      <div class="card card-primary">
                        <div class="card-header">
                          <div class="card-title">
                            <p>Documento ID:<?= $documentofinal['id'] ?></p>
                          </div>
                        </div>
                        <div class="card-body">
                          <p>Data:<?= $documentofinal['create_at'] ?></p>
                          <p>Corpo do Documento:<?= $documentofinal['documento'] ?></p>
                        </div>
                      </div>
                    <?php endforeach ?>
                  <?php endforeach ?>
              </tr>
            </tbody>
          <?php endforeach ?>
        </table>

      </div>
    </div>
  </div>
</div>