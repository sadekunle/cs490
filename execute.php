<?php

//Sample code that is not being used
$code = '
String newString = "someText";
System.out.println(newString);
';




if(isset($_POST['code'])){
	echo '<form action="" method="post">
	<textarea name="code" rows="4" cols="50" autofocus>
	'.$_POST['code'].'
	</textarea>
	<br>
	<input style="float:left" type="submit" value="Run Code">
	</form>';
	echo "<br><br>";
	echo compiler($_POST['code']);

	//$file = 'http://web.njit.edu/~dj65/cs490/output/sourceCode.java';
	//readLocalFile($file);
}
else{
	echo '<form action="" method="post">
	<textarea name="code" rows="4" cols="50">
	Enter Code Here
	</textarea>
	<br>
	<input style="float:left" type="submit" value="Run Code">
	</form>';
}


//Compiles the code passed to it. If it has an error message will be returned, 
//otherwise the compile program will be ran and the results will be returned
function compiler($someCode){
	return '<pre>'.shell_exec('java Compiler '.'\''.$someCode.'\'').'</pre>';
}

//Reads files directly from the server. Outputs there content to the screen
function readLocalFile($filePath){ 
	$lines = file($filePath);
	echo '<pre>';
	foreach ($lines as $line) {
		echo htmlspecialchars($line) . "<br/>";
	}
	echo '</pre>';
}

?>

