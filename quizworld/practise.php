<?php

//variables


$name = "Vinod bahadur thapa ";
$youtube = 'ThapaTechnical';
$number = 10;

echo ' mY name is '.$name;
echo "<br>";
echo 'my youtube name is ' .$youtube;

define('YOUTUBE',"thapatechnical");
echo "<br>";
echo YOUTUBE;


//operators


// Arithmetic operators $x + $y, $x - $y  **
// Assignment operators  x = y , x += y x = x+y ;
// Comparison operators  $x == $y(equal), $x === $y(identical)
// Increment/Decrement operators ++$x, Pre-increment
// Logical operators 	$x and $y , $x or $y
// String operators  $txt1 . $txt2
// Array operators		Union of $x and $y (array Comparison)	

echo"<br>";
$a = 2;
$b = 4; 

echo ++$a;
echo "<br>";
echo $a;

echo "<br>";
echo $a < $b;



echo "<br>";
if($a > $b){

	echo " $a is smaller than $b";
}else{
	echo " $a is greater than $b";
}

echo "<br>";
switch(2){

	case 2: echo " this is a switch case no 2";
		break;

	case 3: echo " this is a switch case no 3";
		break;

}

echo "<br>";
while ($a < 10) {  
	echo " this is a while no $a <br>";
	$a++;
}

do{
	echo " this is a do while loop <br>";
	
}while (100 < 10);

echo"<br>";
echo"<br>";
for($a=1; $a<10; $a++){
	echo " this is a for loop $a <br>";
}


//strings

echo"<br>";
echo"<br>";
$a = "thapatehcnial";
$b = ' VINOD BAHADUR THAPA';


echo strtolower($b);


echo"<br>";
echo"<br>";echo"<br>";
echo"<br>";echo"<br>";	
echo"<br>";echo"<br>";
echo"<br>";


// The real power of PHP comes from its functions; it has more than 1000 built-in functions.
	
// Besides the built-in PHP functions, we can create our own functions.

// A function is a block of statements that can be used repeatedly in a program.

// A function will not execute immediately when a page loads.

// A function will be executed by a call to the function.

// A function name can start with a letter or underscore (not a number)


echo "this is sum of funvtion " .sum(5,10); //function call

echo"<br>";

function sum($x , $y){
	$c = $x + $y;
	return $c;
}

echo"<br>";
echo"<br>";echo"<br>";
echo"<br>";echo"<br>";	
echo"<br>";echo"<br>";
echo"<br>";

// An array is a special variable, which can hold more than one value at a time.

// In PHP, there are three types of arrays:

// Indexed arrays - Arrays with a numeric index
// Associative arrays - Arrays with named keys
// Multidimensional arrays - Arrays containing one or more arrays




// Indexed arrays
$india = array("delhi","pune","mumbai");

echo $india[2];

echo "<br>";

// key => value


$india = array("capital" => "delhi","bestcity" => "pune","mumbai");

echo $india['bestcity'];
echo "<br>";

foreach($india as $thapa){
	echo $thapa;
	echo "<BR>";	
}


echo"<br>";
echo"<br>";echo"<br>";
echo"<br>";echo"<br>";	
echo"<br>";echo"<br>";
echo"<br>";


$thapa = array(

	array("thapa"),
	array("technical","youtube"),
	array("Like","Subscribe","share")

);
echo "<br>";
echo $thapa[2][2];


echo"<br>";
echo"<br>";echo"<br>";
echo"<br>";echo"<br>";	
echo"<br>";echo"<br>";
echo"<br>";

?>