<?php
//Author: Desmond Johnson CS:490 Date: 10/12/13

$resultsArray = Array();

if(isset($_GET['method'])){	
	$method = $_GET['method'];
	$method($_GET['param1'],$_GET['param2'],$_GET['param3'],$_GET['param4'],$_GET['param5'],$_GET['param6']);
}

if((isset($_POST['user'])) && (isset($_POST['pwd'])) )
{	
		$uname = 'CN='.$_POST['user'].',CN=Users,DC=academic,DC=campus,DC=njit,DC=edu';
		$ldapconn = ldap_connect("njitdm.campus.njit.edu");
		$ldapbind = ldap_bind($ldapconn, $uname, $_POST['pwd']);
		

		$resultsArray['loginStatus'] = ""; 
		
		if ($ldapbind) {
			//$url = 'http://web.njit.edu/~cem6/dblogin.php?user='.$_POST['user'];
			$url = 'http://web.njit.edu/~cem6/dblogin.php?user=cem6';
			$postdata = $_POST;
			$c = curl_init();
			curl_setopt($c, CURLOPT_HTTPHEADER, array('Content-Type' => 'text/plain'));
			curl_setopt($c, CURLOPT_URL, $url);
			curl_setopt($c, CURLOPT_POST, true);
			curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($c, CURLOPT_POSTFIELDS,$postdata);
			$result = curl_exec ($c);
			curl_close ($c);
			

			
			if(strlen($result) > 4){
				$jsonToPHPArrayResults = json_decode($result,true);
				//echo print_r($jsonToPHPArray);
				//echo $jsonToPHPArray[0]['username']; 
				//print_r($jsonToPHPArray);
				$resultsArray['loginStatus'] = 'inDB';
				$resultsArray['data'] = $jsonToPHPArrayResults;
				//$resultsArray['count'] = print_r(($result));
				//$resultsArray['count'] = strlen($result);
			}
			else{
				$resultsArray['loginStatus'] = 'notInDB';

			}
			
		} else {
			$resultsArray['loginStatus'] = 'fail';

		}
		print json_encode($resultsArray);
}
else
{
	
}

//Test function
function printMessage(){
	echo "printMessage function just ran";
}

//Test function
function writeMessage(){
	echo "writeMessage function just ran";
}

//Test function
function newMessage($param){
	echo $param;
}

//Test function
function someMadeUpMethod($param){
	echo $param;
}

?>