<?php
    namespace DAO;

    use Models\BoughtLine as BoughtLine;
    use DAO\Connection as Connection;
    use DAO\DBException as DBException;

    class BoughtLineDAOPDO implements IBoughtLineDAO {
        private $connection;
        private $tableName = "bought_lines";

        public function AddBoughtLine(BoughtLine $boughtLine, $boughtId) {
            try {
                $query = "INSERT INTO ".$this->tableName." (boughtline_quantity, boughtline_price, pfk_ticket_id, fk_bought_id,boughtline_eventname) 
                VALUES (:quantity, :price, :ticket_id, :bought_id , :eventname)";
                
                $parameters["quantity"] = $boughtLine->getQuantity();
                $parameters["price"] = $boughtLine->getPrice();
                $parameters["ticket_id"] = $boughtLine->getTicket()->getId();
                $parameters["bought_id"] = $boughtId;
                $parameters["eventname"] = $boughtLine->getEventTitle();

                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch(Exception $ex) {
                throw $ex;
            }
        }
    }
?>