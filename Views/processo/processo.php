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
                <th scope="row"><button class="btn btn-info btn-add-p-solicitacao" value="<?= $processo['id'] ?>">Adicionar a Solicitação</button></th>
                <th scope="row"><?= $processo['id'] ?></th>
                <td><?= $processo['create_at'] ?></td>
                <td><?= $processo['users_id'] == $_SESSION['global_user_info']['id'] ?  $_SESSION['global_user_info']['username']  : ' Usuario Invalido'  ?></td>
              </tr>
            <?php endforeach ?>
          </tbody>
        </table>
        <!--inicio do form -->
        <hr>
        <h3>Cadastrar Solicitações</h3>
        <hr>
        <form action="">
          <div id="">
            <div class="form-group">
              <label for="nome">Nome</label>
              <input type="text" placeholder="digite seu nome" name="nome" id="nome" required>
            </div>
            <div class="form-group">
              <label for="email">Email</label>
              <input type="email" placeholder="digite seu email" name="email" id="email" required>
            </div>
            <div class="form-group" id="checkboxs">
              <p id="msg_form_add_processos" class="text-danger">Adicione Processos a Solicitação</p>
            </div>
            <input type="submit" value="enviar" class="btn btn-success" id="btn_cad_solicitacao">
        </form>
        <!--end conteudo-->
      </div>
    </div>
  </div>
</div>