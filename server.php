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


function callAPI($symbol){ //this may error but I don't know how yet.
$option = new AlphaVantage\Options();
$option->setApiKey('AYQ0BP2TLT4GMHRM');
$client = new AlphaVantage\Client($option);
$out['returnCode'] = 2; //by default we're going to pretend we're in error state
try{
$data =  $client->timeseries()->globalQuote($symbol);
//var_dump($data);

$out['returnCode'] = 1;
$out['symbol']	 = $data['Global Quote']['01. symbol'];
$out['open']	 = $data['Global Quote']['02. open'];
$out['high']	 = $data['Global Quote']['03. high'];
$out['low']	 = $data['Global Quote']['04. low'];
$out['price']	 = $data['Global Quote']['05. price'];
$out['volume']	 = $data['Global Quote']['06. volume'];
$out['prvclose'] = $data['Global Quote']['08. previous close'];
}catch (Exception $e){
$out['returnCode'] = 0;
echo "Bad API call, stock does not exist";
}finally{
var_dump($out);
return $out;
}
}
//DAS IT MANE, I GOT IT WOOOOO!!!!!!


function requestProcessor($request)
{
  echo "received request".PHP_EOL;
  //var_dump($request);


  if(!isset($request))
  {
    return "ERROR: no stock symbol set";
  }else{
	$response = callAPI($request);
	return $response;
  }
} 

$server = new rabbitMQServer("rabbit/rabbit.ini","dmz");

echo "Stock API Awaiting Requests".PHP_EOL;
$server->process_requests('requestProcessor');
echo "testRabbitMQServer END".PHP_EOL;
exit();

?>

