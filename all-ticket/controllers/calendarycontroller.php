<?php
    namespace Controllers;

    use DAO\CalendaryDAOPDO as CalendaryDAOPDO;
    use DAO\ArtistDAOPDO as ArtistDAOPDO;
    use DAO\EventPlaceDAOPDO as EventPlaceDAOPDO;
    use DAO\EventypeDAOPDO as EventypeDAOPDO;
    use DAO\EventDAOPDO as EventDAOPDO;
    use DAO\EventSquareDAOPDO as EventSquareDAOPDO;

    use Models\Event as Event;
    use Models\Artist as Artist;
    use Models\EventPlace as EventPlace;
    use Models\EventSquare as EventSquare;
    use Models\Calendary as Calendary;

    use Exception as Exception;

    class CalendaryController {
        private $calendaryDAO;
        private $artistDAO;
        private $eventDAO;
        private $eventPlaceDAO;
        private $eventSquareDAO;
        private $eventTypeList;
        
        public function __construct() { 
            $this->calendaryDAO = new CalendaryDAOPDO();
            $this->artistDAO = new ArtistDAOPDO();
            $this->eventDAO = new EventDAOPDO();
            $this->eventPlaceDAO = new EventPlaceDAOPDO();
            $this->eventTypeDAO = new EventypeDAOPDO();
            $this->eventSquareDAO = new EventSquareDAOPDO();
        }

        public function ShowCalendaryView($message = "", $messageError = "") {
            try {
                if(!isset($_SESSION["client"])) {
                    require_once(VIEWS_PATH."login.php");
                }
                else {
                    $calendarList = $this->calendaryDAO->GetAllCalendaries(1); 
                    $eventList = $this->eventDAO->GetAllEvents(1);
                    $eventPlaceList = $this->eventPlaceDAO->GetAllEventplaces(1);
                    $artistList = $this->artistDAO->GetAllArtist(1);
                    $eventTypeList = $this->eventTypeDAO->GetAllEventypes(1);

                    require_once(VIEWS_PATH."calendary-view.php");
                }
            }
            catch(Exception $ex) {
                $message = "¡Error al mostrar los calendarios!";
                $messageError = $ex->getMessage();

                $this->ShowCalendaryView($message, $messageError); 
            }
        }

        public function AddCalendary($date = "", $eventId = "", $eventPlaceId = "", $horary = "", $eventTypeInfo = "", $artistListId = "") {
            try {
                if(!isset($_SESSION["client"])) {
                    require_once(VIEWS_PATH."login.php");
                }
                else {
                    if($date == '' || $eventId == '' || $eventPlaceId == '' || $horary == '' || $eventTypeInfo == '' || $artistListId == '' || $date === NULL || $eventId === NULL || $eventPlaceId === NULL || $horary === NULL || $eventTypeInfo === NULL || $artistListId === NULL) {
                            $this->ShowCalendaryView("¡Completá todos los campos correctamente!");
                    }
                    else {
                        if(!empty($artistListId)) {
                            if($this->CheckCalendarySlots($eventPlaceId, $eventTypeInfo) == 0) {
                                if($this->calendaryDAO->GetCalendaryByCreated($horary, $eventPlaceId, $date) == 0) {
                                    $calendary = new Calendary();
                                    $calendary->setDate($date);
                                    $calendary->setEvent($this->eventDAO->GetEventById($eventId, 1));
                                    $calendary->setEventPlace($this->eventPlaceDAO->GetEventPlaceById($eventPlaceId, 1));

                                    $artistList = array();
                                    $eventSquareList = array();
                                
                                    $artistAux = array();

                                    foreach($artistListId as $id) {
                                        if($id != NULL) {
                                            $calendary->pushArtist($this->artistDAO->GetArtistById($id, 1));
                                        }
                                    }

                                    $calendary = $this->calendaryDAO->AddCalendary($calendary, $horary);

                                    $max = 0;

                                    for($i = 0; $i < count($eventTypeInfo); $i++) {
                                        if($eventTypeInfo[$i][0] != "" && $eventTypeInfo[$i][1] != "") {
                                            $eventSquare = new EventSquare();

                                            $eventSquare->setRemainings($eventTypeInfo[$i][0]);
                                            $eventSquare->setAvaiables($eventTypeInfo[$i][0]);
                                            $eventSquare->setPrice($eventTypeInfo[$i][1]);
                                            $eventSquare->setEventype($this->eventTypeDAO->GetEventTypeById($eventTypeInfo[$i][2], 1));

                                            $this->eventSquareDAO->AddEventsquare($eventSquare, $calendary->getId());
                                        }
                                    }

                                    $message = "¡Calendario creado exitosamente!";
                                }
                                else {
                                    $message = "¡Horario no disponible!";
                                }
                            }
                            else {
                                $message = "¡En lugar no cuenta con suficientes lugares!";
                            }
                        }
                        else {
                            $message = "¡No hay artistas cargados!";
                        }

                        $this->ShowCalendaryView($message);
                    }
                }
            }
            catch(Exception $ex) {
                $message = "¡Error al agregar el calendario!";
                $messageError = $ex->getMessage();

                $this->ShowCalendaryView($message, $messageError); 
            }
        }

        public function CheckCalendarySlots($id = "", $eventypes = "") {
            if(!isset($_SESSION["client"])) {
                require_once(VIEWS_PATH."login.php");
            }
            else {
                $eventPlace = $this->eventPlaceDAO->GetEventPlaceById($id, 1);

                $total = 0;

                for($i = 0; $i < count($eventypes); $i++) {
                    if($eventypes[$i][0] != "" && $eventypes[$i][1] != "") {
                        $total += $eventypes[$i][0];
                    }
                }

                return ($total > $eventPlace->getSlots()) ? 1 : 0; 
            }
        }

        public function UpdateCalendary($id = "", $date = "") {
            try {
                if(!isset($_SESSION["client"])) {
                    require_once(VIEWS_PATH."login.php");
                }
                else {
                    if($id == '' || $date == '' || $id === NULL || $date === NULL) {
                        $this->ShowCalendaryView("¡Completá todos los campos correctamente!");
                    }
                    else {
                        $newCalendary = new Calendary();

                        $newCalendary->setId($id);
                        $newCalendary->setDate($date);


                        if($this->calendaryDAO->CheckCalendaryById($id) == 1) {
                            $this->calendaryDAO->UpdateCalendary($id, $newCalendary);
                            $message = "¡Calendario modificado exitosamente!";
                        }
                        else {
                            $message = "¡No se encontro el calendario en el sistema!";
                        }

                        $this->ShowCalendaryView($message);
                    }
                }
            }
            catch(Exception $ex) {
                $message = "¡Error al actualizar el calendario!";
                $messageError = $ex->getMessage();

                $this->ShowCalendaryView($message, $messageError); 
            }
        }

        public function ChangeCalendaryState($id) {
            try {
                if(!isset($_SESSION["client"])) {
                    require_once(VIEWS_PATH."login.php");
                }
                else {
                    if($id == '' || !is_numeric($id) || $id === NULL) {
                        $this->ShowCalendaryView("¡Completá todos los campos correctamente!"); 
                    }
                    else {
                        if($this->calendaryDAO->CheckCalendaryById($id) == 1) {
                            $this->calendaryDAO->ChangeCalendaryState($id);
                            $message = "¡Se ha cambiado el estado del calendario!";
                        }
                        else {
                            $message = "¡El calendario no se encuentra en el sistema!";
                        }

                        $this->ShowCalendaryView($message);
                    }
                }
            }
            catch(Exception $ex) {
                $message = "¡Error al cambiar el estado del calendario!";
                $messageError = $ex->getMessage();

                $this->ShowCalendaryView($message, $messageError);  
            }
        }
    }
?>