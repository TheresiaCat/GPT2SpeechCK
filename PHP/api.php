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
echo $_SESSION['savedMessage'];

//Text to Speech API
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
    print_r($data2); 
    $processing = $data2 -> status ==="processing"; 
    if($data2 -> status == "fail"){
        die("API request failed"); 
    }
curl_close($curl);
}


$err = curl_error($curl);



if ($err) {
	echo "cURL Error #:" . $err;
} else {
	echo $response;
}
session_destroy();