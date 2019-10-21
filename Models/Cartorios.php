<?php
class Cartorios extends Model {
    /***********************************************************************
     * Classe responsável pelas ações relacionadas à tabela cartorios no 
     * banco de dados
     **********************************************************************/

    public function inserir($campos) {
        /*******************************************************************
         * Envia emails a todos os destinatários selecionados por meio da 
         * biblioteca swift mailer 
         ******************************************************************/
        $sql = "INSERT INTO cartorios 
        (nome, razao, documento, cep, endereco, bairro, cidade, uf, telefone, email, tabeliao, ativo, xml_atualizar)
        VALUES (:nome, :razao, :documento, :cep, :endereco, :bairro, :cidade, :uf, :telefone, :email, :tabeliao, :ativo, 0)";
        $req = Database::getBdd()->prepare($sql);

        return $req->execute(array(
            ':nome' => $campos[0],
            ':razao' => $campos[1],
            ':documento' => $campos[2],
            ':cep'=> $campos[3],
            ':endereco'=> $campos[4],
            ':bairro'=> $campos[5],
            ':cidade'=> $campos[6],
            ':uf'=> $campos[7],
            ':telefone'=> $campos[8],
            ':email'=> $campos[9],
            ':tabeliao'=> $campos[10],
            ':ativo'=> $campos[11] === NULL ? 0 : 1
        ));
        //print_r($req->errorInfo());
    }

    public function inserirVarios($campos) {
        foreach($campos->children() as $child) {
            $sql = "INSERT INTO cartorios 
                     (nome, razao, documento, cep, endereco, bairro, cidade, uf, tabeliao, ativo, xml_atualizar)
                     VALUES (:nome, :razao, :documento, :cep, :endereco, :bairro, :cidade, :uf, :tabeliao, :ativo, :xml_atualizar)";
            $req = Database::getBdd()->prepare($sql);
                
            if(!$req->execute(array(
                ':nome' => $child->nome,
                ':razao' => $child->razao,
                ':documento' => $child->documento,
                ':cep'=> $child->cep,
                ':endereco'=> $child->endereco,
                ':bairro'=> $child->bairro,
                ':cidade'=> $child->cidade,
                ':uf'=> $child->uf,
                ':tabeliao'=> $child->tabeliao,
                ':ativo'=> $child->ativo,
                ':xml_atualizar'=> 1
            ))){
                return false;
            }   
        }
        return true;
    }

    public function totalDeRegistros(){
        $sql = "SELECT count(*) FROM cartorios";
        $req = Database::getBdd()->prepare($sql);
        $req->execute();
        return $req->fetch();
    }

    public function mostraRegistro($cod) {
        $sql = "SELECT * FROM cartorios WHERE cod = :cod";
        $req = Database::getBdd()->prepare($sql);
        $req->execute(array(
            ':cod' => $cod 
        ));
        return $req->fetch();
    }

    public function mostraTodosRegistros() {
        $sql = "SELECT * FROM cartorios order by xml_atualizar desc, atualizado_em desc, criado_em desc";
        $req = Database::getBdd()->prepare($sql);
        $req->execute();
        return $req->fetchAll();
    }

    public function mostraIntervaloDeRegistros($start, $count){
        //risco de segurança
        $sql = "SELECT * 
                FROM cartorios 
                order by xml_atualizar desc, atualizado_em desc, criado_em desc 
                limit " . $start . ", " . $count;
        $req = Database::getBdd()->prepare($sql);
        $req->execute();
        return $req->fetchAll();
    }

    public function editar($cod, $campos) {
        $sql = "UPDATE cartorios SET nome = :nome, razao = :razao, documento = :documento, cep = :cep, 
                                     endereco = :endereco, bairro = :bairro, cidade = :cidade, uf = :uf, 
                                     telefone = :telefone, email = :email, tabeliao = :tabeliao, ativo = :ativo,
                                     atualizado_em = CURRENT_TIMESTAMP(), xml_atualizar = 0 where cod = :cod";
        $req = Database::getBdd()->prepare($sql);

        return $req->execute(array(
            ':nome' => $campos[0],
            ':razao' => $campos[1],
            ':documento' => $campos[2],
            ':cep'=> $campos[3],
            ':endereco'=> $campos[4],
            ':bairro'=> $campos[5],
            ':cidade'=> $campos[6],
            ':uf'=> $campos[7],
            ':telefone'=> $campos[8],
            ':email'=> $campos[9],
            ':tabeliao' => $campos[10],
            ':ativo' => $campos[11] === NULL ? 0 : 1,
            ':cod' => $cod
        ));
    }

    public function deletar($cod) {
        $sql = 'DELETE FROM cartorios WHERE cod = ?';
        $req = Database::getBdd()->prepare($sql);
        return $req->execute(array($cod));
    }

    public function mostraRegistrosPesquisados($start, $count, $search){
        //risco de segurança
        $sql = "SELECT * 
        FROM cartorios 
        where upper(nome) like upper('%" . $search . "%') or 
        upper(razao) like upper('%" . $search . "%') or
        upper(documento) like upper('%" . $search . "%') or
        upper(cep) like upper('%" . $search . "%') or
        upper(endereco) like upper('%" . $search . "%') or
        upper(bairro) like upper('%" . $search . "%') or
        upper(cidade) like upper('%" . $search . "%') or
        upper(uf) like upper('%" . $search . "%') or
        upper(telefone) like upper('%" . $search . "%') or
        upper(email) like upper('%" . $search . "%') or
        upper(tabeliao) like upper('%" . $search . "%') or
        upper(if(ativo=1,'Sim','Não')) like upper('%" . $search . "%') or
        upper(criado_em) like upper('%" . $search . "%') or
        upper(atualizado_em) like upper('%" . $search . "%')
        order by xml_atualizar desc, atualizado_em desc, criado_em desc limit " . $start . " ," . $count;
        $req = Database::getBdd()->prepare($sql);
        $req->execute();
        return $req->fetchAll();
    }

    public function selecionaEmails() {
        $sql = "select distinct email from cartorios where email is not null";
        $req = Database::getBdd()->prepare($sql);
        $req->execute();
        return $req->fetchAll();
    }

    public function selecionaEmailsAtivos() {
        $sql = "select distinct email from cartorios where email is not null and ativo = 1";
        $req = Database::getBdd()->prepare($sql);
        $req->execute();
        return $req->fetchAll();
    }
}
?>