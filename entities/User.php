<?php 


class User{

    private $id;
    private $nome;
    private $email;
    private $senha;
    private $permissao;
    private $token;


    public function getId(){
        return $this->id;
    }
    public function setid($id){
        $this->id = $id;
    }


    public function getNome(){
        return $this->nome;
    }
    public function setNome($nome){
        $this->nome = $nome;
    }


    public function getEmail(){
        return $this->email;
    }
    public function setEmail($email){
        $this->email = $email;
    }


    public function getSenha(){
        return $this->senha;
    }
    public function setSenha($senha){
        $this->senha = $senha;
    }


    public function getPermissaoId(){
        return $this->permissao;
    }
    public function setPermissao($idPermissao){
        $this->permissao = $idPermissao;
    }



    public function getToken(){
        return $this->token;
    }
    public function setToken($token){
        $this->token = $token;
    }




    

}


?>