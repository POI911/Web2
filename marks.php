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
        $_SESSION['auth'] = 1;
        include "show.php";


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