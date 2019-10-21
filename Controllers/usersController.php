<?php
class usersController extends Controller {

    function acessar() {
        if(isset($_POST['btn-SU'])){
            $user = $_POST['user'];
            $email = $_POST['email'];
            $senha = $_POST['senha'];
            $csenha = $_POST['csenha'];

            //Lidar com erros-> permitir usar queries no router
            if((!filter_var($email, FILTER_VALIDATE_EMAIL)) && (!preg_match("/^[a-zA-Z0-9]*$/", $user))){
                //header("location: " . WEBROOT . "Users/acessar?error=invalidmailuid");
                //exit();
                header("location: " . WEBROOT . "Users/acessar");
            }else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                //header("location: " . WEBROOT . "Users/acessar?error=invalidmail&user=".$user);
                //exit();
                header("location: " . WEBROOT . "Users/acessar");
            }else if(!preg_match("/^[a-zA-Z0-9]*$/", $user)){
                //header("location: " . WEBROOT . "Users/acessar?error=invaliduid&mail=" . $email);
                //exit();
                header("location: " . WEBROOT . "Users/acessar");
            }else if($senha !== $csenha){
                //header("location: " . WEBROOT . "Users/acessar?error=difPasswrds&user=".$user . "&mail=" . $email);
                //exit();
                header("location: " . WEBROOT . "Users/acessar");
            }else{
                require(ROOT . 'Models/Users.php');
                $users = new Users();
                $resultado = $users->pesquisarUserEmail($user);

                if($resultado[0] > 0){
                    //header("location: " . WEBROOT . "Users/acessar?error=uidTaken&mail=".$email);
                    //exit();
                    header("location: " . WEBROOT . "Users/acessar");
                }else{
                    $resultado = $users->inserir([$user, $email, $senha]);
                    //header("location: " . WEBROOT . "Users/acessar?acessar=success");
                    header("location: " . WEBROOT . "Users/acessar");
                }
            }
        }
        $this->render("acessar");
    }

    function login() {
        if(isset($_POST['btnLogin'])){
            $user = $_POST['userLog'];
            $pwd = $_POST['senhaLog'];

            require(ROOT . 'Models/Users.php');
            $users = new Users();

            $result = $users->login($user, $pwd);
            if($result !== 0){
                $_SESSION['user'] = $result;
                header("location: " . WEBROOT . "Cartorios/index");
            }
        }
        //$this->render("../index");
    }
}
?>