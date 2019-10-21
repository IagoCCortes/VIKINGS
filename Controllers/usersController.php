<?php
class usersController extends Controller {
    /***********************************************************************
     * Classe responsável por controlar as ações relacionadas aos usuarios
     **********************************************************************/

    function signup() {
        /*******************************************************************
         * Valida os dados fornecidos pelo usuário e casos eles sejam validos
         * envia este dados para o modelo Users para inserção no bd 
         ******************************************************************/
        if(isset($_POST['btn-SU'])){
            $user = $_POST['user'];
            $email = $_POST['email'];
            $senha = $_POST['senha'];
            $csenha = $_POST['csenha'];

            if((!filter_var($email, FILTER_VALIDATE_EMAIL)) && (!preg_match("/^[a-zA-Z0-9]*$/", $user))){
                header("location: " . WEBROOT . "Users/signup?error=invalidmailuid");
                exit();
            }else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                header("location: " . WEBROOT . "Users/signup?error=invalidmail&user=".$user);
                exit();
            }else if(!preg_match("/^[a-zA-Z0-9]*$/", $user)){
                header("location: " . WEBROOT . "Users/signup?error=invaliduid&mail=" . $email);
                exit();
            }else if($senha !== $csenha){
                header("location: " . WEBROOT . "Users/signup?error=difPasswrds&user=".$user . "&mail=" . $email);
                exit();
            }else{
                require(ROOT . 'Models/Users.php');
                $users = new Users();
                $resultado = $users->pesquisarUserEmail($user);

                if($resultado[0] > 0){
                    header("location: " . WEBROOT . "Users/signup?error=uidTaken&mail=".$email);
                    exit();
                }else{
                    $resultado = $users->inserir([$user, $email, $senha]);
                    header("location: " . WEBROOT . "Users/login?signup=success");
                    exit();
                }
            }
        }
        $this->render("signup");
    }

    function login() {
        /*******************************************************************
         * Valida se os dados de login fornecidos correspondem a uma conta 
         * salva e inicia uma sessão para este usuário 
         ******************************************************************/
        if(isset($_POST['btnLogin'])){
            $user = $_POST['userLog'];
            $pwd = $_POST['senhaLog'];

            require(ROOT . 'Models/Users.php');
            $users = new Users();

            $result = $users->login($user, $pwd);
            if(isset($result)){
                session_start();
                $_SESSION['user'] = $result;
                header("location: " . WEBROOT . "Cartorios/index");
                exit();
            }else{
                header("location: " . WEBROOT . "Users/login?error=nomatch");
                exit();
            }
        }
        $this->render("login");
    }

    function logout(){
        /*******************************************************************
         * Realiza logout finalizando a sessão
         ******************************************************************/
        session_start();
        session_unset();
        session_destroy();
        header("location: " . WEBROOT . "Users/login");
        exit();
    }
}
?>