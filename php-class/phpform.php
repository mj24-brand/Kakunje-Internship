<form action="" method="POST">
    <input type="text" name="name">
    <input type="email" name="email">
    <input type="submit">
</form>

<?php
if($_SERVER['REQUEST_METHOD']=="POST"){
    $name=$_POST['name'];
    echo $name;
}
?>


<?php
//required validation
if(empty($_POST['name'])){
    echo "name is required";
}
?>

<?php
//to validate email syntax
$email=$_POST['email'];
if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
    echo "invalid email";
}
?>

<?php
//url validation syntax
$url=$_POST['website'];
if(!filter_var($url,FILTER_VALIDATE_URL)){
    echo "invalid url";
}
?>