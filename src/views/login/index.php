<h1 class="m-5 ps-4">login</h1>

<div class="m-5">
  <form action="/login" method="post" class="px-4 py-3">
    <div class="mb-3">
      <label for="FormEmail1" class="form-label">Email</label>
      <input type="email" name="login" class="form-control" id="FormEmail1" placeholder="Digite seu Email">
    </div>
    <div class="mb-3">
      <label for="FormPassword1" class="form-label">Senha</label>
      <input type="password" name="pass_word" class="form-control" id="FormPassword1" placeholder="Digite sua Senha">
    </div>
    <div class="mb-3">
      <div class="form-check">
        <input type="checkbox" class="form-check-input" id="dropdownCheck">
        <label class="form-check-label" for="dropdownCheck">
          Lembrar Senha
        </label>
      </div>
    </div>
    <button type="submit" class="btn btn-primary">Sign in</button>
  </form>
  <div class="ms-5 mt-2">
    <a class="fw-semibold
    link-offset-3 link-underline link-underline-opacity-25 link-underline-opacity-100-hover
    " href="#">Novo por aqui? Registre-se!</a>
    <br>
    <a class="fw-semibold
    link-offset-3 link-underline link-underline-opacity-25 link-underline-opacity-100-hover
    " href="#">Esqueçeu a senha?</a>
  </div>
</div>