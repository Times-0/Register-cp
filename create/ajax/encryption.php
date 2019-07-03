<?php
// AS3 bcrypt passwords :) 
function encryptPassword($password, $md5 = true) {
	if($md5 !== false) {
		$password = md5($password);
	}
	$hash = substr($password, 16, 16) . substr($password, 0, 16);
	return $hash;
}

function getLoginHash($password, $staticKey, $username) {		
	$hash = encryptPassword($password, false);
	$hash .= $staticKey;
	$hash .= "a1ebe00441f5aecb185d0ec178ca2305Y(02.>'H}t\":E1_root";
	$hash = encryptPassword($hash);
	$hash = password_hash($hash, PASSWORD_DEFAULT, [ 'cost' => 12 ]);
	
	return $hash;
}


?>