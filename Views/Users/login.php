<form method='post' action='/VIKINGS/Users/login' style="width:25%;margin:auto;" id="loginForm">
    <div class="form-group">
        <input type="text" maxlength="255" class="form-control" id="userLog" name="userLog" placeholder="Nome de usuário/e-mail" required>
    </div>
    <div class="form-group">
        <input type="password" class="form-control" id="senhaLog" name="senhaLog" placeholder="Senha" required>
    </div>
    <button type="submit" name="btnLogin" class="btn btn-primary" style="width:100%;">Login</button>
    <div class="text-center" style="margin-top:4px">Não tem conta? <span class="like-link" onClick="javascript:location.href = '/VIKINGS/Users/signup';">Cadastre-se.</span></div>
</form>