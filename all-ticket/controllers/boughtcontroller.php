<?php
    namespace Controllers;

    use DAO\BoughtDAOPDO as BoughtDAOPDO;
    use DAO\BoughtLineDAOPDO as BoughtLineDAOPDO;
    use DAO\TicketDAOPDO as TicketDAOPDO;
    use DAO\EventDAOPDO as EventDAOPDO;
    use DAO\EventSquareDAOPDO as EventSquareDAOPDO;
    use DAO\CalendaryDAOPDO as CalendaryDAOPDO;
    
	require_once 'phpqrcode/qrlib.php';

    use Models\Bought as Bought;
    use Models\BoughtLine as BoughtLine;
    use Models\Ticket as Ticket;
    use Models\EventSquare as EventSquare;
    use Models\Event as Event;
    use Models\Client as Client;
    use Models\Calendary as Calendary;

    use Exception as Exception;

    class BoughtController {
        private $boughtDAO;
        private $boughtLineDAO;
        private $eventSquareDAO;
        private $ticketDAO;
        private $eventDAO;
        private $calendaryDAO;

        public function __construct() {
            $this->eventDAO = new EventDAOPDO();
            $this->boughtDAO = new BoughtDAOPDO();
            $this->boughtLineDAO = new BoughtLineDAOPDO();
            $this->ticketDAO = new TicketDAOPDO();
            $this->eventSquareDAO = new EventSquareDAOPDO();
            $this->calendaryDAO = new CalendaryDAOPDO();
        }

        public function ShowEventsAvailables() {
            try {
                if(!isset($_SESSION["client"])) {
                    require_once(VIEWS_PATH."login.php");
                }
                else {
                    $eventList = $this->eventDAO->GetAllEvents(1);
                    require_once(VIEWS_PATH."bought-view.php");
                }
            }
            catch(Exception $ex) {
                $message = "¡Error al mostrar los eventos disponibles!";
                $messageError = $ex->getMessage();

                
                require_once(VIEWS_PATH."header.php");
                require_once(VIEWS_PATH."error-page.php");
            }
        }

        public function ShowEventByCalendar($eventId) {
            try {
                if(!isset($_SESSION["client"])) {
                    require_once(VIEWS_PATH."login.php");
                }
                else {
                    $event = $this->eventDAO->GetEventById($eventId, 1);
                    require_once(VIEWS_PATH."bought-ticket-view.php");  
                }               
            }
            catch(Exception $ex) {
                $message = "¡Error al mostrar los calendarios disponibles del evento!";
                $messageError = $ex->getMessage();

                
                require_once(VIEWS_PATH."header.php");
                require_once(VIEWS_PATH."error-page.php");
            }
        }

        public function BuyEventPlaces($calendaryId) {
            try {
                if(!isset($_SESSION["client"])) {
                    require_once(VIEWS_PATH."login.php");
                }
                else {
                    $calendary = $this->calendaryDAO->GetCalendaryById4Buy($calendaryId);
                    require_once(VIEWS_PATH."bought-eventplaces.php"); 
                }
            }
            catch(Exception $ex) {
                $message = "¡Error al mostrar las entradas para comprar!";
                $messageError = $ex->getMessage();

                
                require_once(VIEWS_PATH."header.php");
                require_once(VIEWS_PATH."error-page.php");
            }
        }

        public function ShowBoughList()
        {   
            try {
                if(!isset($_SESSION["client"])) {
                    require_once(VIEWS_PATH."login.php");
                }
                else {
                    $boughtList = $this->boughtDAO->GetAllBought4Admin();
                    require_once(VIEWS_PATH."costumers-shopping.php");
                }
            }
            catch(Exception $ex) {
                $message = "¡Error al mostrar la lista de las compras";
                $messageError = $ex->getMessage();

                
                require_once(VIEWS_PATH."header.php");
                require_once(VIEWS_PATH."error-page.php");
            }
        }


        public function DeleteFromMyCart($position) {
            try {
            if(!isset($_SESSION["client"])) {
                require_once(VIEWS_PATH."login.php");
            }
            else {
                $boughtList = $_SESSION["cart"];
            
                unset($boughtList[$position]);
                array_values($boughtList);
            
                $_SESSION["cart"] = $boughtList;

                $this->MyVirtualCart();
            }
            }
            catch(Exception $ex) {
                $message = "¡Error al eliminar tu carrito de compras";
                $messageError = $ex->getMessage();

                require_once(VIEWS_PATH."header.php");
                require_once(VIEWS_PATH."error-page.php");

            }
        }

        public function MyVirtualCart() {
            try {
                if(!isset($_SESSION["client"])) {
                    require_once(VIEWS_PATH."login.php");
                }
                else {
                    if(isset($_SESSION["cart"]))
                        $boughtList = $_SESSION["cart"];
         
                    $client = $_SESSION["client"];
            
                    $purchaseList = $this->boughtDAO->GetBoughClientById($client->getId());
        
                    require_once(VIEWS_PATH."virtual-cart.php");
                }
            }
            catch(Exception $ex) {
                $message = "¡Error al mostrar tu carrito de compras";
                $messageError = $ex->getMessage();

                require_once(VIEWS_PATH."header.php");
                require_once(VIEWS_PATH."error-page.php");
                
            }
       
        }

     

        public function AddCart($arrayBought, $idCalendary) {
            try {
                if(!isset($_SESSION["client"])) {
                    require_once(VIEWS_PATH."login.php");
                }
                else {
                    if(!isset($_SESSION["cart"]))
                        $arrayBoughline = array();
                    else
                        $arrayBoughline = $_SESSION["cart"];

                    $title = $this->calendaryDAO->GetEventTitleByCalendaryId($idCalendary);
                    
                    foreach($arrayBought as $bought) {
                        $boughtLine = new BoughtLine();
                        
                        if($bought[0] != "" && $bought[1] != "") {
                            $eventSquare = new EventSquare();
                            $eventSquare = $this->eventSquareDAO->GetEventSquareById($bought[1]);
                            $boughtLine->setQuantity($bought[0]);
                            $boughtLine->setEventSquare($eventSquare);
                            $boughtLine->setEventTitle($title);

                            if($boughtLine->getQuantity() > 5) { 
                                $boughtLine->setPrice(($eventSquare->getPrice() * $boughtLine->getQuantity() * REMISE));
                            }
                            else {
                                $boughtLine->setPrice(($eventSquare->getPrice() * $boughtLine->getQuantity()));
                            }

                            array_push($arrayBoughline,$boughtLine);
                        }
                    }
            
                    $_SESSION["cart"] = $arrayBoughline;
                
                    $this->MyVirtualCart();
                }
            }
            catch(Exception $ex) {
                $message = "¡Error al agregar al carrito!";
                $messageError = $ex->getMessage();

               
                require_once(VIEWS_PATH."header.php");
                require_once(VIEWS_PATH."error-page.php");
            }
        }

        public function BuyTickets() {
            try {
                if(!isset($_SESSION["client"])) {
                    require_once(VIEWS_PATH."login.php");
                }
                else {
                   
                    $client = $_SESSION['client'];
                    $boughtList = $_SESSION['cart'];

                    $boughtId = $this->boughtDAO->AddBoughtClient($client);

                    foreach($boughtList as $key => $bought) {
                       $this->eventSquareDAO->UpdateEventSquareRemainings($bought->getEventSquare()->getId(), $bought->getQuantity());

                        $content = "Cliente: #".$client->getId().
                        "\Usuario: ".$client->getUserName().
                        "\nEvento: ".$bought->getEventTitle().
                        "\nFecha: ". $this->eventSquareDAO->GetDateByEventSquareId($bought->getEventSquare()->getId()) .
                        "\nPlaza: ".$bought->getEventSquare()->getEventype()->getDesc().
                        "\nCantidad: ".$bought->getQuantity() .
                        "\n";

                        
                        \QRcode::png($content, "codigoqr.png", QR_ECLEVEL_H, 10, 1);

                        $fp = fopen("codigoqr.png", 'r+b');
                        $data = fread($fp, filesize("codigoqr.png"));
                        fclose($fp);
                
                        $ticketId = $this->ticketDAO->Add($data);

                        $ticket = new Ticket();
                
                        $ticket->setId($ticketId);
                
                        $bought->setTicket($ticket);

                        $this->boughtLineDAO->AddBoughtLine($bought, $boughtId);
                    }

                    unset($_SESSION["cart"]);
                    $this->MyVirtualCart();
                }
            }
            catch(Exception $ex) {
                $message = "¡Error al crear el ticket!";
                $messageError = $ex->getMessage();

                
                require_once(VIEWS_PATH."header.php");
                require_once(VIEWS_PATH."error-page.php");
            }
        }
    }
?>