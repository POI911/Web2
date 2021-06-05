<?php


if(@$_SESSION['auth'] != 1){
echo "<h1>No permission!</h1>";
exit();

}
else{

echo "Hello";
}


?>