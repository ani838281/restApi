<?php
class Student{
    private $conn;
    private $table='student';
    public $id;
    public $name;
    public $branch;
   // public $result;
    public function __construct($db){
        $this->conn=$db;
    }
    public function read()
    {
        $query="select * from student order by name desc";
        $stmt=$this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
 

        public function read_single()
    {
        $query='select * from ' . $this->table . ' where id=? limit 0,1 ';
        $stmt=$this->conn->prepare($query);
        $stmt->bindParam(1,$this->id);
        $stmt->execute();
        $row=$stmt->fetch(PDO::FETCH_ASSOC);
        $this->id=$row['id'];
        $this->name=$row['name'];
        $this->branch=$row['branch'];
       // $this->result=$row['result'];
        
        
    }
    public function create()
    {
        $query='insert into student set name=:name,branch=:branch';
        $stmt=$this->conn->prepare($query);
        $this->name=htmlspecialchars(strip_tags($this->name));
        $this->branch=htmlspecialchars(strip_tags($this->branch));
        $stmt->bindParam(':name',$this->name);
       $stmt->bindParam(':branch',$this->branch);
        if($stmt->execute())
        {
            return true;
        }
        printf("Error:$s.\n",$stmt->error);
        return false;
    }
public function update() {
    // Create Query
    $query = 'UPDATE ' .
      $this->table . '
    SET
      name = :name,
      branch= :branch
      WHERE
      id = :id';

  // Prepare Statement
  $stmt = $this->conn->prepare($query);

  // Clean data
  $this->name = htmlspecialchars(strip_tags($this->name));
     $this->id = htmlspecialchars(strip_tags($this->id));
 $this->branch = htmlspecialchars(strip_tags($this->branch));
  // Bind data
  $stmt-> bindParam(':name', $this->name);
  $stmt-> bindParam(':id', $this->id);
$stmt-> bindParam(':branch', $this->branch);
  // Execute query
  if($stmt->execute()) {
    return true;
  }

  // Print error if something goes wrong
  printf("Error: $s.\n", $stmt->error);

  return false;
  }

  // Delete Category
  public function delete() {
    // Create query
    $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';

    // Prepare Statement
    $stmt = $this->conn->prepare($query);

    // clean data
    $this->id = htmlspecialchars(strip_tags($this->id));

    // Bind Data
    $stmt-> bindParam(':id', $this->id);

    // Execute query
    if($stmt->execute()) {
      return true;
    }

    // Print error if something goes wrong
    printf("Error: $s.\n", $stmt->error);

    return false;
    }
}
?>