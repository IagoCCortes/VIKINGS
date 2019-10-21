<form method='post' action='/VIKINGS-master/Users/login' style="width:25%;margin:auto;" id="loginForm">
    <?php if(isset($_GET['error'])){
        if($_GET['error'] == 'nomatch'){
            echo '<p style="color:red;" class="text-center">Combinação de usuário/e-mail e senha errada.</p>';
        }
        
    }else if(isset($_GET['signup'])){
        if($_GET['signup'] == 'success'){
            echo '<p style="color:green;" class="text-center">Cadastro realizado com sucesso.</p>';
        }
    };?>
    <div class="form-group">
        <input type="text" maxlength="255" class="form-control" id="userLog" name="userLog" placeholder="Nome de usuário/e-mail" required>
    </div>
    <div class="form-group">
        <input type="password" class="form-control" id="senhaLog" name="senhaLog" placeholder="Senha" required>
    </div>
    <button type="submit" name="btnLogin" class="btn btn-primary" style="width:100%;">Login</button>
    <div class="text-center" style="margin-top:4px">Não tem conta? <span class="like-link" onClick="javascript:location.href = '/VIKINGS-master/Users/signup';">Cadastre-se.</span></div>
</form>