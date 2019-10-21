<?php
class Users extends Model {
    /***********************************************************************
     * Classe responsável pelas ações relacionadas à tabela usuarios no 
     * banco de dados
     **********************************************************************/

    public function inserir($campos) {
        /*******************************************************************
         * Insere os dados em $campos na tabela usuarios
         ******************************************************************/
        $sql = "INSERT INTO usuarios 
        (username, email, password)
        VALUES (?, ?, ?)";
        $req = Database::getBdd()->prepare($sql);

        $hashedPassword = password_hash($campos[2], PASSWORD_DEFAULT);

        return $req->execute(array(
            $campos[0],
            $campos[1],
            $hashedPassword
        ));
    }

    public function pesquisarUserEmail($uid) {
        /*******************************************************************
         * pesquisa pelo username ou email $uid na tabela usuarios
         ******************************************************************/
        $sql = "select count(*) from usuarios where username = ? or email = ?";
        $req = Database::getBdd()->prepare($sql);

        $req->execute(array($uid, $uid));
        /*para o controlador
        if(!$req->execute(array($uid))){
            header("location: " . WEBROOT . "Users/signUp?error=sqlError");
            exit();
        }*/
        return $req->fetch();
    }

    public function login($user, $pwd) {
        /*******************************************************************
         * Verifica se os dados $user (usuario ou email) e $pwd (senha) 
         * correspondem a um usuário
         ******************************************************************/
        $sql = "select * from usuarios where email = ? or username = ?";
        $req = Database::getBdd()->prepare($sql);

        $req->execute(array($user, $user));
        $result = $req->fetch();
        if(!isset($result)){
            return;
        }else{
            $pwdCheck = password_verify($pwd, $result['PASSWORD']);
            if(!$pwdCheck){
                return;
            }else{
                return $result['USERNAME'];
                //return $result['USERNAME'];
            }
        }
        /*para o controlador
        if(!$req->execute(array($uid))){
            header("location: " . WEBROOT . "Users/signUp?error=sqlError");
            exit();
        }*/
    }

}
?>