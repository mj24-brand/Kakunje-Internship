<?php
echo "Hello World";
//Single line comments, #,//
?>


<?php
$a =10;
$b =20;
echo $a+$b;

print "php";
?>

<?php
$name="abc";

echo $name;

$age=21;

$price=10.5;
echo gettype($price);

$isAdmin=true;

$colors=["red","blue"];
var_dump($colors);

?>

<?php
$x="10";
$y=(int)$x;
echo gettype($y);
?>
<?php
$x="5.8";
$y=(int)$x;
echo gettype($y);
?>

<?php
//math functions
echo abs(-5);
echo "<br>";
echo sqrt(16);
echo "<br>";
echo pow(2,3);
echo "<br>";
echo rand(1,10);
?>

<?php
//arithmetic operator
$a=10;
$b=3;
echo $a+$b;
echo "<br>";
echo $a-$b;
echo "<br>";
?>

<?php
//assignment operators
$x=5;
echo $x;
echo "<br>";
$y=10;
$y+=5;
echo $y;
?>


<?php
//comparison operators
$a=5;
$b="5";

var_dump($a==$b);
echo "<br>";
var_dump($a===$b);
?>

<?php
$x=10;
if($x!=5){
    echo "not equal to 5";
}
?>

<?php
//logical and operator
$age=20;
$citizen=true;
if($age >=18 && $citizen==true){
    echo "you are eligible to vote";
}
?>

<?php
//logical or operator
echo "<br>";
$day="Sunday";
if($day=="Saturday" || $day=="Sunday"){
    echo "it is a weekend";
}
?>

<?php
//logical NOT(!)
$isLoggedIn=false;
if(!$isLoggedIn){
    echo "Please login";
}
?>

<?php
//post increment
echo "<br>";
$x=5;
echo $x++;
echo "<br>";
echo $x;
?>

<?php
//pre increment
echo "<br>";
$y=5;
echo ++$y;
?>


<?php
//if condition
echo "<br>";
if($age >18)
    echo "eligible to vote"
?>

<?php
//if-else
echo "<br>";
if($age>18){
    echo "adult";
}else{
    echo "minor";
}
 ?>

 <?php
 //if elseif else
 $marks=89;
 if($marks >90){
    echo "A";
 }elseif ($marks >70){
    echo "B";
 }else {
    echo "C";
 }
 ?>

 <?php
 //switch
 $day=2;
 switch($day){
    case 1:
        echo "Monday";
        break;
    case 2:
        echo "Tuesday";
        break;
        default:
        echo "invalid";
 }
 ?>

 <?php
 //for loop
 echo "<br>";
 for($i=1;$i<=5;$i++){
    echo $i;
 }
 ?>

 <?php
 //while loop
 echo "<br>";
 $i=1;
 while ($i<=5){
    echo $i;
    $i++;
 }
 
 ?>

 <?php
 //do while
 echo "<br>";
 $i=1;
 do{
    echo $i;
    $i++;
 }
 while($i<=5);
 ?>

 <?php
 echo "<br>";
 $colors =['red','black'];
 foreach($colors as $color){
    echo $color;
 }
 ?>

 <?php
 //function
 echo "<br>";
 function greet(){
    echo "hello";
 }
 greet();
 ?>

 <?php
 // function with parameters
 echo "<br>";
 function add($a,$b){
    return $a+$b;
 }
 echo add(5,10);
 ?>


<?php
//indexed array
echo "<br>";
$color=['red','blue','green'];
echo $color[0];
?>

<?php
//associative array
$user=["name"=>"abc","age"=>30];
echo $user["name"];
?>

<?php
//multidimensional array
$student=[["abc",64],["xyz",90]];
var_dump ($student);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <!--<?php echo "heloo","world";?>-->
</body>
</html>