<?php
    namespace DAO;

    use Models\Category as Category;
    use DAO\Connection as Connection;
    use DAO\DBException as DBException;

    class CategoryDAOPDO implements ICategoryDAO {
        private $connection;
        private $tableName = "categories";

        public function AddCategory(Category $category) {
            try {
                $query = "INSERT INTO ".$this->tableName." (category_name) VALUES (:name);";
                
                $parameters["name"] = $category->getName();

                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch(Exception $ex) {
                throw $ex;
            }
        }
        
        public function GetAllCategories($what) {
            $categoryList = array();

            try {
                if($what) {
                    $query = "SELECT * FROM ".$this->tableName." WHERE category_active=1;";
                }
                else {
                    $query = "SELECT * FROM ".$this->tableName;
                }              

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query);
                
                foreach ($resultSet as $row) {                
                    $category = new Category();

                    $category->setId($row["category_id"]);
                    $category->setName($row["category_name"]);
                    $category->setActive($row["category_active"]);

			        array_push($categoryList, $category);
                }
            }
            catch(Exception $ex) {
                throw $ex;
            }
            finally {
                return $categoryList;
            }
        }

        public function CheckCategoryById($id) {
            try {
                $query = "SELECT * FROM ".$this->tableName.
                " WHERE category_id = :id";

                $parameters["id"] = $id;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query, $parameters);

                return $resultSet ? 1 : 0;
            }
            catch(Exception $ex) {
                throw $ex;
            }
        }

        public function UpdateCategory($id, Category $newCategory) {
            try {
                $query = "UPDATE ".$this->tableName." SET category_name = :name WHERE category_id=:id;";

                $parameters["name"] = $newCategory->getName();
                $parameters["id"] = $id;

                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch(Exception $ex) {
                throw $ex;
            }
        }

        public function GetCategoryById($id, $what) {
            $category = null;

            try {
                if($what) {
                    $query = "SELECT * FROM ".$this->tableName." WHERE category_id = :id AND category_active = 1;";
                }
                else {
                    $query = "SELECT * FROM ".$this->tableName." WHERE category_id = :id";
                }

                $parameters["id"] = $id;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query, $parameters);
                
                foreach ($resultSet as $row) {                
                    $category = new Category();

                    $category->setId($row["category_id"]);
                    $category->setName($row["category_name"]);
                    $category->setActive($row["category_active"]);
                }
            }
            catch(Exception $ex) {
                throw $ex;
            }
            finally {
                return $category;
            }
        }

        public function GetCategoryByName($name, $what) {
            $category = null;

            try {
                if($what) {
                    $query = "SELECT * FROM ".$this->tableName." WHERE category_name = :name AND category_active = 1;";
                }
                else {
                    $query = "SELECT * FROM ".$this->tableName." WHERE category_name = :name";
                }

                $parameters["name"] = $name;

                $this->connection = Connection::GetInstance();

                $resultSet = $this->connection->Execute($query, $parameters);
                
                foreach ($resultSet as $row) {                
                    $category = new Category();

                    $category->setId($row["category_id"]);
                    $category->setName($row["category_name"]);
                    $category->setActive($row["category_active"]);
                }
            }
            catch(Exception $ex) {
                throw $ex;
            }
            finally {
                return $category;
            }
        }

        public function ChangeCategoryState($id) {
            try {
                $query = "UPDATE ".$this->tableName." SET category_active = NOT category_active WHERE category_id = :id;";

                $parameters["id"] = $id;

                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch(Exception $ex) {
                throw $ex;
            }
        }
    }
?>