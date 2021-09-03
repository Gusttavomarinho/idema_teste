<div class="content-wrapper h-100">
  <div class="container">
    <div class="card">
      <div class="card-header">
        <h3>Lista de Processos do usuario: <span class="text-primary"><?= $_SESSION['global_user_info']['username'] ?></span></h3>
      </div>
      <div class="card-body">
        <!--conteudo-->
        <table class="table" id="myTable-processos">
          <thead>
            <tr>
              <th scope="col">Ação</th>
              <th scope="col">Codigo</th>
              <th scope="col">Data</th>
              <th scope="col">Usuario</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($processos as $key => $processo) : ?>
              <tr>
                <th scope="row"><button class="btn btn-info">Adicionar a Solicitação</button></th>
                <th scope="row"><?= $processo['id'] ?></th>
                <td><?= $processo['create_at'] ?></td>
                <td><?= $processo['users_id'] == $_SESSION['global_user_info']['id'] ?  $_SESSION['global_user_info']['username']  : ' Usuario Invalido'  ?></td>
              </tr>
            <?php endforeach ?>
          </tbody>
        </table>
        <!--end conteudo-->
      </div>
    </div>
  </div>
</div>