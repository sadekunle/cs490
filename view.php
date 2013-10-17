<?php

// Shereef Adekunle

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
			<script type="text/javascript" src="scripts/jquery.min.js"></script>
			<script type="text/javascript" src="scripts/script.js"></script>			
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
					<div id="addQuestions" class="button">Add Questions to Question Bank</div>
					<div id="addQuestionsDropDown" class="buttonDropDown">
						<div id="multipleChoice">
							<table>	
								<tr>
									<td>
										Select Question Type
									</td>
								</tr>
								<tr>
									<td>
										<form>
											<input id="mc" type="radio" name="questionType" value="mc">Multiple Choice<br>
											<input id="oe" type="radio" name="questionType" value="oe">Open Ended<br>
											<input id="tf" type="radio" name="questionType" value="tf">True/False
										</form>
									</td>
								</tr>
							</table>
						</div>
					</div>
					<div id="makeTest" class="button">Make Test</div>
					<div id="makeTestDropDown" class="buttonDropDown">Some dummy text</div>
					<div id="GetReport" class="button">Get Report</div>
					<div id="GetReportDropDown" class="buttonDropDown">
						<div id="openEndedDiv" style="padding:20px">
							<table>	
								<tr>
									<th>Choose a range</th>
								</tr>
								<tr>
									<td><br></td><td><br></td>
								</tr>		
								<tr>
									<td>Start Date</td>
								</tr>	
								<tr>
									<td><input type="date"></input></td>
								</tr>
								<tr>
									<td><br></td><td><br></td>
								</tr>
								<tr>
									<td>End Date</td>
								</tr>		
								<tr>
									<td><input type="date"></input</td>
								</tr>
								<tr>
									<td><br></td><td><br></td>
								</tr>		
								<tr>
									<td style="float:right"><input type="submit" value="Get Test Results"></input></td>
								</tr>
							</table>
						</div>
					</div>
					<div id="seeTest" class="button" >See Available Test</div>
					<div id="seeTestDropDown"class="buttonDropDown">Some dummy text<br>(data from the database will be populated in the main panel)</div>
					<div id="seeHistory" class="button">See Past Test Results</div>
					<div id="seeHistoryDropDown" class="buttonDropDown">Some dummy text<br>(data from the database will be populated in the main panel)</div>
				</div>
				<div id="rightPanel" class="roundBorder">
					<div style="left:35%;top:35%;opacity:0.1;filter:alpha(opacity=10);position:absolute;z-index:103"><img src="images/flag.gif"></img></div>
					<div style="left:35%;top:35%;opacity:0.8;filter:alpha(opacity=80);position:absolute;z-index:101"><img src="images/njit.jpg"></img></div>
				</div>
			</div>
		</body>
	</html>	
	';

}


    if((isset($_POST['user']) && isset($_POST['pwd']) ))
    {
		if($_POST['user'] != "" && $_POST['pwd'] != ""){
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
				if((isset($_GET['method']) != '1')){
					echo $inDBPage;
				}
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
		else{
			session_destroy(); 
			$userName = "";
			initializePages();
			if((isset($_GET['method']) != '1')){
				echo $homePage;
			}
		}
    }
    else
    {
		session_start();
		if(isset($_SESSION['userName']))
		{	
			if(isset($_POST['logOut'])){
				session_destroy();
				$userName = "";
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
			$userName = "";
			initializePages();
				echo $homePage;			
		}

    }
	
	//Receives and Ajax GET request, checks if the user session still exists, and forwards the Ajax request to the Controller
	if((isset($_GET['method']) && isset($_SESSION['userName']) )){
		if($_GET['method'] != "" && $_SESSION['userName'] != "" ){
			$param1;
			$param2;
			$param3;
			$param4;
			$param5;
			$param6;
			if(isset($_GET['param1'])){
				$param1 = '&param1='.$_GET['param1'];
			}else{
				$param1 = '';
			}
			if(isset($_GET['param2'])){
				$param2 = '&param2='.$_GET['param2'];
			}else{
				$param2 = '';
			}
			if(isset($_GET['param3'])){
				$param3 = '&param3='.$_GET['param3'];
			}else{
				$param3 = '';
			}
			if(isset($_GET['param4'])){
				$param4 = '&param4='.$_GET['param4'];
			}else{
				$param4 = '';
			}
			if(isset($_GET['param5'])){
				$param5 = '&param5='.$_GET['param5'];
			}else{
				$param5 = '';
			}
			if(isset($_GET['param6'])){
				$param6 = '&param6'.$_GET['param6'];
			}else{
				$param6 = '';
			}
			echo file_get_contents('http://web.njit.edu/~dj65/cs490/controller.php?method='.$_GET['method'].$param1.$param2.$param3.$param4.$param5.$param6);
			
		}
	}
    
?>

