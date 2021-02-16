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
                $_SESSION['nome'] = $user->getNome();
                $_SESSION['email'] = $user->getEmail();
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




}


?>