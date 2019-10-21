<?php
class Users extends Model {

    public function inserir($campos) {
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