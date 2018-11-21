<?php
    namespace Controllers;

    use DAO\CategoryDAOPDO as CategoryDAOPDO;
    use Models\Category as Category;
    use Exception as Exception;

    class CategoryController {
        private $categoryDAO;
        
        public function __construct() { 
            $this->categoryDAO = new CategoryDAOPDO();
        }

        public function ShowCategoryView($message = "", $messageError = "") {
            try {
                if(!isset($_SESSION["client"])) {
                    require_once(VIEWS_PATH."login.php");
                }
                else {
                    $categoryList = $this->categoryDAO->GetAllCategories(0);
                    require_once(VIEWS_PATH."category-view.php");  
                }
            }
            catch(Exception $ex) {
                $message = "¡Error al mostrar las categorias!";
                $messageError = $ex->getMessage();

                $this->ShowCategoryView($message, $messageError); 
            }
        }

        public function AddCategory($categoryName = "") {
            try {
                if(!isset($_SESSION["client"])) {
                    require_once(VIEWS_PATH."login.php");
                }
                else {
                    if($categoryName == '' || $categoryName === NULL || is_numeric($categoryName)) {
                        $this->ShowCategoryView("¡Completá todos los campos correctamente!");
                    }
                    else {
                        $category = new Category();
                        $category->setName($categoryName);
                
                        if($this->categoryDAO->GetCategoryByName($category->getName(), 0) == null) {
                            $this->categoryDAO->AddCategory($category);
                            $message = "¡Categoria agregada exitosamente!";
                        }
                        else {
                            $message = "¡Ya existe esta categoria en el sistema!";
                        }

                        $this->ShowCategoryView($message);
                    }
                }
            }
            catch(Exception $ex) {
                $message = "¡Error al agregar la categoria!";
                $messageError = $ex->getMessage();

                $this->ShowCategoryView($message, $messageError); 
            }
        }

        public function UpdateCategory($id = "", $desc = "") {
            try {
                if(!isset($_SESSION["client"])) {
                    require_once(VIEWS_PATH."login.php");
                }
                else {
                    if($id == '' || $desc == '' || $id === NULL || $desc === NULL || !is_numeric($id) || is_numeric($desc)) {
                        $this->ShowCategoryView("¡Completá todos los campos correctamente!");
                    }
                    else {
                        $newCategory = new Category();

                        $newCategory->setId($id);
                        $newCategory->setName($desc);

                        if($this->categoryDAO->CheckCategoryById($id) == 1) {
                            $this->categoryDAO->UpdateCategory($id, $newCategory);
                            $message = "¡Categoria modificado exitosamente!";
                        }
                        else {
                            $message = "¡No se encontro la categoria en el sistema!";
                        }

                        $this->ShowCategoryView($message);
                    }
                }
            }
            catch(Exception $ex) {
                $message = "¡Error al actualizar la categoria!";
                $messageError = $ex->getMessage();

                $this->ShowCategoryView($message, $messageError); 
            }
        }

        public function ChangeCategoryState($id = "") {
            try {
                if(!isset($_SESSION["client"])) {
                    require_once(VIEWS_PATH."login.php");
                }
                else {
                    if($id == '' || !is_numeric($id) || $id === NULL) {
                        $this->ShowCategoryView("¡Completá todos los campos correctamente!"); 
                    }
                    else {
                        if($this->categoryDAO->CheckCategoryById($id) == 1) {
                            $this->categoryDAO->ChangeCategoryState($id);
                            $message = "¡Se ha cambiado el estado de la categoria!";
                        }
                        else {
                            $message = "¡La categoria no se encuentra en el sistema!";
                        }

                        $this->ShowCategoryView($message);
                    }
                }
            }
            catch(Exception $ex) {
                $message = "¡Error al cambiar el estado de la categoria!";
                $messageError = $ex->getMessage();

                $this->ShowArtistView($message, $messageError);  
            }
        }
    }
?>