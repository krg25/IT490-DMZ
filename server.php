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
$data =  $client->timeseries()->globalQuote($symbol);
$out['returnCode'] = 1;
$out['symbol']	 = $data['01. symbol'];
$out['open']	 = $data['02. open'];
$out['high']	 = $data['03. high'];
$out['low']	 = $data['04. low'];
$out['price']	 = $data['05. price'];
$out['volume']	 = $data['06. volume'];
$out['prvclose'] = $data['08 previous close'];
return $out;
}
//DAS IT MANE, I GOT IT WOOOOO!!!!!!


function requestProcessor($request)
{
  echo "received request".PHP_EOL;
  var_dump($request);


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

