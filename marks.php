<?php
session_start();
$_SESSION['auth'] = 0;
?>


<?php
function login(){
    $GLOBALS['connection_link'];
    $query = "SELECT * FROM marks WHERE S_ID = '{$GLOBALS['studentLogin']}' AND  S_PASS = '{$GLOBALS['password_login']}' ";
    if($result = mysqli_query($GLOBALS['connection_link'], $query)){
        if(mysqli_num_rows($result) == '1'){
               return true;
        }
        else return false;
    }
    else echo "connection bad";
}
if(isset($_POST["submit"])){
    $GLOBALS['studentLogin'] = $_POST['studentId'];
    $GLOBALS['password_login'] = $_POST['studentPass'];

    include "DBconnection.php";

    $GLOBALS['connection_link'];
    if(login() === true){
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "students_marks";

        // Create connection again!
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

    $sql =  "SELECT S_NAME, C_NAME, C_MARK  FROM marks WHERE S_ID = '{$GLOBALS['studentLogin']}'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {

echo "<style> table, th, td { border: 1px solid black; padding: 5px;} </style>";
            echo "<table><tr><th>NAME</th><th>COURSE</th><th>MARK</th></tr>";
            // output data of each row
            while($row = $result->fetch_assoc()) {
                echo "<tr><td>".$row["S_NAME"]."</td><td>".$row["C_NAME"]."</td><td>".$row["C_MARK"]."</td></tr>"."</td></tr>";
            }
            echo "</table>";
        } else {
            echo "0 results";
        }

        $conn->close();
}

    else{
        echo "Student ID or Password is wrong!";
        echo "<br>";
        echo "<a  href='index.html'> Try Again!</a>";
    }

    include "DBconnectionClose.php";
}
else{
    echo "<h1>Access Denied!</h1>";
    echo "<a  href='index.html'> Go back</a>";
}

?>