<?php
echo '<pre>';
$newString =  shell_exec('java Compiler "
String newString = \"someText\";
System.out.println(newString);
"
');
 
echo $newString;
$lines = file('http://web.njit.edu/~dj65/cs490/output/sourceCode.java');
foreach ($lines as $line) {
    echo htmlspecialchars($line) . "<br/>";
}
echo '</pre>';

?>