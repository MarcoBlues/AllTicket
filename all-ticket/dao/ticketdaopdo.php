<?php
    namespace DAO;

    use Models\Ticket as Ticket;
    use DAO\Connection as Connection;
    use DAO\DBException as DBException;

    class TicketDAOPDO implements ITicketDAO
    {
        private $connection;
        private $tableName = "tickets";
        private $message = ".Contacte a su administrador";

        public function Add($data)
        {
            try
            {
                $query = "INSERT INTO ".$this->tableName." (ticket_qr) VALUES (:data);";
                
                //$parameters["id"] = $artist->getId();
                $parameters["data"] = $data;

                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query, $parameters);

                return $this->connection->LastId();
            }
            catch(DBException $e)
            {
                throw new DBException("Error en la inserción de un artista". $message,$e->getCode());
            }
        }

        /*
        public function Get()
        {
            $query = "SELECT * FROM ".$this->tableName." WHERE ticket_id=1;";

            $this->connection = Connection::GetInstance();
            $resultSet = $this->connection->Execute($query);

            foreach($resultSet as $row)
            {
                //$image = $row['ticket_qr'];

                echo '<img src="data:image/jpeg;base64,'.base64_encode( $row['ticket_qr'] ).'"/>';
            }
        }*/
    }
?>