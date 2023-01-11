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

}


?>