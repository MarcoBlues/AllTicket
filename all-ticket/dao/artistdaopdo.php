<?php
    namespace DAO;

    use Models\Artist as Artist;
    use DAO\Connection as Connection;
    use DAO\DBException as DBException;

    class ArtistDAOPDO implements IArtistDAO {
        private $connection;
        private $tableName = "artists";

        public function AddArtist(Artist $artist) {
            try {
                $query = "INSERT INTO ".$this->tableName." (artist_name, artist_lastname, artist_nickname) VALUES (:name, :lastName, :nickName);";

                $parameters["name"] = $artist->getName();
                $parameters["lastName"] = $artist->getLastName();
                $parameters["nickName"] = $artist->getNickName();

                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query, $parameters);
            
             }
             catch(Exception $ex) {
                throw new \Exception("PUTA MADRE TODO SE ROMPIO");
            }
        }

        public function UpdateArtist($id, Artist $newArtist) {
            try {
                $query = "UPDATE ".$this->tableName." SET artist_name = :name, artist_lastname = :lastName, artist_nickname = :nickName WHERE artist_id=:id;";

                $parameters["name"] = $newArtist->getName();
                $parameters["lastName"] = $newArtist->getLastName();
                $parameters["nickName"] = $newArtist->getNickName();
                $parameters["id"] = $id;

                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch(Exception $ex) {
                throw $ex;
            }
        }

        public function GetAllArtist($what) {
            $artistList = array();

            try {
                if($what) {
                    $query = "SELECT * FROM ".$this->tableName." WHERE artist_active = 1;";
                }
                else {
                    $query = "SELECT * FROM ".$this->tableName;
                }

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                
                foreach ($resultSet as $row) {
                    $artist = new Artist();

                    $artist->setId($row["artist_id"]);
                    $artist->setName($row["artist_name"]);
                    $artist->setLastName($row["artist_lastname"]);
                    $artist->setNickName($row["artist_nickname"]);
                    $artist->setActive($row["artist_active"]);

		        	array_push($artistList, $artist);                
                }
            }
            catch(Exception $ex) {
                throw $ex;
            }
            finally {
                return $artistList;
            }
        }

        public function CheckArtistById($id) {
            try {
                $query = "SELECT * FROM ".$this->tableName.
                " WHERE artist_id = :id";

                $parameters["id"] = $id;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query, $parameters);

                return $resultSet ? 1 : 0;
            }
            catch(Exception $ex) {
                throw $ex;
            }
        }

        public function GetArtistById($id, $what) {
            $artist = null;

            try {
                if($what) {
                    $query = "SELECT * FROM ".$this->tableName." WHERE artist_id = :id AND artist_active = 1;";
                }
                else {
                    $query = "SELECT * FROM ".$this->tableName." WHERE artist_id = :id;";
                }

                $parameters["id"] = $id;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query, $parameters);
            
                foreach ($resultSet as $row) {
                    $artist = new Artist();

                    $artist->setId($row["artist_id"]);
                    $artist->setName($row["artist_name"]);
                    $artist->setLastName($row["artist_lastname"]);
                    $artist->setNickName($row["artist_nickname"]);
                    $artist->setActive($row["artist_active"]);
                }
            }
            catch(Exception $ex) {
                throw $ex;
            }
            finally {
                return $artist;
            }
        }

        public function GetArtistByNickName($nickName, $what) {
            $artist = null;

            try {
                if($what) {
                    $query = "SELECT * FROM ".$this->tableName." WHERE artist_nickname = :nickName AND artist_active = 1;";
                }
                else {
                    $query = "SELECT * FROM ".$this->tableName." WHERE artist_nickname = :nickName;";
                }

                $parameters["nickName"] = $nickName;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query, $parameters);

                foreach ($resultSet as $row) {
                    $artist = new Artist();

                    $artist->setId($row["artist_id"]);
                    $artist->setName($row["artist_name"]);
                    $artist->setLastName($row["artist_lastname"]);
                    $artist->setNickName($row["artist_nickname"]);
                    $artist->setActive($row["artist_active"]);
                }
            }
            catch(Exception $ex) {
                throw $ex;
            }
            finally {
                return $artist;
            }
        }

        public function ChangeArtistState($id) {
            try {
                $query = "UPDATE ".$this->tableName." SET artist_active = NOT artist_active WHERE artist_id = :id;";

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