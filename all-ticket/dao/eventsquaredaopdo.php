<?php
    namespace DAO;

    use Models\Eventype as Eventype;
    use Models\EventSquare as EventSquare;
    use DAO\Connection as Connection;
    use DAO\DBException as DBException;

    class EventSquareDAOPDO implements IEventSquareDAO{
        private $connection;
        private $tableName = "event_square";

        public function AddEventSquare(EventSquare $eventSquare, $id) {
            try {
                $query = "INSERT INTO ".$this->tableName." (eventsquare_avaiables, eventsquare_remainings, eventsquare_price, fk_eventsquare_event_type, fk_calendary_id) VALUES (:avaiables, :remainings, :price, :eventype_id, :calendary_id);";
                
                $parameters["avaiables"] = $eventSquare->getAvaiables();
                $parameters["remainings"] = $eventSquare->getRemainings();
                $parameters["price"] = $eventSquare->getPrice();
                $parameters["eventype_id"] = $eventSquare->getEventype()->getId();
                $parameters["calendary_id"] = $id;
                
                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch(DBException $e) {
                throw new DBException("¡Error al crear la plaza del evento!");
            }
        }

        

        public function GetAllEventsquares() {
            $eventSquareList = array();

            try{
                $query = "SELECT * FROM ".$this->tableName." INNER JOIN event_type ON ".$this->tableName.".fk_eventsquare_event_type = event_type.eventype_id".
                " INNER JOIN calendaries ON ".$this->tableName.".fk_calendary_id = calendaries.calendary_id";

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);

                foreach ($resultSet as $row) {                
                    $eventType = new Eventype();
                    $eventSquare = new EventSquare();

                    $eventType->setId($row["eventype_id"]);
                    $eventType->setDesc($row["eventype_desc"]);

			    	array_push($eventSquareList, $eventType);
			    }
            }
            catch(DBException $e)
            {
                throw new DBException("Error en la obtencion de la capacidad del evento". $message,$e->getCode());
            }
            finally{
                return $eventSquareList;
            }
        }
        /*
        public function GetByEventTypeDesc($desc)
        { 
            $eventSquare = null;
            try{
                $query = "SELECT * FROM ".$this->tableName." WHERE eventype_desc = :desc";

                $parameters["desc"] = $desc;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query, $parameters);
                
                foreach ($resultSet as $row)
			    {
                    $eventSquare = new Artist();

                    $eventSquare->setId($row["eventype_id"]);
                    $eventSquare->setDesc($row["eventype_desc"]);
                }
            }
            catch(DBException $e)
            {
                throw new DBException("Error en la obtencion de la capacidad del evento". $message,$e->getCode());
            }
            finally{
                return $eventSquare;
            }
        }*/

        
        public function GetEventSquareById($id)
        {
            $eventSquare = null;
            try
            {
                $query = "SELECT * FROM ".$this->tableName." INNER JOIN event_type ON fk_eventsquare_event_type = eventype_id WHERE eventsquare_id = :id";

                $parameters["id"] = $id;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query, $parameters);

                foreach($resultSet as $row)
                {
                    $eventSquare = new EventSquare();

                    $eventSquare->setAvaiables($row["eventsquare_avaiables"]);
                    $eventSquare->setRemainings($row["eventsquare_remainings"]);
                    $eventSquare->setPrice($row["eventsquare_price"]);
                    $eventSquare->setId($row["eventsquare_id"]);

                    $eventType = new Eventype();

                    $eventType->setId($row["eventype_id"]);
                    $eventType->setDesc($row["eventype_desc"]);

                    $eventSquare->setEventype($eventType);
                }
                
                return $eventSquare;
            }
            catch(DBException $e)
            {
                throw new DBException("Error al consultar precio de la plaza". $message,$e->getCode());
            }
        }
        
        public function GetEventSquarePrice($id)
        {
            try
            {
                $query = "SELECT eventsquare_price FROM ".$this->tableName." WHERE eventsquare_id = :id";

                $parameters["id"] = $id;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query, $parameters);

                if($resultSet)
                    return $row['eventsquare_price'];
                
                return 0;
            }
            catch(DBException $e)
            {
                throw new DBException("Error al consultar precio de la plaza". $message,$e->getCode());
            }
        }

        
        public function GetDateByEventSquareId($id)
        {
            
            try
            {
                $query = "SELECT calendaries.calendary_date FROM ".$this->tableName ." 
                INNER JOIN calendaries on calendaries.calendary_id = event_square.fk_calendary_id 
                WHERE event_square.eventsquare_id = :id;"; 

                $parameters["id"] = $id;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query, $parameters);

                foreach($resultSet as $row){
                    
                    return $row['calendary_date'];
                }
                    

            }
            catch(DBException $e)
            {
                throw new DBException("Error al consultar precio de la plaza". $message,$e->getCode());
            }
    
    }
        public function UpdateEventSquareRemainings($id,$quantity)
        {
            try
            {
                $query = "UPDATE ".$this->tableName." SET eventsquare_remainings = (eventsquare_remainings - :quantity) WHERE eventsquare_id = :id;";
                $this->connection = Connection::GetInstance();

                $parameters["quantity"] = $quantity;
                $parameters["id"] = $id;
                
                $this->connection->ExecuteNonQuery($query, $parameters);

            }
            catch(DBException $e)
            {
                throw new DBException("Error en la actualizacion de las plazas". $message,$e->getCode());
            }
        }

        public function Delete($id)
        {
            try{
            $query = "DELETE FROM ".$this->tableName." WHERE eventype_id = :id";
            
            $parameters["id"] = $id;

            $this->connection = Connection::GetInstance();
            $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch(DBException $e)
            {
                throw new DBException("Error en la eliminacion de la capacidad del evento". $message,$e->getCode());
            }
           
        }
    }
?>