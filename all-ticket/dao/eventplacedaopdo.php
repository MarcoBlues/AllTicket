<?php
    namespace DAO;

    use Models\EventPlace as EventPlace;
    use DAO\Connection as Connection;
    use DAO\DBException as DBException;

    class EventPlaceDAOPDO  implements IEventPlaceDAO {
        private $connection;
        private $tableName = "event_place";

        public function AddEventPlace(EventPlace $eventPlace) {
            try {
                $query = "INSERT INTO ".$this->tableName." (eventplace_slots, eventplace_desc) VALUES (:slots, :desc);";
                
                $parameters["slots"] = $eventPlace->getSlots();
                $parameters["desc"] = $eventPlace->getDesc();

                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch(Exception $ex) {
                throw $ex;
            }
        }

        public function GetAllEventPlaces($what) {
            $eventPlaceList = array();

            try {
                if($what) {
                    $query = "SELECT * FROM ".$this->tableName." WHERE eventplace_active = 1;";
                }
                else {
                    $query = "SELECT * FROM ".$this->tableName;
                }

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                
                foreach ($resultSet as $row) {                
                    $eventPlace = new EventPlace();

                    $eventPlace->setId($row["eventplace_id"]);
                    $eventPlace->setSlots($row["eventplace_slots"]);
                    $eventPlace->setDesc($row["eventplace_desc"]);
                    $eventPlace->setActive($row["eventplace_active"]);

			    	array_push($eventPlaceList, $eventPlace);
                }
            }
            catch(Exception $ex) {
                throw $ex;
            }
            finally {
                return $eventPlaceList;
            }
        }

        public function GetEventPlaceById($id, $what) {
            $eventPlace = null;

            try {
                if($what) {
                    $query = "SELECT * FROM ".$this->tableName." WHERE eventplace_id = :id AND eventplace_active = 1;";
                }
                else {
                    $query = "SELECT * FROM ".$this->tableName." WHERE eventplace_id = :id";
                }

                $parameters["id"] = $id;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query, $parameters);
                
                foreach ($resultSet as $row) {
                    $eventPlace = new EventPlace();

                    $eventPlace->setId($row["eventplace_id"]);
                    $eventPlace->setSlots($row["eventplace_slots"]);
                    $eventPlace->setDesc($row["eventplace_desc"]);
                    $eventPlace->setActive($row["eventplace_active"]);
                }
            }
            catch(Exception $ex) {
                throw $ex;
            }
            finally {
                return $eventPlace;
            }
        }

        public function GetEventPlaceByDesc($desc, $what) {
            $eventPlace = null;

            try {
                if($what) {
                    $query = "SELECT * FROM ".$this->tableName." WHERE eventplace_desc = :desc AND eventplace_active = 1;";
                }
                else {
                    $query = "SELECT * FROM ".$this->tableName." WHERE eventplace_desc = :desc";
                }

                $parameters["desc"] = $desc;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query, $parameters);
                
                foreach ($resultSet as $row) {
                    $eventPlace = new EventPlace();

                    $eventPlace->setId($row["eventplace_id"]);
                    $eventPlace->setSlots($row["eventplace_slots"]);
                    $eventPlace->setDesc($row["eventplace_desc"]);
                    $eventPalce->setActive($row["eventplace_active"]);
                }
            }
            catch(Exception $ex) {
                throw $ex;
            }
            finally {
                return $eventPlace;
            }
        }

        public function UpdateEventPlace($id, EventPlace $newEventPlace) {
            try {
                $query = "UPDATE ".$this->tableName." SET eventplace_slots = :slots, eventplace_desc = :desc WHERE eventplace_id = :id;";

                $parameters["slots"] = $newEventPlace->getSlots();
                $parameters["desc"] = $newEventPlace->getDesc();
                $parameters["id"] = $id;

                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch(Exception $ex) {
                throw $ex;
            }
        }

        public function CheckEventPlaceById($id) {
            try {
                $query = "SELECT * FROM ".$this->tableName.
                " WHERE eventplace_id = :id";

                $parameters["id"] = $id;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query, $parameters);

                return $resultSet ? 1 : 0;
            }
            catch(Exception $ex) {
                throw $ex;
            }
        }

        public function ChangeEventPlaceState($id) {
            try {
                $query = "UPDATE ".$this->tableName." SET eventplace_active = NOT eventplace_active WHERE eventplace_id = :id;";

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