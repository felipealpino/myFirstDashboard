<?php 
require_once '../entities/User.php';
require '../connections/configMySQL.php';

class UserDaoMysql{

    private $pdo;

    public function __construct(PDO $driver){
        $this->pdo = $driver;
    }


    public function login($email, $senha){
        $sql = $this->pdo->prepare("SELECT * FROM users WHERE email=:email");
            $sql->bindValue(':email', $email);
        $sql->execute();

        if($sql->rowCount() > 0){
            $data = $sql->fetch(PDO::FETCH_ASSOC);
            
            if(password_verify($senha, $data['senha'])){
                $user = new User();
                $user->setid($data['id']);
                $user->setNome($data['nome']);
                $user->setEmail($data['email']);
                $user->setSenha($data['senha']);
                $user->setToken($data['token']);
                $_SESSION['id'] = $user->getId();
                $_SESSION['nome'] = $user->getNome();
                $_SESSION['email'] = $user->getEmail();
                $_SESSION['senha'] = $user->getSenha();
                $_SESSION['token'] = $user->getToken();
                return $user;
            }
        } else {
            return false;
        } 
    }

    
    public function isLogged($email){
        if($email){
            $sql = $this->pdo->prepare("SELECT * FROM users WHERE email=:email");
                $sql->bindValue(':email', $email);
            $sql->execute();

            if($sql->rowCount() > 0){
                $data = $sql->fetch(PDO::FETCH_ASSOC);
                $_SESSION['token'] = $data['token']; 
                return true;
            }
        } else {
            return false;
        }
    }


    public function logOut(){
        // $_SESSION['flash'] = '';
        // $_SESSION['user'] = '';
        // $_SESSION['email'] = '';
        // $_SESSION['token'] = '';
        session_destroy();
    }


    public function emailExists($email){
        $sql = $this->pdo->prepare("SELECT * FROM users WHERE email=:email");
            $sql->bindValue(':email', $email);
        $sql->execute();

        if($sql->rowCount() > 0){
            return true;
        } else { 
            return false;
        }
    }

    public function addUsuario($nome, $email, $senha){
        $hash = password_hash($senha, PASSWORD_DEFAULT);
        $token = md5(time().rand(0,9999).time());
        $sql = $this->pdo->prepare("INSERT INTO users (nome, email, senha, token) VALUES (:nome, :email, :senha, :token)");
            $sql->bindValue(':nome', $nome);
            $sql->bindValue(':email', $email);
            $sql->bindValue(':senha', $hash);
            $sql->bindValue(':token', $token);
        $sql->execute();
        return true;
    }



    public function updateUsuario($nome, $senha, $id){
        $sql = $this->pdo->prepare("UPDATE users SET nome=:nome, senha=:senha WHERE id=:id");
            $sql->bindValue(':id', $id);
            $sql->bindValue(':nome', $nome);
            $sql->bindValue(':senha', $senha);
        $sql->execute();

        $_SESSION['nome'] = $nome;
        $_SESSION['senha'] = $senha;
        return true;
    }



}


?>