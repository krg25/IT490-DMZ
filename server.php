#!/usr/bin/php
<?php
require_once('rabbit/path.inc');
require_once('rabbit/get_host_info.inc');
require_once('rabbit/rabbitMQLib.inc');
require_once('vendor/autoload.php');
ini_set('display_errors', 'On');

use AlphaVantage\Api\AbstractApi;

use AlphaVantage\Client;
use AlphaVantage\Exception;
use AlphaVantage\Options;

$option = new AlphaVantage\Options();
$option->setApiKey('AYQ0BP2TLT4GMHRM');
$client = new AlphaVantage\Client($option);
$data =  $client->timeseries()->globalQuote('GOOGL');
var_dump($data);

//DAS IT MANE, I GOT IT WOOOOO!!!!!!

/*
function requestProcessor($request)
{
  echo "received request".PHP_EOL;
  var_dump($request);


  if(!isset($request['type']))
  {
    return "ERROR: unsupported message type";
  }
  switch ($request['type'])
  {
    case "Login":
    $login=doLogin($request['username'],$request['password']);
    if($login['0']){
	return array("returnCode" => '1', 'message'=>"Successful Login", 'ID' => $login['id']);	
	}
	else
	{
	  return array("returnCode" => '2', 'message'=>"Unsuccessful Login");
	}
    

     case "validate_session":
      return doValidate($request['sessionId']);
  }

   return array("returnCode" => '0', 'message'=>"Error, unsupported message type");
}

$server = new rabbitMQServer("rabbit/rabbit.ini","dmz");

echo "testRabbitMQServer BEGIN".PHP_EOL;
$server->process_requests('requestProcessor');
echo "testRabbitMQServer END".PHP_EOL;
exit();
*/
?>

