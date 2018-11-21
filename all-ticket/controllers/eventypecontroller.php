<?php
    namespace Controllers;

    use DAO\EventypeDAOPDO as EventypeDAOPDO;
    use Models\Eventype as Eventype;
    use Exception as Exception;

    class EventypeController {
        private $eventTypeDAO;
        
        public function __construct() { 
            $this->eventTypeDAO = new EventypeDAOPDO();
        }

        public function ShowEventTypeView($message = "", $messageError = "") {
            try {
                if(!isset($_SESSION["client"])) {
                    require_once(VIEWS_PATH."login.php");
                }
                else {
                    $eventTypeList = $this->eventTypeDAO->GetAllEventypes(0);
                    require_once(VIEWS_PATH."eventype-view.php");     
                }
            }
            catch(Exception $ex) {
                $message = "¡Error al mostrar el tipo de evento!";
                $messageError = $ex->getMessage();

                $this->ShowEventTypeView($message, $messageError); 
            }
        }

        public function AddEventype($desc = "") {
            try {
                if(!isset($_SESSION["client"])) {
                    require_once(VIEWS_PATH."login.php");
                }
                else {
                    if($desc == '' || $desc === NULL || is_numeric($desc)) {
                        $this->ShowEventTypeView("¡Completá todos los campos correctamente!");
                    }
                    else {
                        $eventType = new Eventype();
                        $eventType->setDesc($desc);

                        if($this->eventTypeDAO->GetEventTypeByDesc($eventType->getDesc(), 0) == NULL) {
                            $this->eventTypeDAO->AddEventype($eventType);
                            $message = "¡Tipo de evento agregado exitosamente!";
                        }
                        else {
                            $message = "¡Ya existe este tipo de evento en el sistema!";
                        }   

                        $this->ShowEventTypeView($message);
                    }
                }
            }
            catch(Exception $ex) {
                $message = "¡Error al agregar el tipo de evento!";
                $messageError = $ex->getMessage();

                $this->ShowEventTypeView($message, $messageError); 
            }       
        }

        public function UpdateEventype($id = "", $desc = "") {
            try {
                if(!isset($_SESSION["client"])) {
                    require_once(VIEWS_PATH."login.php");
                }
                else {
                    if($id == '' || $desc == '' || $id === NULL || $desc === NULL || !is_numeric($id) || is_numeric($desc)) {
                        $this->ShowEventTypeView("¡Completá todos los campos correctamente!");
                    }
                    else {
                        $newEventype = new Eventype();

                        $newEventype->setId($id);
                        $newEventype->setDesc($desc);

                        if($this->eventTypeDAO->CheckEventypeById($id) == 1) {
                            $this->eventTypeDAO->UpdateEventype($id, $newEventype);
                            $message = "¡Tipo de evento modificado exitosamente!";
                        }
                        else {
                            $message = "¡No se encontro el tipo de evento en el sistema!";
                        }

                        $this->ShowEventTypeView($message);
                    }
                }
            }
            catch(Exception $ex) {
                $message = "¡Error al actualizar el tipo de evento!";
                $messageError = $ex->getMessage();

                $this->ShowEventTypeView($message, $messageError); 
            }
        }

        public function ChangeStateEventype($id = "") {
            try {
                if(!isset($_SESSION["client"])) {
                    require_once(VIEWS_PATH."login.php");
                }
                else {
                    if($id == '' || !is_numeric($id) || $id === NULL) {
                        $this->ShowEventTypeView("¡Completá todos los campos correctamente!"); 
                    }
                    else {
                        if($this->eventTypeDAO->CheckEventypeById($id) == 1) {
                            $this->eventTypeDAO->ChangeStateEventype($id);
                            $message = "¡Se ha cambiado el estado del tipo de evento!";
                        }
                        else {
                            $message = "¡El tipo de evento no se encuentra en el sistema!";
                        }

                        $this->ShowEventTypeView($message);
                    }
                }                
            }
            catch(Exception $ex) {
                $message = "¡Error al cambiar el estado del tipo de evento!";
                $messageError = $ex->getMessage();

                $this->ShowEventTypeView($message, $messageError);  
            }
        }
    }
?>