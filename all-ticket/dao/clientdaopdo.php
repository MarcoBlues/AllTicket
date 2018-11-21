<?php
    namespace DAO;

    use Models\Client as Client;
    use DAO\Connection as Connection;
    use DAO\DBException as DBException;

    class ClientDAOPDO implements IClientDAO {
        private $connection;
        private $tableName = "clients";

        public function AddClient(Client $client) {
            try {
                $query = "INSERT INTO ".$this->tableName." (client_username, client_password, client_email) VALUES (:userName, :password, :email);";

                $parameters["userName"] = $client->getUserName();
                $parameters["password"] = $client->getPassword();
                $parameters["email"] = $client->getEmail();

                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query, $parameters);
            } 
            catch(Exception $ex) {
                throw $ex;
            }
        }

        public function GetClientId($userName) {
            try {
                $query = "SELECT client_id FROM ".$this->tableName." WHERE client_username = :userName";

                $parameters["userName"] = $userName;

                $this->connection = Connection::GetInstance();
                $id = $this->connection->Execute($query, $parameters);

                return $id;
            }
            catch(Exception $ex) {
                throw $ex;
            }
        }

        public function GetAllClients() {
            try {
                $clientList = array();

                $query = "SELECT * FROM ".$this->tableName;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                
                foreach ($resultSet as $row) {                
                    $client = new Client();

                    $client->setId($row["client_id"]);
                    $client->setRol($row["client_rol"]);
                    $client->setUserName($row["client_username"]);
                    $client->setPassword($row["client_password"]);
                    $client->setEmail($row["client_email"]);
                    $client->setActive($row["client_active"]);

			        array_push($clientList, $client);
                }
            }
            catch(Exception $ex) {
                throw $ex;
            }
            finally {
                return $clientList;
            }
        }

        public function GetClientByPassword($password) {
            $client = null;

            try {
                $query = "SELECT * FROM ".$this->tableName." WHERE client_password = :password";

                $passwordHashed = md5($password);

                $parameters["password"] = $passwordHashed;

                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query, $parameters);

                foreach ($resultSet as $row) {
                    $client = new Client();

                    $client->setId($row["client_id"]);
                    $client->setRol($row["client_rol"]);
                    $client->setUserName($row["client_username"]);
                    $client->setPassword($row["client_password"]);
                    $client->setEmail($row["client_email"]);
                    $client->setActive($row["client_active"]);
                }
            }
            catch(Exception $ex) {
                throw $ex;
            }
            finally {
                return $client;
            }
        }

        public function GetClientByUserName($userName) {
            $client = null;

            try {
                $query = "SELECT * FROM ".$this->tableName." WHERE client_username = :userName";

                $parameters['userName'] = $userName;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query, $parameters);

                foreach ($resultSet as $row) {
                    $client = new Client();

                    $client->setId($row["client_id"]);
                    $client->setRol($row["client_rol"]);
                    $client->setUserName($row["client_username"]);
                    $client->setPassword($row["client_password"]);
                    $client->setEmail($row["client_email"]);
                    $client->setActive($row["client_active"]);
                }
            }
            catch(Exception $ex) {
                throw $ex;
            }
            finally {
                return $client;
            }
        }

        public function GetClientByEmail($email) {
            $client = null;

            try {
                $query = "SELECT * FROM ".$this->tableName." WHERE client_email = :email";

                $parameters['email'] = $email;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query, $parameters);

                foreach ($resultSet as $row) {
                    $client = new Client();

                    $client->setId($row["client_id"]);
                    $client->setRol($row["client_rol"]);
                    $client->setUserName($row["client_username"]);
                    $client->setPassword($row["client_password"]);
                    $client->setEmail($row["client_email"]);
                    $client->setActive($row["client_active"]);
                }
            }
            catch(Exception $ex) {
                throw $ex;
            }
            finally {
                return $client;
            }
        }

        public function GetClientStateByUserName($userName) {
            try {
                $query = "SELECT client_active FROM ".$this->tableName." WHERE client_username = :userName";

                $parameters['userName'] = $userName;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query, $parameters);

                foreach ($resultSet as $row) {
                    return $row["client_active"];
                }
            }
            catch(Exception $ex) {
                throw $ex;
            }
        }

        public function GetClientById($id) {
            try {
                $client = null;

                $query = "SELECT * FROM ".$this->tableName." WHERE client_id = :id";

                $parameters["id"] = $id;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query, $parameters);

                foreach ($resultSet as $row) {
                    $client = new Client();

                    $client->setId($row["client_id"]);
                    $client->setRol($row["client_rol"]);
                    $client->setUserName($row["client_username"]);
                    $client->setPassword($row["client_password"]);
                    $client->setEmail($row["client_email"]);
                    $client->setActive($row["client_active"]);
                }
            }
            catch(Exception $ex) {
                throw $ex;
            }
            finally {
                return $client;
            }
        }

        public function ChangeClientState($id) {
            try {
                $query = "UPDATE ".$this->tableName." SET client_active = NOT client_active WHERE client_id = :id;";

                $parameters["id"] = $id;

                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch(Exception $ex) {
                throw $ex;
            }
        }
    }
?>