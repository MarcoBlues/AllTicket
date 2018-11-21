<?php
    namespace Controllers;

    use DAO\ArtistDAOPDO as ArtistDAOPDO;
    use Models\Artist as Artist;
    use Exception as Exception;

    class ArtistController {
        private $artistDAO;
        
        public function __construct() {
            $this->artistDAO = new ArtistDAOPDO();
        }
        
        public function ShowArtistView($message = "", $messageError = "") {
            try {
                if(!isset($_SESSION["client"])) {
                    require_once(VIEWS_PATH."login.php");
                }
                else {
                    $artistList = $this->artistDAO->GetAllArtist(0);
                    require_once(VIEWS_PATH."artist-view.php");
                }
            }
            catch(Exception $ex) {
                $message = "¡Error al mostrar los artistas!";
                $messageError = $ex->getMessage();

                $this->ShowArtistView($message, $messageError); 
            }
        }

        public function AddArtist($name = "", $lastName = "", $nickName = "") {
            try {
                if(!isset($_SESSION["client"])) {
                    require_once(VIEWS_PATH."login.php");
                }
                else {
                    if($name == '' || $lastName == '' || $nickName == '' || $name === NULL || $lastName === NULL || $nickName === NULL || is_numeric($name) || is_numeric($lastName)) {
                        $this->ShowArtistView("¡Completá todos los campos correctamente!");
                    }
                    else {
                        $artist = new Artist();

                        $artist->setName($name);
                        $artist->setLastName($lastName);
                        $artist->setNickName($nickName);

                        if($this->artistDAO->GetArtistByNickName($artist->getNickName(), 0) == NULL) {
                            $this->artistDAO->AddArtist($artist);
                            $message = "¡Artista agregado exitosamente!";
                        }
                        else {
                            $message = "¡Ya existe este artista en el sistema!";
                        }

                        $this->ShowArtistView($message); 
                    }
                }
            }
            catch(Exception $ex) 
            {
                
                $message = "¡Error al agregar el artista!";
                $messageError = $ex->getMessage();
                require_once(VIEWS_PATH."header.php");
                require_once(VIEWS_PATH."error-page.php");
            }
        }

        public function UpdateArtist($id = "", $name = "", $lastName = "", $nickName = "") {
            try {
                if(!isset($_SESSION["client"])) {
                    require_once(VIEWS_PATH."login.php");
                }
                else {
                    if($id == '' || $name == '' || $lastName == '' || $nickName == '' || $id === NULL || $name === NULL || $lastName === NULL || $nickName === NULL || !is_numeric($id) || is_numeric($name) || is_numeric($lastName) ) {
                        $this->ShowArtistView("¡Completá todos los campos correctamente!");
                    }
                    else {
                        $newArtist = new Artist();

                        $newArtist->setId($id);
                        $newArtist->setName($name);
                        $newArtist->setLastName($lastName);
                        $newArtist->setNickName($nickName);

                        if($this->artistDAO->CheckArtistById($id) == 1) {
                            $this->artistDAO->UpdateArtist($id, $newArtist);
                            $message = "¡Artista modificado exitosamente!";
                        }
                        else {
                            $message = "¡No se encontro el artista en el sistema!";
                        }

                        $this->ShowArtistView($message);  
                    }
                }
            }
            catch(Exception $ex) {
                $message = "¡Error al actualizar el artista!";
                $messageError = $ex->getMessage();

                $this->ShowArtistView($message, $messageError); 
            }
        }

        public function ChangeArtistState($id = "") {
            try {
                if(!isset($_SESSION["client"])) {
                    require_once(VIEWS_PATH."login.php");
                }
                else {
                    if($id == '' || !is_numeric($id) || $id === NULL) {
                        $this->ShowArtistView("¡Completá todos los campos correctamente!"); 
                    }
                    else {
                        if($this->artistDAO->CheckArtistById($id) == 1) {
                            $this->artistDAO->ChangeArtistState($id);
                            $message = "¡Se ha cambiado el estado del artista!";
                        }
                        else {
                            $message = "¡El artista no se encuentra en el sistema!";
                        }

                        $this->ShowArtistView($message);  
                    }
                }
            }
            catch(Exception $ex) {
                $message = "¡Error al cambiar el estado del artista!";
                $messageError = $ex->getMessage();

                $this->ShowArtistView($message, $messageError);  
            }
        }
    }
?>