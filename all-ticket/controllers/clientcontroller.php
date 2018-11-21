<?php
    namespace Controllers;

    use DAO\ClientDAOPDO as ClientDAOPDO;
    use Models\Client as Client;
    use Exception as Exception;

    class ClientController {
        private $clientDAO;
        
        public function __construct() { 
            $this->clientDAO = new ClientDAOPDO();
        }

        public function ShowClientView($message = "", $messageError = "") {
            try {
                if(!isset($_SESSION["client"])) {
                    require_once(VIEWS_PATH."login.php");
                }
                else {
                    $clientList = $this->clientDAO->GetAllClients(); 
                    require_once(VIEWS_PATH."clients-view.php");
                }                
            }
            catch(Exception $ex) {
                $message = "¡Error al mostrar los clientes!";
                $messageError = $ex->getMessage();

                $this->ShowClientView($message, $messageError); 
            }
        }

        public function Authentication($userName = "", $password = "") {
            if($userName == "admin" && $password == "admin") {
                $client = new Client();

                $client->setUserName("admin");
                $client->setPassword("admin");
                $client->setRol(1);

                $_SESSION["client"] = $client;

                require_once(VIEWS_PATH."header.php");
                require_once(VIEWS_PATH."home.php");
                require_once(VIEWS_PATH."footer.php");
            }
            else if($this->clientDAO->GetClientByUserName($userName) != null && $this->clientDAO->GetClientByPassword($password) != null) {
                if($this->clientDAO->GetClientStateByUserName($userName) == 0) {
                    $message = "¡Tu cuenta ha sido dada de baja!";
                    
                    require_once(VIEWS_PATH."login.php");
                }
                else {
                    $_SESSION["client"] = $this->clientDAO->GetClientByUserName($userName);
                
                    require_once(VIEWS_PATH."home.php");
                }
            }
            else {
                $message = "¡Datos incorrectos!";
                require_once(VIEWS_PATH."login.php");
            }
        }

        public function AddClient($userName = "", $password = "", $email = "") {
            try {
                if(isset($_SESSION["client"])) {
                    require_once(VIEWS_PATH."home.php");
                }
                else {
                    if($userName == '' || $password == '' || $email == '' || $userName === NULL || $password === NULL || $email === NULL || strpos($email, "@") === FALSE) {
                            $message = "¡Campos inválidos!";
                            require_once(VIEWS_PATH."register.php");
                    }
                    else {
                        $client = new Client();

                        $passwordHashed = md5($password);

                        $client->setUsername($userName);
                        $client->setPassword($passwordHashed);
                        $client->setEmail($email);

                        if($this->clientDAO->GetClientByEmail($client->getEmail()) == NULL && $this->clientDAO->GetClientByUserName($client->getUserName()) == NULL) {
                            $this->clientDAO->AddClient($client);
                            $message = "¡Registro exitoso!";
                        }
                        else {
                            $message = "¡Usuario o email ya registrado!";
                        }

                        require_once(VIEWS_PATH."register.php");
                    } 
                }
            }
            catch(Exception $e) {
                $message = "¡Error al crear la cuenta! Volvé a intentarlo";

                require_once(VIEWS_PATH."register.php");
            }    
        }

        public function ChangeClientState($id) {
            try {
                if($this->clientDAO->CheckClientById($id) == 1) {
                    $this->clientDAO->ChangeClientState($id);
                    $message = "¡Se ha cambiado el estado del cliente!";
                }
                else {
                    $message = "¡El cliente no se encuentra en el sistema!";
                }

                $this->ShowClientView($message);
            }
            catch(Exception $ex) {
                $message = "¡Error al cambiar el estado del cliente!";
                $messageError = $ex->getMessage();

                $this->ShowClientView($message, $messageError);  
            }
        }
    }
?>