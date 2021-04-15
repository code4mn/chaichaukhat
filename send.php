<?php
$fields = array(
    "sender_id" => "FSTSMS",
    "message" => "This is Test message",
    "language" => "english",
    "route" => "p",
    "numbers" => "7235823944",
);

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://www.fast2sms.com/dev/bulk",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_SSL_VERIFYHOST => 0,
  CURLOPT_SSL_VERIFYPEER => 0,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => json_encode($fields),
  CURLOPT_HTTPHEADER => array(
    "authorization: s05j7DuIMlkARrxHXGdKVE2tCoZJbNqv6zw3LPTcY9OUigeBQ1UoYfPFHweIRLp7rlND0tWAiKbgTu85",
    "accept: */*",
    "cache-control: no-cache",
    "content-type: application/json"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  echo $response;
}
Promotional Route Success Response:
{
    "return": true,
    "request_id": "lwdtp7cjyqxvfe9",
    "message": [
        "Message sent successfully to NonDND numbers"
    ]
}
Transactional Route Success Response:
{
    "return": true,
    "request_id": "vrc5yp9k4sfze6t",
    "message": [
        "Message sent successfully"
    ]
}


?>