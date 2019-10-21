<form method='post' action='/VIKINGS/Users/signup' style="width:25%;margin:auto;" id="signUp">
    <div class="form-group">
        <input type="text" maxlength="255" class="form-control" id="user" name="user" placeholder="Nome de usuário" required>
    </div>
    <div class="form-group">
        <input type="text" maxlength="255" class="form-control" id="email" name="email" placeholder="E-mail" required>
    </div>
    <div class="form-group">
        <input type="password" class="form-control" id="senha" name="senha" placeholder="Senha" required>
    </div>
    <div class="form-group">
        <input type="password" class="form-control" id="csenha" name="csenha" placeholder="Confirme a senha" required>
    </div>
    <button type="submit" name="btn-SU" class="btn btn-primary" style="width:100%;">Cadastrar</button>
    <div class="text-center" style="margin-top:4px">Já tem uma conta? <span class="like-link" onClick="javascript:location.href = '/VIKINGS/Users/login';">Entre.</span></div>
</form>