
        
<?php
//receiving currency 

 
$json = file_get_contents('http://data.fixer.io/api/latest?access_key=1b38cc4d8959e0d8b94212a76552605a');

$data = json_decode($json, True);

$usdValue;
$eurValue;
$gbpValue;
$jpyValue;

foreach ($data['rates'] as $key => $value) {

    if ($key == "USD") { $usdValue = $value; }

    if ($key == "EUR") { $eurValue = $value; }

    if ($key == "GBP") { $gbpValue = $value; }

    if ($key == "JPY") { $jpyValue = $value; }
}


          


// receiving and send messages with telegram 


$botToken = "651509114:AAE2A5i1p1PtL_XztkuWGPHo-YeRjmnTOy8"; 
$website = "https://api.telegram.org/bot".$botToken ; 

$update = file_get_contents($website."/getupdates");

$updateArray = json_decode($update ,TRUE);  


print_r($updateArray);

$countLast= count($updateArray['result']);


for ($n = 0; $n <= $countLast+1; $n++) {
    
}
 $text = $updateArray['result'][$countLast - 1]['message']['text'];

$chatId = $updateArray["result"][$countLast - 1]["message"]["chat"]["id"];



if (strpos($text, 'USD') !== false) {
   file_get_contents($website."/sendmessage?chat_id=".$chatId."&text=".'Your usd rate is  '.$usdValue);
}
if (strpos($text, 'usd') !== false) {
   file_get_contents($website."/sendmessage?chat_id=".$chatId."&text=".'Your usd rate is  '.$usdValue);
}
if (strpos($text, 'EUR') !== false) {
    file_get_contents($website."/sendmessage?chat_id=".$chatId."&text=".'Your EUR rate is  '.$eurValue);
}
if (strpos($text, 'eur') !== false) {
   file_get_contents($website."/sendmessage?chat_id=".$chatId."&text=".'Your eur rate is  '.$eurValue);
}
if (strpos($text, 'GBP') !== false) {
   file_get_contents($website."/sendmessage?chat_id=".$chatId."&text=".'Your GBP rate is  '.$gbpValue);
}
if (strpos($text, 'gbp') !== false) {
    file_get_contents($website."/sendmessage?chat_id=".$chatId."&text=".'Your GBP rate is  '.$gbpValue);
}
if (strpos($text, 'JPY') !== false) {
   file_get_contents($website."/sendmessage?chat_id=".$chatId."&text=".'Your JPY rate is  '.$jpyValue);
}
if (strpos($text, 'jpy') !== false) {
   file_get_contents($website."/sendmessage?chat_id=".$chatId."&text=".'Your JPY rate is  '.$jpyValue);
}
if ($text == 'Hi') {
   file_get_contents($website."/sendmessage?chat_id=".$chatId."&text=".'Hi');
}
if ($text =='How are you') {
    
   
   file_get_contents($website."/sendmessage?chat_id=".$chatId."&text=".'i m fine and you');
}
if ($text == 'I m ok') {
   file_get_contents($website."/sendmessage?chat_id=".$chatId."&text=".'How can i help you ?');
}





 



 

  ?>
      
    
   