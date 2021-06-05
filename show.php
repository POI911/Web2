<?php


if(@$_SESSION['auth'] != 1){
echo "<h1>No permission!</h1>";
exit();

}

else{
        include "DBconnection.php";

        $GLOBALS['connection_link2'];
        $query = "SELECT * FROM marks WHERE S_ID = '{$GLOBALS['studentLogin']}'  ";
        if($result = mysqli_query($GLOBALS['connection_link2'], $query)){
            if(mysqli_num_rows($result) == '1'){
                   return true;
            }
            else return false;
        }
        else echo "connection bad";


    if ($result->num_rows > 0) {
        echo "<html><head></head><body>";
        echo "<table><tr><th>ID</th><th>Name</th></tr>";
        // output data of each row
        while($row = $result->fetch_assoc()) {
          echo "<tr><td>".$row["S_NAME"]."</td><td>".$row["C_NAME"]." ".$row["C_MARK"]."</td></tr>";
        }
        echo "</table></body></html>";

      }
       else {
        echo "0 results";
}
?>

