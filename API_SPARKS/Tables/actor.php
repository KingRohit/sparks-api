<?php
class Actor{
    private $conn;
    private $table = 'actor';
    
    public $id;
    public $name;
    public $industry;

    public function __construct($db){
        $this->conn = $db;
    }

    public function read(){
        $query = 'SELECT * FROM actor';
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    public function read_single(){
        $query = 'SELECT * FROM actor WHERE id = ? LIMIT 0,1';
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(1,$this->id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->id = $row['id'];
        $this->name = $row['name'];
        $this->industry = $row['industry'];
    }

    public function create(){
        $query = 'INSERT INTO actor SET
        name = :name,
        industry = :industry';

        $stmt = $this->conn->prepare($query);

        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->industry = htmlspecialchars(strip_tags($this->industry));

        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':industry', $this->industry);

        if($stmt->execute()){
            return true;
        }

        printf("Error: %s .\n", $stmt->error);

        return false;
    }

    public function update(){
        $query = 'UPDATE actor SET
        name = :name,
        industry = :industry
        WHERE id = :id';

        $stmt = $this->conn->prepare($query);

        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->industry = htmlspecialchars(strip_tags($this->industry));
        $this->id = htmlspecialchars(strip_tags($this->id));


        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':industry', $this->industry);
        $stmt->bindParam(':id', $this->id);


        if($stmt->execute()){
            return true;
        }

        printf("Error: %s .\n", $stmt->error);

        return false;
    }

    public function delete(){
        $query = 'DELETE FROM actor where id = :id';

        $stmt = $this->conn->prepare($query);
        $this->id = htmlspecialchars(strip_tags($this->id));
        $stmt->bindParam(':id', $this->id);

        if($stmt->execute()){
            return true;
        }

        printf("Error: %s .\n", $stmt->error);

        return false;

    }
}