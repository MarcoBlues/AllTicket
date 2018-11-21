<?php
    namespace DAO;

    use Models\Bought as Bought;
    use Models\Client as Client;
    use Models\Ticket as Ticket;
    use Models\BoughtLine as BoughtLine;

    use DAO\Connection as Connection;
    use DAO\DBException as DBException;

    class BoughtDAOPDO  implements IBoughtDAO{
        private $connection;
        private $tableName = "boughts";

        public function AddBoughtClient($client) {
            try {
                $query = "INSERT INTO ".$this->tableName." (fk_client_id) VALUES (:id);";

                $parameters["id"] = $client->getId();
                
                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query, $parameters);

                return $this->connection->LastId();
            }
            catch(Exception $ex) {
                throw $ex;
            }
        }


        public function GetAllBought4Admin() {
            try {
                $query ="SELECT bought_lines.boughtline_quantity,
	                     bought_lines.boughtline_price,
                         bought_lines.boughtline_eventname,
                         clients.client_email,
                         boughts.bought_date 
                         FROM ". $this->tableName." 
                         INNER JOIN bought_lines ON boughts.bought_id = bought_lines.fk_bought_id
                         INNER JOIN clients ON boughts.fk_client_id = clients.client_id;";
                               
                $this->connection = Connection::GetInstance(); 
                $resultSet = $this->connection->Execute($query);
         
                $boughArray = array();

                foreach($resultSet as $row) {
                    $bough = new Bought();
                    $client = new Client();
                    $boughtLine = new BoughtLine();
                   
                    $client->setEmail($row["client_email"]);
                    $bough->setDate($row["bought_date"]);
                    $bough->setClient($client);
                    $boughtLine->setEventTitle($row["boughtline_eventname"]);   
                    $boughtLine->setQuantity($row["boughtline_quantity"]);
                    $boughtLine->setPrice($row["boughtline_price"]);
                   
                    $bough->pushBuyLine($boughtLine);
                    array_push($boughArray, $bough);
                }

                return $boughArray;
            }
            catch(Exception $ex) {
                throw $ex;
            }
        }

        public function GetBoughClientById($id) {
            $bough = new Bought();

            try {
                $query ="SELECT bought_date,
                                 boughtline_quantity,
                                 boughtline_price,
                                 boughtline_eventname,
                                 ticket_qr
                         FROM ". $this->tableName ."  
                         INNER JOIN bought_lines ON boughts.bought_id= bought_lines.fk_bought_id
                         INNER JOIN tickets ON tickets.ticket_id = bought_lines.pfk_ticket_id
                         WHERE boughts.fk_client_id = :id;";

                $parameters["id"] = $id;

                $this->connection = Connection::GetInstance(); 
                $resultSet = $this->connection->Execute($query, $parameters);

                $boughLineArray = array();
                
                
                foreach($resultSet as $row) {
               
                    $ticket = new Ticket();
                    $ticket->setQrCode($row["ticket_qr"]);

                    $boughtLine = new BoughtLine();
                    $boughtLine->setTicket($ticket);
                    $bough->setDate($row["bought_date"]);
                    $boughtLine->setEventTitle($row["boughtline_eventname"]);   
                    $boughtLine->setQuantity($row["boughtline_quantity"]);
                    $boughtLine->setPrice($row["boughtline_price"]);
                    

                    array_push($boughLineArray,$boughtLine);
                }

                $bough->setBuyLine($boughLineArray);
                return $bough;
            }
            catch(Exception $ex) {
                throw $ex;
            }
        }
    }
?>