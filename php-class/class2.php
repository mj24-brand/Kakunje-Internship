<?php
//$globals
$x=10;
$y=20;

function add(){
    echo $GLOBALS['x']+ $GLOBALS['y'];
}
add();
?>

<?php
//modifying global variable
echo "<br>";
$x=5;
function test(){
    $GLOBALS['x']=20;
}
test();
echo $x;
?>

<?php
echo "<br>";
echo $_SERVER['PHP_SELF'] //return the currently executing filename 
?>

<?php
echo "<br>";
echo $_SERVER['SERVER_NAME']//returns the name of the server
?>

<?php
echo "<br>";
echo $_SERVER['REQUEST_METHOD'];//syntax
?>

<?php
echo "<br>";
if($_SERVER["REQUEST_METHOD"]=="POST"){
    echo "form submitted";
}
?>

<?php
echo "<br>";
echo $_SERVER['REMOTE_ADDR'];//returns the IP address
?>

<!--<?php
echo "<br>";
echo $_GET['name'];
?>-->

<!--<form action="" method="GET">
    Name:<input type="text" name="username">
    <input type="submit">
</form>-->

<?php
//to display in brwoser
if(isset($_GET['username'])){
    echo $_GET['username'];
}
?>


<form action="" method="POST">
    Name:<input type="text" name="username">
    <input type="submit">
</form>

<?php
//to display in brwoser
if(isset($_POST['username'])){
    echo $_POST['username'];
}
?>


<?php
echo "<br>";
if(isset($_REQUEST['username'])){
    echo $_REQUEST['username'];
}
?>

<form method="POST">
    <input type="text" name="username">
</form>

<?php
if(isset($_REQUEST['city'])){
    echo "city is:" . $_REQUEST['city'];
}
?>

<form action="" method="POST">
    Name:<input type="text" name="username">
    <input type="submit">
</form>

<?php
echo "<br>";
if(isset($_REQUEST['username'])){
    echo "hello". $_REQUEST['username'];
}
?>


<?php
echo "<br>";
//syntax of cookie
setcookie("user","abc",time()+3600);
if(isset($_REQUEST['user'])){
    echo $_REQUEST['user'];
}
?>

<?php
if(!isset($_COOKIE['visits'])){
    setcookie("visits",1,time()+3600);
    echo "Firstvisit";
}else{
    $count =$_COOKIE['visits']+1;
    setcookie("visits",$count,time()+3600);
    echo "you visited".$count."times";
}
?>


<?php
echo "<br>";
//$name="abc";
var_dump(isset($name));//checks variable exits or not
?>