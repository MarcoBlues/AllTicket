<?php
    namespace DAO;

    use Models\Event as Event;
    use Models\Category as Category;
    use Models\Artist as Artist;
    use Models\EventSquare as EventSquare;
    use Models\Calendary as Calendary;
    use Models\EventPlace as EventPlace;
    use Models\Eventype as Eventype;

    use DAO\DBException as DBException;
    use DAO\Connection as Connection;

    class CalendaryDAOPDO implements ICalendaryDAO {
        private $connection;
        private $tableName = "calendaries";

        public function AddCalendary(Calendary $calendary, $horary) {
            try {
                $query = "INSERT INTO ".$this->tableName." (calendary_date, fk_event_id, fk_eventplace_id) VALUES (:calendary_date, :event_id, :eventplace_id);";
                
                $parameters["calendary_date"] = $calendary->getDate();
                $parameters["event_id"] = $calendary->getEvent()->getId();
                $parameters["eventplace_id"] = $calendary->getEventPlaces()->getId();    

                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query, $parameters);

                $calendaryId = $this->connection->lastId();

                foreach($calendary->getArtists() as $artist) {
                    $query = "INSERT INTO calendary_by_artist (pfk_calendary_id, pfk_artist_id, horary) VALUES (:calendary_id, :artist_id, :horary);";
                    
                    $parametersArtist["calendary_id"] = $calendaryId;
                    $parametersArtist["artist_id"] = $artist->getId();
                    $parametersArtist["horary"] = $horary;

                    $this->connection = Connection::GetInstance();
                    $this->connection->ExecuteNonQuery($query, $parametersArtist);
                }

                $calendary->setId($calendaryId);

                return $calendary;
            }
            catch(DBException $e) {
                throw new DBException("¡Error al crear un nuevo artista!");
            }
        }

        public function CheckCalendaryById($id) {
            try {
                $query = "SELECT * FROM ".$this->tableName.
                " WHERE calendary_id = :id";

                $parameters["id"] = $id;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query, $parameters);

                return $resultSet ? 1 : 0;
            }
            catch(Exception $ex) {
                throw $ex;
            }
        }

        public function GetCalendaryById4Buy($id) {
            $calendary = null;

            try {
                $query = "SELECT * FROM ".$this->tableName.
                " INNER JOIN event_square on event_square.fk_calendary_id = :id".
                " INNER JOIN event_type on event_square.fk_eventsquare_event_type = event_type.eventype_id".
                " WHERE calendary_id = :id AND calendary_active = 1;";

                $parameters["id"] = $id;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query, $parameters);

                $calendary = new Calendary();
                
                foreach ($resultSet as $row) {
                    $eventSquare = new EventSquare();
                    $eventType = new EvenType();
                    
                    $calendary->setId($row["calendary_id"]);
                    $calendary->setDate($row["calendary_date"]);
                    $calendary->setActive($row["calendary_active"]);
                    
                    $eventType->setDesc($row["eventype_desc"]);
                    $eventType->setActive($row["eventype_active"]);

                    $eventSquare->setId($row["eventsquare_id"]);
                    $eventSquare->setAvaiables($row["eventsquare_avaiables"]);
                    $eventSquare->setRemainings($row["eventsquare_remainings"]);
                    $eventSquare->setPrice($row["eventsquare_price"]);
                    $eventSquare->setActive($row["eventsquare_active"]);

                    $eventSquare->setEventype($eventType);

                    $calendary->pushEventSquare($eventSquare); 
                }
            }
            catch(Exception $ex) {
                throw $ex;
            }
            finally {
                return $calendary;
            }
        }

        public function UpdateCalendary($id, Calendary $newCalendary) {
            try {
                $query = "UPDATE ".$this->tableName." SET calendary_date = :date WHERE calendary_id = :id;";

                $parameters["date"] = $newCalendary->getDate();
                $parameters["id"] = $id;

                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch(Exception $ex) {
                throw $ex;
            }
        }

        public function GetAllCalendaries($what) {
            $calendaryList = array();

            try {
                if($what) {
                    $query = "SELECT * FROM ".$this->tableName.
                    " INNER JOIN events ON ".$this->tableName.".fk_event_id = events.event_id".
                    " INNER JOIN categories ON events.pfk_category_id = categories.category_id".
                    " INNER JOIN event_place ON ".$this->tableName.".fk_eventplace_id = event_place.eventplace_id".
                    " WHERE calendary_active = 1";
                }
                else {
                    $query = "SELECT * FROM ".$this->tableName.
                    " INNER JOIN events ON ".$this->tableName.".fk_event_id = events.event_id".
                    " INNER JOIN categories ON events.pfk_category_id = categories.category_id".
                    " INNER JOIN event_place ON ".$this->tableName.".fk_eventplace_id = event_place.eventplace_id;";
                }

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);

                foreach ($resultSet as $row) {
                    $calendary = new Calendary();
                    $category = new Category();
                    $event = new Event();
                    $eventPlace = new EventPlace();

                    $calendary->setId($row["calendary_id"]);
                    $calendary->setDate($row["calendary_date"]);
                    $calendary->setActive($row["calendary_active"]);

                    $category->setId($row["category_id"]); 
                    $category->setName($row["category_name"]);
                    $category->setActive($row["category_active"]);

                    $event->setId($row["event_id"]);
                    $event->setTitle($row["event_title"]);
                    $event->setActive($row["event_active"]);
                    $event->setCategory($category);
                    
                    $calendary->setEvent($event);

                    $eventPlace->setId($row["eventplace_id"]);
                    $eventPlace->setSlots($row["eventplace_slots"]);
                    $eventPlace->setDesc($row["eventplace_desc"]);
                    $eventPlace->setActive($row["eventplace_active"]);

                    $calendary->setEventPlace($eventPlace);

                    $query2 = "SELECT * FROM artists".
                    " INNER JOIN calendary_by_artist ON calendary_by_artist.pfk_calendary_id = :id".
                    " WHERE calendary_by_artist.pfk_artist_id = artists.artist_id;";

                    $parameters["id"] = $calendary->getId();

                    $this->connection = Connection::GetInstance();
                    $newResult = $this->connection->Execute($query2, $parameters);

                    foreach($newResult as $row) {  
                        $artist = new Artist();
                        
                        $artist->setId($row["artist_id"]);
                        $artist->setLastName($row["artist_lastname"]);
                        $artist->setName($row["artist_name"]);
                        $artist->setNickName($row["artist_nickname"]);
                        $artist->setActive($row["artist_active"]);

                        $calendary->pushArtist($artist);
                    }

                    array_push($calendaryList, $calendary);
                }
            }
            catch(Exception $ex) {
                throw $ex;
            }
            finally {
                return $calendaryList;
            }
        }

        public function GetCalendaryByCreated($horary, $id, $date) {
            try {
                $query = "SELECT * FROM calendaries INNER JOIN calendary_by_artist ON horary = :horary AND calendaries.fk_eventplace_id = :id AND calendaries.calendary_date = :date";

                $parameters["id"] = $id;
                $parameters["horary"] = $horary;
                $parameters["date"] = $date;

                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query, $parameters);

                return $resultSet ? 1 : 0;
            }
            catch(Exception $ex) {
                throw $ex;
            }
        }

        public function GetEventTitleByCalendaryId($id) {
            try {
                $query = "SELECT event_title FROM " .$this->tableName . " INNER JOIN events on fk_event_id = events.event_id WHERE calendary_id = :id;";

                $parameters["id"] = $id;

                $this->connection = Connection::GetInstance();
                $resultSet = $this->connection->Execute($query, $parameters);
                foreach($resultSet as $row)
                {
                    return $row["event_title"];
                }
            }
            catch(Exception $ex) {
                throw $ex;
            }
        }

        public function ChangeCalendaryState($id) {
            try {
                $query = "UPDATE ".$this->tableName." SET calendary_active = NOT calendary_active WHERE calendary_id = :id;";

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