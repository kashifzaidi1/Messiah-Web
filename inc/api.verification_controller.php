<?php

require 'autoload.php';
  /* --------------------------------------
  /* File to handle all API requests
  /* Accepts GET and POST
  /* --------------------------------------
  /* Each request will be identified by TAG
  /* Response will be JSON data
  /* --------------------------------------
  /* check for POST request 
  /*/
  if ((isset($_GET['VerificationCode']) && $_GET['VerificationCode'] != '') && (isset($_GET['PhoneNumber']) && $_GET['PhoneNumber'] != '')) {
	// get tag
	$VerificationCode = $_GET['VerificationCode'];
	$PhoneNumber = $_GET['PhoneNumber'];

	// include db handler
	$db = new \ClassLibrary\DBFunctions();

	// response Array
	$response = array("Status" => 0);

	// check for VarificationCode
	$user = $db->verifyUsingCode($PhoneNumber, $VerificationCode);
	if ($user != false) {
	  // Code Varified
	  // echo json with success = 1
	  $response["Status"] = 1;
	  echo json_encode($response);
  } else {
	  // Code not varified
	  // echo json with error = 1
	  $response["Status"] = 0;
	  echo json_encode($response);
  }
} else {
	echo "Access Denied";
}