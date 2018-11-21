<?php
    namespace DAO;

    use Models\Eventype as Eventype;
    use DAO\Connection as Connection;

    class EventypeDAOPDO implements IEventypeDAO {
        private $connection;
        private $tableName = "event_type";

        public function AddEventype(Eventype $eventType) {
            try{
                $query = "INSERT INTO ".$this->tableName." (eventype_desc) VALUES (:desc);";

                $parameters["desc"] = $eventType->getDesc();

                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch(Exception $ex) {
                throw $ex;
            }
        }


        public function GetAllEventypes($what) {
            $eventTypeList = array();
            try {
                if($what) {
                    $query = "SELECT * FROM ".$this->tableName." WHERE eventype_active = 1;";
                }
                else {
                    $query = "SELECT * FROM ".$this->tableName;
                }
                
                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);

                foreach ($resultSet as $row) {                
                    $eventType = new Eventype();

                    $eventType->setId($row["eventype_id"]);
                    $eventType->setDesc($row["eventype_desc"]);
                    $eventType->setActive($row["eventype_active"]);

			    	array_push($eventTypeList, $eventType);
                }
            }
            catch(Exception $ex) {
                throw $ex;
            }
            finally {
                return $eventTypeList;
            }
        }

        public function GetEventTypeByDesc($desc, $what) {   
            $eventType = null;

            try {
                if($what) {
                    $query = "SELECT * FROM ".$this->tableName." WHERE eventype_desc = :desc AND eventype_active = 1;";
                }
                else {
                    $query = "SELECT * FROM ".$this->tableName." WHERE eventype_desc = :desc";
                }

                $parameters["desc"] = $desc;

                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query, $parameters);
                
                foreach ($resultSet as $row) {
                    $eventType = new Eventype();

                    $eventType->setId($row["eventype_id"]);
                    $eventType->setDesc($row["eventype_desc"]);
                    $eventType->setActive($row["eventype_active"]);
                }
            }
            catch(Exception $ex) {
                throw $ex;
            }
            finally {
                return $eventType;
            }
        }

        public function CheckEventypeById($id) {
            try {
                $query = "SELECT * FROM ".$this->tableName.
                " WHERE eventype_id = :id";

                $parameters["id"] = $id;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query, $parameters);

                return $resultSet ? 1 : 0;
            }
            catch(Exception $ex) {
                throw $ex;
            }
        }

        public function UpdateEventype($id, Eventype $newEventype) {
            try {
                $query = "UPDATE ".$this->tableName." SET eventype_desc = :desc WHERE eventype_id = :id;";

                $parameters["desc"] = $newEventype->getDesc();
                $parameters["id"] = $id;

                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch(Exception $ex) {
                throw $ex;
            }
        }       

        public function GetEventTypeById($id, $what) {
            $eventType = null;

            try {
                if($what) {
                    $query = "SELECT * FROM ".$this->tableName." WHERE eventype_id = :id AND eventype_active = 1;";
                }
                else {
                    $query = "SELECT * FROM ".$this->tableName." WHERE eventype_id = :id";
                }

                $parameters["id"] = $id;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query, $parameters);
                
                foreach ($resultSet as $row) {
                    $eventType = new Eventype();

                    $eventType->setId($row["eventype_id"]);
                    $eventType->setDesc($row["eventype_desc"]);
                    $eventType->setActive($row["eventype_active"]);
                }
            }
            catch(Exception $ex) {
                throw $ex;
            }
            finally {
                return $eventType;
            }
        }

        public function ChangeStateEventype($id) {            
            try {
                $query = "UPDATE ".$this->tableName." SET eventype_active = NOT eventype_active WHERE eventype_id = :id;";

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