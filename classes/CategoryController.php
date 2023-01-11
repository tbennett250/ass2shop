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
                WHERE ID = :ID ";
    }

}


?>