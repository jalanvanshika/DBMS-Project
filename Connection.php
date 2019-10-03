<!DOCTYPE html>
<html>
<body>

<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dbms";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
// $test = $_POST["Query"];
// if($test <> NULL)
// {
//     $sql = $_POST["Query"];
// }
// else
// {
// $RegNo = $_POST["RegisterNo"];
// $Name = $_POST["Name"];
// $Branch = $_POST["Branch"];
// $Birthday = $_POST["Birthday"];
// $Gender = $_POST["Gender"];

// $sql = "INSERT INTO students VALUES ('$RegNo', '$Name', $Birthday, '$Branch',$Gender)";
// }

$RegNo = $_POST["RegisterNo"];
$Name = $_POST["Name"];
$Branch = $_POST["Branch"];
$Age = $_POST["Age"];
$Gender = $_POST["Gender"];

$sql = "INSERT INTO students VALUES ('$RegNo', '$Name', $Age, '$Branch', '$Gender')";


if ($conn->query($sql) === TRUE) {
    echo "New record altered successfully";
} else {
    //echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();



echo "<table style='border: solid 1px black;'>";
 echo "<tr><th>Reg.NO</th><th>Name</th><th>Birthday</th><th>Branch</th><th>Gender</th></tr>";

class TableRows extends RecursiveIteratorIterator { 
    function __construct($it) { 
        parent::__construct($it, self::LEAVES_ONLY); 
    }

    function current() {
        return "<td style='width: 150px; border: 1px solid black;'>" . parent::current(). "</td>";
    }

    function beginChildren() { 
        echo "<tr>"; 
    } 

    function endChildren() { 
        echo "</tr>" . "\n";
    } 

    
} 

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dbms";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT * FROM students"); 
    $stmt->execute();

    // set the resulting array to associative
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 

    foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) { 
        echo $v;
    }
}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;
echo "</table>";

?> 
<a href = "index.html"> Back </a>

</body>
</html>