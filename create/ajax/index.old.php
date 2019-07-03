<?php

include_once 'encryption.php';


//error_reporting(0);

$details = array(
	"success" => '',
	"error"   => ''
);

if (isset($_POST['on']) && isset($_POST['value'])){
	$onClick = $_POST['on'];
	$value = $_POST['value'];

	if ($onClick == 'username_click_'){
		if (strlen($value) >= 4 && preg_match('/^[a-zA-Z0-9 ]+$/', $value)){
			$pdo = new PDO('mysql:host=localhost;dbname=MyDBName', 'MySQLUserName', 'MySQLPassword');
			$cursor = $pdo->prepare("SELECT `Username` FROM `penguin` WHERE `Username` = '".$value."'");
			$cursor->execute();
			
			$exist = true;
			if (!$cursor->rowCount() > 0){
				$exist = false;
			}

			if (!$exist){
				$details['success'] = 'Username available!';
			} else {
				$details['error'] = 'Username already taken, choose another name';
			}
		} else {
			if ($value == ''){
				$details['error'] = "You need to name your Penguin!";
			} else if (strlen($value) < 4){
				$details['error'] = "Penguin name must be atleast 4 characters long";
			} else if (!preg_match('/^[a-zA-Z0-9 ]+$/', $value)){
				$details['error'] = "Penguin names can have only letters numbers and spaces";
			}
		}
	} else if ($onClick == 'password_click_'){
		if (strlen($value) < 6){
			$details['error'] = "Please enter 6 or more letters or numbers";
		} else {
			$details['success'] = "Password accepted!";
		}
	} else if ($onClick == "email_click_"){
		if (!preg_match("/^[+a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/", $value)){
			$details['error'] = "The email address is not entered correctly. Please try again";
		} else {
			$pdo = new PDO('mysql:host=localhost;dbname=MyDBName', 'MySQLUserName', 'MySQLPassword');
			$cursor = $pdo->prepare("SELECT `Username` FROM `penguin` WHERE `Email` = '".$value."'");
			$cursor->execute();
			
			$exist = true;
			if (!$cursor->rowCount() > 0){
				$exist = false;
			}
			if ($exist){
				$details['error'] = "This email address in already in use. Please try again";
			} else {
				$details['success'] = "Email Accepted!";
			}
		}
	} else if ($onClick == 'form_submit__'){
		preg_match('/{(.*?)}/', $value['formBuild'], $build);
		preg_match('/{(.*?)}/', $value['formId'], $formID);
		if (strlen($build[1]) == 50 && $formID[1] == "penguin_create_form" && substr($value['formId'], -9) == "?Yes=No!!" && 
			$value['submit'] == 'Create Your Penguin' && $value['terms'] == 'Yeah! Terms are accepted!!' && $value['show_pass'] == 'In-declarance' &&
			in_array($value['color'], explode(",", implode(",", array_merge(range(1, 13), array(15, 16))))) && in_array($value['captcha'], range(0, 2)) && 
			$value['form'] == 'penguin-create-form' && strlen($value['name']) > 3 && strlen($value['name']) < 13 && 
			preg_match("/^[+a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/", $value['mail']) && preg_match('/^[a-zA-Z0-9 ]+$/', $value['name']) &&
			substr($value['formId'], 13, 9) == "<mailing>" && $value['swid'] != '') {

			$pdo = new PDO('mysql:host=localhost;dbname=MyDBName', 'MySQLUserName', 'MySQLPassword');
			$cursor = $pdo->prepare("SELECT `Username` FROM `penguin` WHERE `Username` = '".$value['name']."'");
			$cursor->execute();
			
			$exist = true;
			if (!$cursor->rowCount() > 0){
				$exist = false;
			}

			if (!$exist){
				$pdo = new PDO('mysql:host=localhost;dbname=MyDBName', 'MySQLUserName', 'MySQLPassword');
				$cursor = $pdo->prepare("SELECT `Username` FROM `penguin` WHERE `Email` = '".$value['mail']."'");
				$cursor->execute();
				
				$exist = true;
				if (!$cursor->rowCount() > 0){
					$exist = false;
				}
				if ($exist){
					//$details['error'] = "This email address in already in use. Please try again";
					$details['error'] = 'Cannot process your request, An error has occured. Refresh and try again!';
				} else {
					// Don't check for Password, Bloody hackers let them be affected by it ;)
					try{
						$pdo = new PDO("mysql:host=localhost;dbname=MyDBName", "MySQLUserName", "MySQLPassword");

						$password = $value['pass'];
						
						$username = $value['name'];
						$email = $value['mail'];
						$color = $value['color'];
						$date = new DateTime();
						$date = $date->format("y:m:d h:i:s");
						$penguinId = '2';
						$hashedPassword = strtoupper(hash("md5", $password));
						$staticKey = 'houdini';
						$fancyPassword = getLoginHash($hashedPassword, $staticKey, $username); // MyDBName bcrypt passwords
						
						$insertPenguin = "INSERT INTO `penguin` (`ID`, `Username`, `Nickname`, `Approval`, `Password`, `LoginKey`, `ConfirmationHash`, `Email`, `RegistrationDate`, `Active`, `Igloo`, `LastPaycheck`, `MinutesPlayed`, `Moderator`, `MascotStamp`, `Coins`, `Color`, `Head`, `Face`, `Neck`, `Body`, `Hand`, `Feet`, `Photo`, `Flag`, `Permaban`, `BookModified`, `BookColor`, `BookHighlight`, `BookPattern`, `BookIcon`, `AgentStatus`, `FieldOpStatus`, `CareerMedals`, `AgentMedals`, `LastFieldOp`, `NinjaRank`, `NinjaProgress`, `FireNinjaRank`, `FireNinjaProgress`, `WaterNinjaRank`, `WaterNinjaProgress`, `NinjaMatchesWon`, `FireMatchesWon`, `WaterMatchesWon`, `RainbowAdoptability`, `HasDug`, `Nuggets`)";
						$insertPenguin .= "VALUES (NULL, :Username, :Username, :one, :Password, :blank, :blank, :Email, :date, :one, :one, :date, :zero, :zero, :zero, :cc, :Color, :zero, :zero, :zero, :zero, :zero, :zero, :zero, :zero, :zero, :zero, :one, :one, :one, :one, :zero, :zero, :zero, :zero, :date, :zero, :zero, :zero, :zero, :zero, :zero, :zero, :zero, :zero, :zero, :one, :zero);";
						$insertStatement = $pdo->prepare($insertPenguin);
						$insertStatement->bindValue(":Username", $username);
						$insertStatement->bindValue(":Password", $fancyPassword);
						$insertStatement->bindValue(":Email", $email);
						$insertStatement->bindValue(":Color", $color);
						$insertStatement->bindValue(":date", $date);
						$insertStatement->bindValue(":blank", '');
						$insertStatement->bindValue(":zero", '0');
						$insertStatement->bindValue(":Approval", '1');
						$insertStatement->bindValue(":cc", '500');
						$insertStatement->bindValue(":one", '1');

						$insertStatement->execute();	

						$penguinId = $pdo->lastInsertId();

						

						$details['success'] = 'Your penguin has been created, enjoy!';
					} catch (Exception $e){
						//error
						$details['error'] = 'Cannot process your request, An error has occured. Refresh and try again!';

					}
				}
				
			} else {
				//$details['error'] = 'Username already taken, choose another name';
				$details['error'] = 'Cannot process your request, An error has occured. Refresh and try again!';
			}

		} else {
			$details['error'] = 'Cannot process your request, An error has occured. Refresh and try again!';
		}
	}
	print_r(json_encode($details));
	
} else {
	die();
}

?>