<?php 

  $cpanelhost = 'localhost'; 
  $cpaneluser = 'root';
  $cpanelpass = 'pass';
  $cpaneltheme = 'justhost';

function create_subdomain($domainName, $pathDomain, $rootDomain) {

	//Generate URL for access the subdomain creation in cPanel through PHP
	$buildRequest = "/frontend/".$cpaneltheme."/subdomain/doadddomain.html?rootdomain=" . $rootDomain . "&domain=" . $domainName . "&dir=".$_SERVER['DOCUMENT_ROOT']."/".$pathDomain;
	
	//Open the socket
	$openSocket = fsockopen('localhost',2082);
	
	if(!$openSocket) {
		//SHow error
		return "Socket error";
		exit();
	}
	
	//Login Details
	$authString = $cpaneluser . ":" . $cpanelpass;
	
	//Encrypt the Login Details
	$authPass = base64_encode($authString);
	
	//Request to Server using GET method
	$buildHeaders = "GET " . $buildRequest ."\r\n";
	
	//HTTP
	$buildHeaders .= "HTTP/1.0\r\n";
	//Define Host
	$buildHeaders .= "Host:localhost\r\n";
	
	//Request Authorization
	$buildHeaders .= "Authorization: Basic " . $authPass . "\r\n";
	$buildHeaders .= "\r\n";
	
	//fputs
	fputs($openSocket, $buildHeaders);
	while(!feof($openSocket)) {
	fgets($openSocket,128);
	}
	fclose($openSocket);
	
	//Return the New SUbdomain with full URL
	$newDomain = "http://" . $domainName . "." . $rootDomain . "/";
	
	//return with Message
	echo "Created subdomain ".$newDomain;
  }

?>

<html>
<head>
<title> cPanel Subdomain Creator </title>
</head>

<body>

<form name="subdomain" method="post" action="index.php"> 
  <input type="text" name="subdomain" placeholder="Subdomain name" /> <br />
  <input type="text" name="domain" placeholder="Your main domain name" /> <br />
  <input type="text" name="path" placeholder="Enter Path" /> <br />
  <input type="submit" name="submit" value="Create Subdomain"/>
</form>


<?php

if (isset($_POST["submit"]) && !empty($_POST["subdomain"])) && !empty($_POST["domain"])) && !empty($_POST["path"])) {
    echo "Please fill in the information.";    
}else{  

  $domainName = $_POST["subdomain"];
  $pathDomain = $_POST["path"];
  $rootDomain = $_POST["domain"];

function create_subdomain($domainName, $pathDomain, $rootDomain) {

	//Generate URL for access the subdomain creation in cPanel through PHP
	$buildRequest = "/frontend/".$cpaneltheme."/subdomain/doadddomain.html?rootdomain=" . $rootDomain . "&domain=" . $domainName . "&dir=".$_SERVER['DOCUMENT_ROOT']."/".$pathDomain;
	
	//Open the socket
	$openSocket = fsockopen('localhost',2082);
	
	if(!$openSocket) {
		//SHow error
		return "Socket error";
		exit();
	}
	
	//Login Details
	$authString = $cpaneluser . ":" . $cpanelpass;
	
	//Encrypt the Login Details
	$authPass = base64_encode($authString);
	
	//Request to Server using GET method
	$buildHeaders = "GET " . $buildRequest ."\r\n";
	
	//HTTP
	$buildHeaders .= "HTTP/1.0\r\n";
	//Define Host
	$buildHeaders .= "Host:localhost\r\n";
	
	//Request Authorization
	$buildHeaders .= "Authorization: Basic " . $authPass . "\r\n";
	$buildHeaders .= "\r\n";
	
	//fputs
	fputs($openSocket, $buildHeaders);
	while(!feof($openSocket)) {
	fgets($openSocket,128);
	}
	fclose($openSocket);
	
	//Return the New SUbdomain with full URL
	$newDomain = "http://" . $domainName . "." . $rootDomain . "/";
	
	//return with Message
	echo "Created subdomain ".$newDomain;
  }
}
?>

</body>
</html>
