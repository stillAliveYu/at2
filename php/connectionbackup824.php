<?php
 
class connection{
    
    public $connection;
	protected $query;

    public function __construct($dbhost = 'localhost', $dbuser = 'root', $dbpass = '', $dbname = 'gallery', $charset = 'utf8'){
        try {
            $this->connection = new PDO(
                "mysql:host=$dbhost; dbname=$dbname",
                $dbuser, $dbpass
            );
             
            $this->connection->setAttribute(PDO::ATTR_ERRMODE,
                        PDO::ERRMODE_EXCEPTION);
            
             
        } catch(PDOException $e) {
            echo "Connection failed: "
                . $e->getMessage();
        }
    }

    public function getWholeGallery($tbName = 'paint'){
        $stmt = $this->connection->prepare(
            "SELECT * FROM $tbName");
        $stmt->execute();
        $g = $stmt->fetchAll(); 
       return $g;
    }

    public function insert($name,$year,$media,$artist,$style,$img,$tn){
        $query = "INSERT INTO paint (name,year,media,artist,style,img,tn) VALUES(?,?,?,?,?,?,?)";
        $statement = $this->connection->prepare($query);
        $result = $statement->execute(
          array($name,$year,$media,$artist,$style,$img,$tn));
        return $result;
    }

    public function del($id,$tbname = 'paint'){
        $query = "DELETE FROM $tbname WHERE id=?";
        $stmt= $this->connection->prepare($query);
        $stmt->execute([$id]);
        return $stmt;
    }
    public function findById($id,$tbname = 'paint'){
        $query = "SELECT name FROM $tbname WHERE id=?";
        $stmt= $this->connection->prepare($query);
        $stmt->execute([$id]);
        $row = $stmt->fetch();
        return $row;
    }

    public function close() {
        $this->connection = null;
    }
}
?>