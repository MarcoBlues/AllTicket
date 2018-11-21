<?php
    namespace Controllers;

    use DAO\EventPlaceDAOPDO as EventPlaceDAOPDO;
    use Models\EventPlace as EventPlace;
    use Exception as Exception;

    class EventPlaceController {
        private $eventPlaceDAO;
        
        public function __construct() { 
            $this->eventPlaceDAO = new EventPlaceDAOPDO();
        }

        public function ShowEventPlaceView($message = "", $messageError = "") {
            try {
                if(!isset($_SESSION["client"])) {
                    require_once(VIEWS_PATH."login.php");
                }
                else {
                    $eventPlaceList = $this->eventPlaceDAO->GetAllEventPlaces(0);
                    require_once(VIEWS_PATH."eventplace-view.php");
                }
            }
            catch(Exception $ex) {
                $message = "¡Error al mostrar los lugares de eventos!";
                $messageError = $ex->getMessage();

                $this->ShowEventPlaceView($message, $messageError); 
            }
        }

        public function AddEventPlace($desc = "", $slots = "") {
            try {
                if(!isset($_SESSION["client"])) {
                    require_once(VIEWS_PATH."login.php");
                }
                else {
                    if($desc == '' || $slots == '' || $desc === NULL || $slots === NULL || is_numeric($desc) || !is_numeric($slots)) {
                        $this->ShowEventPlaceView("¡Completá todos los campos correctamente!");
                    }
                    else {
                        $eventPlace = new EventPlace();

                        $eventPlace->setDesc($desc);
                        $eventPlace->setSlots($slots);

                        if($this->eventPlaceDAO->GetEventPlaceByDesc($eventPlace->getDesc(),0) == null) {
                            $this->eventPlaceDAO->AddEventplace($eventPlace);
                            $message = "¡Lugar de evento agregado exitosamente!";
                        }
                        else {
                            $message = "¡Error! Ya existe el lugar de evento en el sistema";
                        }

                        $this->ShowEventPlaceView($message);
                    }
                }
            }
            catch(Exception $ex) {
                $message = "¡Error al agregar el lugar de evento!";
                $messageError = $ex->getMessage();

                $this->ShowEventPlaceView($message, $messageError); 
            }
        }

        public function UpdateEventPlace($id = "", $slots = "", $desc = "") {
            try {
                if(!isset($_SESSION["client"])) {
                    require_once(VIEWS_PATH."login.php");
                }
                else {
                    if($id == '' || $slots == '' || $desc == '' || $id === NULL || $slots === NULL || $desc === NULL || !is_numeric($id) || !is_numeric($slots) || is_numeric($desc)) {
                        $this->ShowEventPlaceView("¡Completá todos los campos correctamente!");
                    }
                    else {
                        $newEventPlace = new EventPlace();

                        $newEventPlace->setId($id);
                        $newEventPlace->setSlots($slots);
                        $newEventPlace->setDesc($desc);

                        if($this->eventPlaceDAO->CheckEventPlaceById($id) == 1) {
                            $this->eventPlaceDAO->UpdateEventPlace($id, $newEventPlace);
                            $message = "¡Lugar de evento modificado exitosamente!";
                        }
                        else {
                            $message = "¡No se encontro el lugar de evento en el sistema!";
                        }

                        $this->ShowEventPlaceView($message);
                    }
                }
            }
            catch(Exception $ex) {
                $message = "¡Error al actualizar el lugar de evento!";
                $messageError = $ex->getMessage();

                $this->ShowEventPlaceView($message, $messageError); 
            }
        }

        public function ChangeEventPlaceState($id = "") {
            try {
                if(!isset($_SESSION["client"])) {
                    require_once(VIEWS_PATH."login.php");
                }
                else {
                    if($id == '' || !is_numeric($id) || $id === NULL) {
                        $this->ShowEventPlaceView("¡Completá todos los campos correctamente!"); 
                    }
                    else {
                        if($this->eventPlaceDAO->CheckEventPlaceById($id) == 1) {
                            $this->eventPlaceDAO->ChangeEventPlaceState($id);
                            $message = "¡Se ha cambiado el estado del lugar de evento!";
                        }
                        else {
                            $message = "¡El lugar de evento no se encuentra en el sistema!";
                        }

                        $this->ShowEventPlaceView($message);
                    }
                }
            }
            catch(Exception $ex) {
                $message = "¡Error al cambiar el estado del lugar de evento!";
                $messageError = $ex->getMessage();

                $this->ShowEventPlaceView($message, $messageError);  
            }
        }
    }
?>