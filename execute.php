<?php
echo '<pre>';

// Outputs all the result of shellcommand "ls", and returns
// the last output line into $last_line. Stores the return value
// of the shell command in $retval.
//$newString =  exec('java Compiler '.'First Line\nSecond Line');
$newString =  exec('java /afs/cad/u/d/j/dj65/public_html/cs490/Compiler '.'First Line\nSecond Line');

echo $newString;

/*$last_line = system('ls --help', $retval);*/
// Printing additional info
/*echo '
</pre>
<hr />Last line of the output: ' . $last_line . '
<hr />Return value: ' . $retval;*/
?>