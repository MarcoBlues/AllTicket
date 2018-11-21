<?php
    namespace DAO;
    
    use Models\Category;

    interface ICategoryDAO {
        function AddCategory(Category $category);
        function GetAllCategories($what);
        function GetCategoryByName($name, $what);
        function GetCategoryById($id, $what);
        function CheckCategoryById($id);
        function UpdateCategory($id, Category $newCategory);
        function ChangeCategoryState($id);
    }
?>