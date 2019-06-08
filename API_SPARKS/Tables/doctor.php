<?php
class Doctor{
    private $conn;
    private $table = 'doctor';
    
    public $id;
    public $name;
    public $specialist;

    public function __construct($db){
        $this->conn = $db;
    }

    public function read(){
        $query = 'SELECT * FROM doctor';
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    public function read_single(){
        $query = 'SELECT * FROM doctor WHERE id = ? LIMIT 0,1';
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(1,$this->id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->id = $row['id'];
        $this->name = $row['name'];
        $this->specialist = $row['specialist'];
    }

    public function create(){
        $query = 'INSERT INTO doctor SET
        name = :name,
        specialist = :specialist';

        $stmt = $this->conn->prepare($query);

        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->specialist = htmlspecialchars(strip_tags($this->specialist));

        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':specialist', $this->specialist);

        if($stmt->execute()){
            return true;
        }

        printf("Error: %s .\n", $stmt->error);

        return false;
    }

    public function update(){
        $query = 'UPDATE doctor SET
        name = :name,
        specialist = :specialist
        WHERE id = :id';

        $stmt = $this->conn->prepare($query);

        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->specialist = htmlspecialchars(strip_tags($this->specialist));
        $this->id = htmlspecialchars(strip_tags($this->id));


        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':specialist', $this->specialist);
        $stmt->bindParam(':id', $this->id);


        if($stmt->execute()){
            return true;
        }

        printf("Error: %s .\n", $stmt->error);

        return false;
    }

    public function delete(){
        $query = 'DELETE FROM doctor where id = :id';

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