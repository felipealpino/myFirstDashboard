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
                return $user;
            }
        } else {
            return false;
        }
        
    }

    
    public function isLogged($email){

    }


    public function logOut(){
        
    }




}


?>