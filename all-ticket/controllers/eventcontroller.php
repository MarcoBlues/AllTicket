<?php
    namespace Controllers;

    use DAO\EventDAOPDO as EventDAOPDO;
    use DAO\CategoryDAOPDO as CategoryDAOPDO;
    use Models\Event as Event;
    use Models\Category as Category;
    use Exception as Exception;

    class EventController {
        private $eventDAO;
        private $categoryDAO;
        
        public function __construct() { 
            $this->eventDAO = new EventDAOPDO();
            $this->categoryDAO = new CategoryDAOPDO();
        }

        public function ShowEventView($message = "", $messageError = "") {
            try {
                if(!isset($_SESSION["client"])) {
                    require_once(VIEWS_PATH."login.php");
                }
                else {
                    $eventList = $this->eventDAO->GetAllEvents(0);
                    $categoryList = $this->categoryDAO->GetAllCategories(0);

                    require_once(VIEWS_PATH."event-view.php");
                }
            }
            catch(Exception $ex) {
                $message = "¡Error al mostrar los eventos!";
                $messageError = $ex->getMessage();

                $this->ShowEventView($message, $messageError); 
            }
        }

        public function AddEvent($title = "", $categoryId = "") {
            try {
                if(!isset($_SESSION["client"])) {
                    require_once(VIEWS_PATH."login.php");
                }
                else {
                    if($title == '' || $categoryId == '' || $title === NULL || $categoryId === NULL || is_numeric($title) || !is_numeric($categoryId)) {
                        $this->ShowEventView("¡Completá todos los campos correctamente!");
                    }
                    else {
                        $event = new Event();

                        $category = $this->categoryDAO->GetCategoryById($categoryId, 1);

                        $event->setTitle($title);
                        $event->setCategory($category);

                        if($this->eventDAO->GetEventByTitle($event->getTitle(), 1) == null) {
                            $this->eventDAO->AddEvent($event);
                            $message = "¡Evento creado exitosamente!";
                        }
                        else {
                            $message = "¡Ya existe este evento en el sistema!";
                        }   

                        $this->ShowEventView($message); 
                    }
                }
            }
            catch(Exception $ex) {
                $message = "¡Error al agregar el evento!";
                $messageError = $ex->getMessage();

                $this->ShowEventView($message, $messageError); 
            }
        }

        public function UpdateEvent($id = "", $title = "", $categoryId = "") {
            try {
                if(!isset($_SESSION["client"])) {
                    require_once(VIEWS_PATH."login.php");
                }
                else {
                    if($id == '' || $title == '' || $categoryId == '' || $id === NULL || $title === NULL || $categoryId === NULL || !is_numeric($id) || is_numeric($title) || !is_numeric($categoryId)) {
                        $this->ShowEventView("¡Completá todos los campos correctamente!");
                    }
                    else {
                        $newEvent = new Event();

                        $newEvent->setId($id);
                        $newEvent->setTitle($title);

                        if($this->eventDAO->CheckEventById($id) == 1) {
                            $this->eventDAO->UpdateEvent($newEvent->getId(), $newEvent, $categoryId);
                            $message = "¡Evento modificado exitosamente!";
                        }
                        else {
                            $message = "¡No se encontro el evento en el sistema!";
                        }

                        $this->ShowEventView($message);
                    }
                }
            }
            catch(Exception $ex) {
                $message = "¡Error al actualizar el evento!";
                $messageError = $ex->getMessage();

                $this->ShowEventView($message, $messageError); 
            }
        }

        public function ChangeEventState($id = "") {
            try {
                if(!isset($_SESSION["client"])) {
                    require_once(VIEWS_PATH."login.php");
                }
                else {
                    if($id == '' || !is_numeric($id) || $id === NULL) {
                        $this->ShowArtistView("¡Completá todos los campos correctamente!"); 
                    }
                    else {
                        if($this->eventDAO->CheckEventById($id) == 1) {
                            $this->eventDAO->ChangeEventState($id);
                            $message = "¡Se ha cambiado el estado del evento!";
                        }
                        else {
                            $message = "¡El evento no se encuentra en el sistema!";
                        }

                        $this->ShowEventView($message);
                    }
                }
            }
            catch(Exception $ex) {
                $message = "¡Error al cambiar el estado del evento!";
                $messageError = $ex->getMessage();

                $this->ShowEventView($message, $messageError);  
            }
        }
    }
?>