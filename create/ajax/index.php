<?php
/*
Register for Timeline, by Dote. Thanks to ro.
*/
session_start();
error_reporting(0);

include('Mail.php');

set_error_handler(function($errno, $errstr, $errfile, $errline ){
    throw new ErrorException($errstr, $errno, 0, $errfile, $errline);
});


header('Content-Type: application/json');

define("RECAPTCHA_SECRET_KEY", "6Lds0qsUAAAAAKc1NFTQgRzRriSw4Ofo9seyiRYj");
define('MYSQL_USER', 'root');
define('MYSQL_PASS', '');
define('MYSQL_DB', 'timeline');
define('APILAYER_KEY', 'b178baae9acc886234b5df63540018dd');
define('SMTP_USER', 'someone@gmail.com');
define('SMTP_PASS', 'email password');
define('SMTP_HOST', 'smtp.gmail.com'); // change this for diff host
define('SMTP_PORT', '465'); // port may vary with diff host
$welcomeAuthText = <<<EOD
<html class="gr__localhost"><head> <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"> <style> *:before {box-sizing: border-box; } *:after {box-sizing: border-box; } body {background: #fff; color: #140b2f; font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif; font-size: 16px; -webkit-font-smoothing: antialiased; -moz-osx-font-smoothing: grayscale; font-weight: 400; line-height: 28px; overflow-x: hidden; } a:hover {color: #5e35b1; text-decoration: none; } a:focus {color: #5e35b1; text-decoration: none; } a:active {color: #5e35b1; text-decoration: none; } .btn:active {box-shadow: 0 0 0 1px rgba(20, 11, 47, 0.1), 0 0 0 4px rgba(91, 147, 255, 0.25); outline: none; } .btn:focus {box-shadow: 0 0 0 1px rgba(20, 11, 47, 0.1), 0 0 0 4px rgba(91, 147, 255, 0.25); outline: none; } .btn-primary:hover {background-color: #5e35b1; box-shadow: 0 0 0 1px #5e35b1, 0 2px 4px -2px rgba(0, 0, 0, 0.2); color: #fff; } .btn-primary:active {background: #512da8; box-shadow: 0 0 0 1px #512da8, 0 0 0 4px rgba(91, 147, 255, 0.25); color: #fff; } .btn-primary:focus {background: #512da8; box-shadow: 0 0 0 1px #512da8, 0 0 0 4px rgba(91, 147, 255, 0.25); color: #fff; } .btn-secondary:hover {background-color: #fafafb; color: #726d82; } .btn-secondary:focus {background-color: #fafafb; color: #726d82; } .devise-form .help-links a:hover {color: #512da8; } .devise-form .help-links a:focus {color: #512da8; } @keyframes shake {} .form-control:hover {box-shadow: 0 0 0 1px rgba(20, 11, 47, 0.2), 0 2px 4px -2px rgba(0, 0, 0, 0.2); } .form-control:focus {box-shadow: 0 0 0 1px rgba(20, 11, 47, 0.1), 0 0 0 4px rgba(91, 147, 255, 0.25); outline: 0; } .form-control[disabled="disabled"]:hover {border: 1px solid transparent; } .has-error .help-block::first-letter {text-transform: capitalize; } .has-error .form-control:focus {box-shadow: 0 0 0 1px #e45734, 0 2px 4px -2px rgba(0, 0, 0, 0.2); } body {margin: 0; } img {border-style: none; } body {background-color: #fff !important; } @media screen and (max-width: 512px) {.horizontal-form {flex-direction: column; } .horizontal-form .form-control {margin-bottom: 10px; } .flex-group {align-items: stretch; flex-direction: column; } .flex-group.half {max-width: 100%; } .flex-group.quarter {max-width: 100%; } } </style> </head> <body style="box-sizing: border-box; -webkit-tap-highlight-color: rgba(255,255,255,0); color: #140b2f; font-family: -apple-system, BlinkMacSystemFont, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, sans-serif; font-size: 16px; -webkit-font-smoothing: antialiased; -moz-osx-font-smoothing: grayscale; font-weight: 400; line-height: 28px; overflow-x: hidden; margin: 0;" bgcolor="#fff" data-gr-c-s-loaded="true"> <div class="dt-container narrow email" style="box-sizing: border-box; -webkit-tap-highlight-color: rgba(255,255,255,0); max-width: 568px; margin: 0 auto; padding: 48px 24px;"> <div class="hidden" style="box-sizing: border-box; -webkit-tap-highlight-color: rgba(255,255,255,0); color: #fff; display: none; font-size: 1px; line-height: 1px; max-height: 0; max-width: 0; opacity: 0; overflow: hidden;">Thanks for signing up! You’ve joined an awesome project - Timeline, over 100+ users who love the service we provide.</div> <a href="http://localhost/signup/" style="box-sizing: border-box; -webkit-tap-highlight-color: rgba(255,255,255,0); color: #512da8; outline: none; text-decoration: none; background-color: transparent; -webkit-text-decoration-skip: objects;" target="_blank">Timeline</a> <p style="box-sizing: border-box; -webkit-tap-highlight-color: rgba(255,255,255,0); "><img src="https://dovetailapp.com/assets/emails/welcome@2x-0412be5af2894865d654716800bda52958aecd27c5e991ddc7a018b555aff2cf.png" alt="Welcome@2x" style="box-sizing: border-box; -webkit-tap-highlight-color: rgba(255,255,255,0); display: block; border-radius: 3px; border: none;" width="500" height="308"></p> <h1 id="matthew-welcome-to-dovetail-were-very-excited-youre-here" style="box-sizing: border-box; -webkit-tap-highlight-color: rgba(255,255,255,0); font-size: 2em; font-weight: 600; line-height: 40px;  padding: 0;">{nickname}, welcome to Timeline! We’re very excited you have joined this amazing project.</h1> <p style="box-sizing: border-box; -webkit-tap-highlight-color: rgba(255,255,255,0); ">You have successfully registered your penguin, you can anytime login and play the cpps with the username and password you have set</p> <p style="box-sizing: border-box; -webkit-tap-highlight-color: rgba(255,255,255,0); ">In order to use the nickname as you set in-game, you have to verify this email. Once you do, your nickname is once'n-for-all yours!<br> Click on the button below (or copy paste the link below it in new tab) to authenticate your account. You may (not necessary) want to input your Security Pin during this process.</p> <hr style="box-sizing: content-box; -webkit-tap-highlight-color: rgba(255,255,255,0); background-color: #e7e6ea; height: 1px; overflow: visible; "> <p style="box-sizing: border-box; -webkit-tap-highlight-color: rgba(255,255,255,0); "><a class="btn btn-primary" href="http://create.localhost/activate.html?u={username}&k={key}" style="box-sizing: border-box; -webkit-tap-highlight-color: rgba(255,255,255,0); color: #fff; outline: none; text-decoration: none; border-radius: 3px; cursor: pointer; display: inline-block; font-size: 14px; font-weight: 600; height: 40px; text-align: center; -webkit-appearance: none; background-color: #512da8; box-shadow: 0 0 0 1px #512da8,0 2px 4px -2px rgba(0,0,0,0.2); -webkit-text-decoration-skip: objects; padding: 5px 16px; border: 1px solid transparent;" target="_blank">Authenticate This Email</a></p> <p style="box-sizing: border-box; -webkit-tap-highlight-color: rgba(255,255,255,0); "><a href="http://localhost:2083/{username}/auth/{key}" style="box-sizing: border-box; -webkit-tap-highlight-color: rgba(255,255,255,0); color: #512da8; outline: none; text-decoration: none; background-color: transparent; -webkit-text-decoration-skip: objects;" target="_blank">http://create.localhost/activate.html?u={username}&k={key}</a></p> <hr style="box-sizing: content-box; -webkit-tap-highlight-color: rgba(255,255,255,0); background-color: #e7e6ea; height: 1px; overflow: visible; "> </div>  </body></html>
EOD;

function post_request($url, $data)
{
    $post_data = http_build_query($data);
	$opts = array('http' =>
	    array(
	        'method'  => 'POST',
	        'header'  => 'Content-type: application/x-www-form-urlencoded',
	        'content' => $post_data
	    )
	);
	$context  = stream_context_create($opts);
	$response = file_get_contents($url, false, $context);

	return $response;
}

function recaptchaVerify() {
	if (!isset($_POST['captcha-response'])) {
		return false;
	}

	$response = $_POST['captcha-response'];
	$url = "https://www.google.com/recaptcha/api/siteverify?secret=".RECAPTCHA_SECRET_KEY."&response=".$response;

	$response = file_get_contents($url);
	$result = json_decode($response, true);

	return $result['success'] === true;
}

if (!isset($_SESSION['form_id']) || (isset($_GET['action']) && $_GET['action']=='init')) {
	// check if client is requesting to initiate a session, else kick his ass
	if (isset($_GET['action']) && $_GET['action'] == 'init') {
		if (!recaptchaVerify()) {
			print_r(json_encode(array('success' => false, 'response' => array('error' => ['recaptcha verification failed', 'blackhole detected :O']))));
			unset($_SESSION['form_id']);
			die();
		}

		$_SESSION['form_id'] = sha1($_POST['captcha-response']);

	} else {
		print_r(json_encode(array('success' => false, 'response' => array('error' => ['recaptcha verification failed', 'blackhole detected :O']))));
		die();
	}
}

$pdo = new PDO("mysql:host=localhost;dbname=".MYSQL_DB, MYSQL_USER, MYSQL_PASS);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

function validateNickname($nick) {
	global $result;
	global $pdo;

	$nick = trim($nick);
	$cnick = str_replace(' ', '', $nick);

	if (!preg_match('/^[a-zA-Z]+[a-zA-Z0-9._]+$/', $cnick)) {
		$result['response']['error']['nick-error'][] = 'Nickname can only contain alphabets, numbers and spaces.';
	}

	if (strlen($nick) > 12 || strlen($nick) < 4) {
		$result['response']['error']['nick-error'][] = "Nickname should contain 4 to 12 characters.";
	} 

	if (isset($result['response']['error']['nick-error'])) {
		return;
	} else {
		$exists = $pdo->query("SELECT COUNT(*) FROM `penguins` WHERE `nickname` = '".$nick."'")->fetchColumn() > 0;
		if ($exists) {
			$result['response']['error']['nick-error'][] = "Oops! That nickname is already taken, try another one";
		} else {
			$_SESSION['nickname'] = $nick;

			$result['success'] += 1;
			$result['response']['valid'][] = '#edit-nick';
		}
	}
}

function validateUsername($user) {
	global $result;
	global $pdo;

	$nick = trim($user);
	$cnick = str_replace(' ', '', $nick);

	if (!preg_match('/^[a-zA-Z]+[a-zA-Z0-9._]+$/', $cnick)) {
		$result['response']['error']['name-error'][] = 'Username can only contain alphabets, numbers and spaces.';
	}

	if (strlen($nick) > 12 || strlen($nick) < 4) {
		$result['response']['error']['name-error'][] = "Username should contain 4 to 12 characters.";
	} 

	if (isset($result['response']['error']['name-error'])) {
		return;
	} else {
		$exists = $pdo->query("SELECT COUNT(*) FROM `penguins` WHERE `username` = '".$nick."'")->fetchColumn() > 0;
		if ($exists) {
			$result['response']['error']['name-error'][] = "Oops! That username is already taken, try another one";
		} else {
			$_SESSION['username'] = $nick;

			$result['success'] += 1;
			$result['response']['valid'][] = '#edit-name';
		}
	}

}

function validateEmail($email) {
	global $result;
	global $pdo;

	// email health check
	try {
		$antideoHealthCheck = file_get_contents('http://api.antideo.com/email/'.$email);
		$health = json_decode($antideoHealthCheck, true);
		if (isset($health['error'])) {
			$result['response']['error']['email-error'][] = "Email doesn't exist";
			return;
		} else 
		if ($health['spam'] || $health['scam'] || $health['disposable']) {
			$result['response']['error']['email-error'][] = "Email found to be spam/scam/disposable";
			return;
		}

	} catch (Exception $e) {}

	try {
		$apiLayerHealthCheck = file_get_contents('https://apilayer.net/api/check?access_key='.APILAYER_KEY.'&email='.$email);
		$health = json_decode($apiLayerHealthCheck, true);
		if (isset($health['error']) || !$health['smtp_check']) {
			$result['response']['error']['email-error'][] = "Email doesn't exist";
			return;
		}

	} catch (Exception $e) {}

	$limitExceed = $pdo->query("SELECT COUNT(*) FROM `penguins` WHERE `email` = '".$email."'")->fetchColumn() > 5;
	if ($limitExceed) {
		$result['response']['error']['email-error'][] = "Uhoh! This email address is already linked to max (5 other) users. Try another one.";
	} else {
		$_SESSION['email'] = $email;

		$result['success'] += 1;
		$result['response']['valid'][] = '#edit-email';
	}	
}

function validatePassword($pass) {
	global $result;

	if (strlen($pass) < 8) {
		$result['response']['error']['pass-error'][] = "Password should have at-least 8 characters.";
	} else {
		$_SESSION['password'] = md5($pass);

		$result['success'] += 1;
		$result['response']['valid'][] = '#edit-pass';
	}
}

function createUser() {
	global $result;
	global $pdo;

	if (!recaptchaVerify()) {
		$result['response']['error'][] = 'Captcha authentication failed.';
		return;
	}

	if (!isset($_POST['formId']) || $_POST['formId'] != $_SESSION['form_id']) {
		$result['response']['error'][] = 'Dumbo, stop trying to mess with my register';
		return;
	}

	$color = isset($_POST['color']) ? $_POST['color'] : 1;
	if (!in_array($color, [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 15, 16])) {
		$result['response']['error'][] = 'Invalid color. Dumbo, stop trying to screw up the register.';
		return;
	}

	if (!isset($_SESSION['username']) || !isset($_SESSION['nickname']) || !isset($_SESSION['email']) || !isset($_SESSION['password'])) {
		$result['response']['error'][] = 'Bot/Script detected. Unable to verify user data.';
		return;
	}

	$u = $_SESSION['username'];
	$p = $_SESSION['password'];
	$e = $_SESSION['email'];
	$n = $_SESSION['nickname'];

	$_SESSION = array();
	session_destroy();

	// try creating user
	$insertStmt = $pdo->prepare("INSERT INTO `penguins` (`username`, `password`, `nickname`, `email`, `swid`) VALUES (?, ?, ?, ?, CONCAT('{', UUID(), '}'))");
	$insertStmt->execute(array($u, $p, $n, $e));

	$authKey = bin2hex(openssl_random_pseudo_bytes(32));
	$user_id = $pdo->lastInsertId();
	$updateStmt = $pdo->prepare("UPDATE `penguins` SET `hash` = ?, `Nickname` = ? WHERE `ID` = ?");
	$updateStmt->execute(array($authKey.';'.$n, 'P'.sprintf('%04d', $user_id), $user_id));

	$insertStmt = $pdo->prepare("INSERT INTO `avatars` VALUES (NULL, ?, 0, 0, 0, 0, 0, 0, 0, 0, 0, ?, 1)");
	$insertStmt->execute(array($user_id, $color));

	$insertStmt = $pdo->prepare("INSERT INTO `inventories` VALUES (NULL, ?, ?, NULL, 'Added on Signup'), (NULL, ?, 1600, NULL, 'Added on Signup')");
	$insertStmt->execute(array($user_id, $color, $user_id));

	$insertStmt = $pdo->prepare("INSERT INTO `coins` VALUES (NULL, ?, 500, 'Signup bonus +500', NULL)");
	$insertStmt->execute(array($user_id));

	$memberships = strtotime("+7 day");
	$insertStmt = $pdo->prepare("INSERT INTO `memberships` VALUES (NULL, ?, ?, CURRENT_TIMESTAMP, 'Redeemed during registration')");
	$insertStmt->execute(array($user_id, date('Y-m-d H:i:s', $memberships)));

	sendActivationMail($authKey, $n, $u, $e);
	$result['success'] = true;
}

function sendActivationMail($key, $n, $u, $e) {
	global $welcomeAuthText;
	// TO USE MAIL U NEED TO HAVE PEAR::MAIL INSTALLED
	try {
		$html = str_replace('{nickname}', $n, $welcomeAuthText);
		$html = str_replace('{username}', $u, $html);
		$html = str_replace('{key}', $key, $html);

		$recipients = $_SESSION['email'];

	    $headers['From']    = 'support@timeline';
	    $headers['To']      = $e;
	    $headers['Subject'] = 'Activate your account - Timeline';

	    $body = $html;

	    $smtpinfo["host"] = SMTP_HOST;
	    $smtpinfo["port"] = SMTP_PORT;
	    $smtpinfo["auth"] = true;
	    $smtpinfo["username"] = SMTP_USER;
	    $smtpinfo["password"] = SMTP_PASS;


	    // Create the mail object using the Mail::factory method
	    $mail_object =& Mail::factory("smtp", $smtpinfo); 

    	$mail_object->send($recipients, $headers, $body);	
	} catch (Exception $e) { }
}

function activateUser() {
	global $result;
	global $pdo;

	if (!recaptchaVerify()) {
		$result['response']['error'][] = 'Captcha authentication failed.';
		return;
	}

	if (!isset($_POST['formId']) || $_POST['formId'] != $_SESSION['form_id']) {
		$result['response']['error'][] = 'Dumbo, stop trying to mess with me';
		return;
	}

	$u = $_POST['u'];
	$k = $_POST['k'];

	$_SESSION = array();
	session_destroy();

	// try activating the user
	$selectStmt = $pdo->prepare("SELECT `hash` FROM `penguins` WHERE `username` = ?");
	$selectStmt->execute(array($u));
	$hash = $selectStmt->fetch(PDO::FETCH_ASSOC);
	if(!!!$hash) {
		$result['response']['error'][] = 'Could you stop, you are such an embarrasment!';
		return;
	}
	$hash = $hash['hash'];
	
	if ($hash == '' || !$hash || strpos($hash, ';')===false) {
		$result['response']['error'][] = 'User already authenticated';
		return;
	}

	$d = explode(';', $hash);
	$hash = $d[0];
	$nick = $d[1];

	if ($hash != $k) {
		$result['response']['error'][] = 'My goodness, wrong activation key. What are you even trying to do?';
		return;
	}

	$updateStmt = $pdo->prepare("UPDATE `penguins` SET `nickname` = ? WHERE `username` = ?");
	$updateStmt->execute(array($nick, $u));

	$result['success'] = true;
	$result['response']['activation'] = 'account.activated';
    
    $pdo->prepare("UPDATE `penguins` SET `hash` = '' WHERE `username` = ?")->execute(array($u));
}

$action = isset($_GET['action']) ? $_GET['action'] : null;
$result = array('success' => null, 'response' => array('error' => array()));

if ($action == 'init') {
	$result['success'] = true;
	$result['response']['formId'] = $_SESSION['form_id'];
} else 

if ($action == 'validate') {
	$result['success'] = 0;
	foreach ($_POST as $key => $value) {
		if ($key == 'nick') validateNickname($value);
		else if ($key == 'name') validateUsername($value);
		else if ($key == 'email') validateEmail($value);
		else if ($key == 'pass') validatePassword($value);
	}
} else

if ($action == 'create-user') {
	createUser();
} else

if ($action == 'activate') {
	activateUser();
}

else {
	$result['response']['error'] = ['unknown action', 'pouncing cat detected'];
}

if (count($result['response']['error']) < 1) {
	unset($result['response']['error']);
}

print_r(json_encode($result));
die();
?>
