<?php

$userName = "";
$loginMessage = "";
$homePage = "";
$inDBPage = "";

function initializePages(){
global $userName, $loginMessage, $homePage, $inDBPage;
	$homePage = '
	<!DOCTYPE html> 
	<html>
		<head>
			<link rel="stylesheet" type="text/css" href="css/style.css">
		</head>
		<body>
			<div id="head">
				CS490 Exam Bat
			</div>
			<div id="login" class="shadow" >
				<form action="" method="post">
					<table>
						<tr>
							<td>Username</td><td><input type="text" name="user"></td>
						</tr>
						<tr>
							<td>Password</td><td><input type="password" name="pwd"></td>
						</tr>
					</table>
					<input type="submit" value="Login">
				</form>
			</div>
			<div id="loginMessage">
				<center>'.$loginMessage.'</center>
			</div>
		</body>
	</html>
	';

	$inDBPage = 
	'
	<!DOCTYPE html> 
	<html>
		<head>
			<link rel="stylesheet" type="text/css" href="css/style.css">
		</head>
		<body>
			<div id="container" class="shadow" >
				<div id="head2">
					Welcome '.$userName.'
				</div>
				<div id="logOut">
					<form action="" method="post">
						<input type="hidden" name="logOut" value="logOut">
						<input type="submit" value="sign out">
					</form>
				</div>
				<div id="leftPanel">

				</div>
				<div id="rightPanel" class="roundBorder">

				</div>
			</div>
		</body>
	</html>	
	';

}


    if((isset($_POST['user']) && isset($_POST['pwd'])))
    {
        $url = 'http://web.njit.edu/~dj65/cs490/controller.php';
        
        $postdata = $_POST;
        
        $c = curl_init();
        curl_setopt($c, CURLOPT_HTTPHEADER, array('Content-Type' => 'text/plain'));
        curl_setopt($c, CURLOPT_URL, $url);
        curl_setopt($c, CURLOPT_POST, true);
        curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($c, CURLOPT_POSTFIELDS,$postdata);
        $result = curl_exec ($c);
        curl_close ($c);
		$jsonToPHPArrayResults = json_decode($result,true);
		//print_r($jsonToPHPArrayResults);		
		
        if($jsonToPHPArrayResults['loginStatus'] == 'inDB'){
			//echo "Welcome ".$jsonToPHPArrayResults['data'][0]['username']."<br>You are registered for ".$jsonToPHPArrayResults['data'][0]['coursename'];
			$userName = $jsonToPHPArrayResults['data'][0]['username'];
			initializePages();
			session_start();
			$_SESSION['userName'] = $userName;
			echo $inDBPage;
		}
		else if($jsonToPHPArrayResults['loginStatus'] == 'notInDB'){
			$loginMessage = 'You have successfully been authenticated, but you are not registered as a professor or student in our database
			<br>Please talk to your administrator to have your account added to our database';
			initializePages();
			echo $homePage;
		}
		else if($jsonToPHPArrayResults['loginStatus'] == 'fail'){
			$loginMessage = "Opps <br>Please try another username and password";
			initializePages();
			echo $homePage;
		}
		
		//echo "<br>String Length equals: ".$jsonToPHPArrayResults['count'];

    }
    else
    {
		session_start();
		if(isset($_SESSION['userName']))
		{	
			if(isset($_POST['logOut'])){
				session_destroy();
				initializePages();
				echo $homePage;
			}
			else{
				$userName = $_SESSION['userName'];
				initializePages();
				echo $inDBPage;
			}
		}
		else{
			session_destroy(); 
			initializePages();
			echo $homePage;
		}

    }
	
	
    
?>

