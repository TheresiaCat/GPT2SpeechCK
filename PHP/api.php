<?php
header("Access-Control-Allow-Origin: http://localhost:3000");

session_start(); // Starte die PHP-Session

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['demoMessage'])) {
        $demomessage = $_POST['demoMessage'];
        $_SESSION['savedMessage'] = $demomessage; // Speichere die Nachricht in der Session
    }
}

//Ausgabe von Bot 
//echo $_SESSION['savedMessage'];

//Text to Speech API
/*
$curl = curl_init();

curl_setopt_array($curl, [
	CURLOPT_URL => "https://large-text-to-speech.p.rapidapi.com/tts",
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_ENCODING => "",
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 30,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => "POST",
	CURLOPT_POSTFIELDS => json_encode([
		'text' => $demomessage
	]),
	CURLOPT_HTTPHEADER => [
		"X-RapidAPI-Host: large-text-to-speech.p.rapidapi.com",
		"X-RapidAPI-Key: a1106a51a7mshabb6b0762adb30dp1fb556jsn9a8a40a21773",
		"content-type: application/json"
	],
]);
$response = curl_exec($curl);
curl_close($curl);


$data = json_decode($response);
$processing = $data -> status=="processing"; 
while($processing){
    sleep($data -> eta); 
    $curl = curl_init();
    curl_setopt_array($curl, [
        CURLOPT_URL => "https://large-text-to-speech.p.rapidapi.com/tts?id=".$data->id,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_POSTFIELDS => json_encode([
            'text' => $demomessage 
        ]),
        CURLOPT_HTTPHEADER => [
            "X-RapidAPI-Host: large-text-to-speech.p.rapidapi.com",
            "X-RapidAPI-Key: a1106a51a7mshabb6b0762adb30dp1fb556jsn9a8a40a21773",
            "content-type: application/json"
        ],
    ]);
    $response2=curl_exec($curl); 
    $data2=json_decode($response2); 
    $processing = $data2 -> status ==="processing"; 
    if($data2 -> status == "fail"){
        die("API request failed"); 
    }
curl_close($curl);
}

/*
$file = fopen($data2->url, "r");
$size = fstat($file)["size"];
$content = fread($file,$size); 
fclose($file); 

header('content-type: audio/wav');
header('Content-Length: ' . $fsize);
*/

echo "https://s3.eu-central-1.amazonaws.com/tts-download/f5b8891f2b1b9d7e341f16df21026f70.wav?X-Amz-Algorithm=AWS4-HMAC-SHA256&X-Amz-Credential=AKIAZ3CYNLHHVKA7D7Z4%2F20231113%2Feu-central-1%2Fs3%2Faws4_request&X-Amz-Date=20231113T185154Z&X-Amz-Expires=86400&X-Amz-SignedHeaders=host&X-Amz-Signature=380bb8a507879f0ef632acad85ddc8d2373aafc06f06d86f3743e9d6f5fd74e5"; 
die; 

$err = curl_error($curl);

if ($err) {
	echo "cURL Error #:" . $err;
} else {
	echo $data2 ->url;
}
session_destroy();