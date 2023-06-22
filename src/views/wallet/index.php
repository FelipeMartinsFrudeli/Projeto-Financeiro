
<div class="nav-bar">
  <h1>Projeto Financeiro</h1>
</div>

<div class="top">
  <h1>Painel de gastos e ganhos. Total: <?php echo $account->amount; ?></h1>
  <span>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
    Depositar
    </button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Depositar</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <form action="/deposit" method="post">
        <div class="modal-body">
            <div class="mb-3">
              <label for="d_valor" class="form-label">Valor do deposito</label>
              <input type="text" class="form-control" name="amount" id="d_valor">
            </div>
            <div class="mb-3">
              <label for="d_titulo" class="form-label">Titulo</label>
              <input type="text" class="form-control" name="title" id="d_titulo">
            </div>
            <div class="mb-3">
              <label for="d_descricao" class="form-label">Descricao</label>
              <input type="text" class="form-control" name="t_description" id="d_descricao">
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
          <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Depositar</button>
        </div>
      </form>
    </div>
  </div>
</div>

<button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal2">
Retirar
</button>

<div class="modal fade" id="exampleModal2" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Retirar</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <form action="/withdraw" method="post">
        <div class="modal-body">

          <div class="mb-3">
            <label for="r_valor" class="form-label">Valor do deposito</label>
            <input type="text" class="form-control" name="amount" id="r_valor">
          </div>
          <div class="mb-3">
            <label for="r_titulo" class="form-label">Titulo</label>
            <input type="text" class="form-control" name="title" id="r_titulo">
          </div>
          <div class="mb-3">
            <label for="r_descricao" class="form-label">Descricao</label>
            <input type="text" class="form-control" name="t_description" id="r_descricao">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
          <button type="submit" class="btn btn-danger" data-bs-dismiss="modal">Retirar</button>
        </div>
      </form>
    </div>
  </div>
</div>

      </span>
    </div>

  <table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Transação</th>
        <th scope="col">Data</th>
        <th scope="col">Nome</th>
        <th scope="col">Valor</th>
        <th scope="col">Descrição</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($transactions as $i => $transaction): ?>
        <tr>
          <th scope="row"><?php echo $i + 1 ?></th>
          <td><?php 
            if ($transaction->t_type == 'Withdraw') {
              echo "Saque";
            } else {
              echo "Deposito";
            }
          ?></td>
          <td><?php echo $transaction->t_date ?></td>
          <td><?php echo $transaction->title ?></td>
          <?php 
            if ($transaction->t_type == 'Withdraw') {
              echo '<td style="font-weight: 700;color: #C03E3E;">R$ - '.$transaction->amount;
            } else {
              echo '<td style="font-weight: 700;">R$ '.$transaction->amount;
            };

            echo '</td>';
          ?>
          <td><?php echo $transaction->t_description ?></td>
          <td>
            <!-- <a href="update.php?id" type="button" class="btn btn-sm btn-outline-primary">Editar</a> -->
            <form action="/wallet/delete" method="post">
              <input type="hidden" name="id" value="<?php echo $transaction->transaction_id ?>">
              <button type="submit" class="btn btn-sm btn-outline-danger">Excluir</button>
            </form> 
          </td>
        </tr>
      <?php endforeach; ?>
      
    </tbody>
  </table>