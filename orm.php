<?php
class ORM{
    protected $table;
    protected $connection;

    public function __construct(){
        $this->connection = new mysqli("localhost", "root", "", "JSON_AND_FETCH");
        if ($this->connection->connect_error) {
            die("Error de conexión: " . $this->connection->connect_error);
        }
    }

    public function toArray($result){

        $data = array();
        while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
            $data[] = $row;
        }
    
        return $data;
    }

    public function getAll(){
        $stm = $this->connection->prepare("SELECT * FROM $this->table");
        if (!$stm) {
            // Manejar el error si la preparación de la consulta falla
            die("Error al preparar la consulta: " . $this->connection->error);
        }
    
        $stm->execute();
    
        $result = $stm->get_result();

        if (!$result) {
            die("Error al obtener el resultado: " . $stm->error);
        }

        return $this->toArray($result);
    

    }

    public function getId(){
        $sql = "SELECT CLI_ID FROM CLIENTES WHERE CLI_NOMBRE = 'German' AND CLI_APELLIDO = 'Canteros';"
    }

    public function deleteById($id){
        $stm = $this->connection->prepare("DELETE FROM $this->table WHERE CLI_ID = $id;");
        if (!$stm) {
            // Manejar el error si la preparación de la consulta falla
            die("Error al preparar la consulta: " . $this->connection->error);
        }

        $stm->execute();
    }

    public function insert($data){
        $sql = "INSERT INTO $this->table (";

        $keys = array_keys($data);
    
        foreach ($keys as $key) {
            $sql .= $key. ", ";
        }
        $sql = trim($sql, ", ");
        $sql .= ") VALUES (";

        foreach ($data as $value) {
            if(is_string($value)){
                $sql .= "'". $value. "'". ", ";
            }
            else{
                $sql .= $value. ", ";
            }
        }

        $sql = trim($sql, ", ");
        $sql .= ");";

        $stm = $this->connection->prepare($sql);
        $stm->execute();
        echo $sql;
    }
}
?>