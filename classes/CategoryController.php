<?php

class CategoryController
{
    protected $db;

    public function __construct(Database $db) {$this->db = $db;}

    public function addNewCat(array $category) : bool {
        
        $sql = "INSERT into category(title, description, image)
                VALUES (:title, :description, :image);";
        $this->db->runSQL($sql, $category);
        return $this->db->lastInsertId();
    }

    public function get($id) {
        $sql = "SELECT * FROM category WHERE id = :id";
        $args = ['id' => $id];

        return $this->db->runSQL($sql, $args) -> fetch();
    }

    public function getAll() : array {
        $sql = "SELECT * FROM category";
        return $this->db->runSQL($sql) -> fetchAll();
    }

    public function update(array $category): bool {
        
        $sql = "UPDATE category
            SET title = :title,
                description = :description,
                image = :image
                WHERE ID = :ID";

        return $this->db->runSQL($sql, $category)->execute();

    }

    public function ListDropdown(){
        $categorys = $this->getAll();

        foreach($categorys as $cat){
            
            echo '<option value="' . $cat['ID'] .'">' . $cat['title'] . "</option>";
        }

       
    }

    public function GetByProductFK($ProductFK){

        $sql = "SELECT * FROM catproducts WHERE ProductFK = :ProductFK";
        $args = ['ProductFK' => $ProductFK];

        return $this->db->runSQL($sql, $args)->fetch();

    }

    public function DisplayCat($id){
        $catProduct = $this->GetByProductFK($id);
    }

    public function SetCategory($catProduct){

    }

    public function assignCat($args){
        $sql = "INSERT into catproducts(CategoryFK, ProductFK)
                VALUES ( :CategoryFK,  :ProductFK);";
                $this->db->runSQL($sql, $args);
                return $this->db->lastInsertId();
    }

    public function UpdateCat($args){
        $sql = "UPDATE catproducts
                SET ProductFK = :ProductFK,
                    CategoryFK = :CategoryFK
                WHERE CatProductID = :CatProductID ";

        $this->db->runSQL($sql, $args)->execute();
    }

    public function GetProductsByCategoryID($id){
        
        $sql =  "SELECT CategoryFK FROM catproducts WHERE ProductFK = :ProductFK";
        $args = ["ProductFK" => $id];

        return $this->db->runSQL($sql, $args)->fetch();

    }

    public function GetCategorysByProductID($id){
        $sql = "SELECT ProductFK FROM catproducts WHERE CategoryFK = :CategoryFK";
        $args = ["CategoryFK" => $id];

        return $this->db->runSQL($sql, $args)->fetchAll();
    }

    public function GetCatTitleFromProductID($id){
      $catID = $this->GetProductsByCategoryID($id);
   
      $cat = $this->get($catID['CategoryFK']);
      

      return $cat['title'];
    

    }

    public function DeleteByProductID($id){
        $sql = "DELETE FROM catproducts WHERE ProductFK = :ProductFK";
        return $this->db->runSQL($sql, ['ProductFK' => $id])->execute();

    }

}


?>