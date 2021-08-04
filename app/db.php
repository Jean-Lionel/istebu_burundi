 <?php

function connectTo(string $databasename = "istebu_original"){
     $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = $databasename;
      try {
        $conn = new PDO("mysql:host=$servername;dbname=$databasename", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //echo "Connected successfully";
      } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
      }
    return  $conn;

}

function getConnection(){
    
    return connectTo(); 
}

function getConnection_on_orginal(){
  return connectTo('istebu_original');
}
?> 