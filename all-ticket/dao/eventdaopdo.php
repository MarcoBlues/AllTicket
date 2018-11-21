<?php
    namespace DAO;

    use Models\Event as Event;
    use Models\Category as Category;
    use Models\Calendary as Calendary;
    use Models\EventPlace as EventPlace;
    use models\Artist as Artist;
    use Models\EventSquare as EventSquare;
    use Models\Eventype as EventType;

    use DAO\Connection as Connection;
    use DAO\DBException as DBException;
    use DAO\CalendaryDAOPDO as CalendaryDAOPDO;


    class EventDAOPDO implements IEventDAO {
        private $connection;
        private $tableName = "events";

        public function AddEvent(Event $event) {
            try {
                $query = "INSERT INTO ".$this->tableName." (pfk_category_id, event_title) VALUES (:category_id, :event_title);";
                
                $parameters["category_id"] = $event->getCategory()->getId();
                $parameters["event_title"] = $event->getTitle();

                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query, $parameters);
            } 
            catch(Exception $ex) {
                throw $ex;
            }
        }

        public function GetAllEvents($what=0) {
            $eventList = array();

            try {
                if($what) {
                    $query = "SELECT * FROM ".$this->tableName." INNER JOIN categories ON ".$this->tableName.".pfk_category_id = categories.category_id WHERE event_active = 1;";
                }
                else {
                    $query = "SELECT * FROM ".$this->tableName." INNER JOIN categories ON ".$this->tableName.".pfk_category_id = categories.category_id;";
                }              

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                
                foreach ($resultSet as $row) {                
                    $event = new Event();
                    $category = new Category();

                    $category->setId($row["category_id"]);
                    $category->setName($row["category_name"]);
                    $category->setActive($row["category_active"]);

                    $event->setId($row["event_id"]);
                    $event->setCategory($category);
                    $event->setTitle($row["event_title"]);
                    $event->setActive($row["event_active"]);

			    	array_push($eventList, $event);
                }
            }
            catch(Exception $ex) {
                throw $ex;
            }
            finally {
                return $eventList;
            }
        }

        public function UpdateEvent($id, Event $newEvent, $idCategory) {
            try {
                $query = "UPDATE ".$this->tableName." SET event_title = :title, pfk_category_id = :categoryId WHERE event_id=:id;";

                $parameters["title"] = $newEvent->getTitle();
                $parameters["id"] = $id;
                $parameters["categoryId"] = $idCategory;

                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch(Exception $ex) {
                throw $ex;
            }
        }

        // Carga peresosa
        public function GetEventByTitle($title, $what=0) {
            $event = null;

            try {
                if($what) {
                    $query = "SELECT * FROM ".$this->tableName." INNER JOIN categories ON ".$this->tableName.".pfk_category_id = categories.category_id WHERE event_title = :title AND event_active=1;";
                }
                else {
                    $query = "SELECT * FROM ".$this->tableName." INNER JOIN categories ON ".$this->tableName.".pfk_category_id = categories.category_id WHERE event_title = :title;";
                }

                $parameters["title"] = $title;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query, $parameters);
                
                foreach ($resultSet as $row) {                
                    $event = new Event();
                    $category = new Category();

                    $category->setId($row["category_id"]);
                    $category->setName($row["category_name"]);
                    $category->setActive($row["category_active"]);

                    $event->setId($row["event_id"]);
                    $event->setCategory($category);
                    $event->setTitle($row["event_title"]);
                    $event->setActive($row["event_active"]);
                }
            }
            catch(Exception $ex) {
                throw $ex;
            }
            finally {
                return $event;
            }
        }


        public function CheckEventById($id) {
            try {
                $query = "SELECT * FROM ".$this->tableName.
                " WHERE event_id = :id";

                $parameters["id"] = $id;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query, $parameters);

                return $resultSet ? 1 : 0;
            }
            catch(Exception $ex) {
                throw $ex;
            }
        }

        // Trae todo lo que corresponde al evento
        public function GetEventById($id, $what=0) {
            $event = null;
            $calendaryList = array();
            
            try {
                if($what) {
                    $query = "SELECT * FROM ".$this->tableName." INNER JOIN categories ON ".$this->tableName.".pfk_category_id = categories.category_id"." WHERE event_id = :id AND event_active = 1;";
                }
                else {
                    $query = "SELECT * FROM ".$this->tableName." INNER JOIN categories ON ".$this->tableName.".pfk_category_id = categories.category_id WHERE event_id = :id;";
                }

                $parameters["id"] = $id;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query, $parameters);
                
                foreach ($resultSet as $row) {                
                    $event = new Event();
                    $category = new Category();

                    $category->setId($row["category_id"]);
                    $category->setName($row["category_name"]);
                    $category->setActive($row["category_active"]);

                    $event->setId($row["event_id"]);
                    $event->setCategory($category);
                    $event->setTitle($row["event_title"]);
                    $event->setActive($row["event_active"]);
                    
                    $query1 = "SELECT * FROM calendaries 
                    INNER JOIN event_place ON calendaries.fk_eventplace_id = event_place.eventplace_id 
                    WHERE calendaries.fk_event_id = :id;";
                    
                    $parameters["id"] = $event->getId();

                    $this->connection = Connection::GetInstance();
                    $resultCalen = $this->connection->Execute($query1, $parameters); 

                    foreach ($resultCalen as $row) {
                        $calendary = new Calendary();
                        $eventPlace = new EventPlace();

                        $calendary->setId($row["calendary_id"]);
                        $calendary->setDate($row["calendary_date"]);
                        $calendary->setActive($row["calendary_active"]);

                        $calendary->setEvent($event);

                        $eventPlace->setId($row["eventplace_id"]);
                        $eventPlace->setSlots($row["eventplace_slots"]);
                        $eventPlace->setDesc($row["eventplace_desc"]);
                        $eventPlace->setActive($row["eventplace_active"]);
                        
                        $calendary->setEventPlace($eventPlace);

                        $query2 = "SELECT * FROM artists INNER JOIN calendary_by_artist ON calendary_by_artist.pfk_calendary_id = :id WHERE calendary_by_artist.pfk_artist_id = artists.artist_id;";

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

                        array_push($calendaryList,$calendary);
                    }
                }

                $event->setCalendaries($calendaryList);
            }
            catch(Exception $ex) {
                throw $ex;
            }
            finally {
                return $event;
            }
        }

        public function ChangeEventState($id) {
            try {
                $query = "UPDATE ".$this->tableName." SET event_active = NOT event_active WHERE event_id = :id;";

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