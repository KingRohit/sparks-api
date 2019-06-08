<?php
class Aircraft{
    private $conn;
    private $table = 'aircraft';
    
    public $id;
    public $name;
    public $generation;

    public function __construct($db){
        $this->conn = $db;
    }

    public function read(){
        $query = 'SELECT * FROM aircraft';
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    public function read_single(){
        $query = 'SELECT * FROM aircraft WHERE id = ? LIMIT 0,1';
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(1,$this->id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->id = $row['id'];
        $this->name = $row['name'];
        $this->generation = $row['generation'];
    }

    public function create(){
        $query = 'INSERT INTO aircraft SET
        name = :name,
        generation = :generation';

        $stmt = $this->conn->prepare($query);

        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->generation = htmlspecialchars(strip_tags($this->generation));

        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':generation', $this->generation);

        if($stmt->execute()){
            return true;
        }

        printf("Error: %s .\n", $stmt->error);

        return false;
    }

    public function update(){
        $query = 'UPDATE aircraft SET
        name = :name,
        generation = :generation
        WHERE id = :id';

        $stmt = $this->conn->prepare($query);

        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->generation = htmlspecialchars(strip_tags($this->generation));
        $this->id = htmlspecialchars(strip_tags($this->id));


        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':generation', $this->generation);
        $stmt->bindParam(':id', $this->id);


        if($stmt->execute()){
            return true;
        }

        printf("Error: %s .\n", $stmt->error);

        return false;
    }

    public function delete(){
        $query = 'DELETE FROM aircraft where id = :id';

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