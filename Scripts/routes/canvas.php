<?php

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://canvas.instructure.com/" . $_REQUEST['api'],
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_POSTFIELDS => "{\"status\":\"publish\"}",
  CURLOPT_HTTPHEADER => array(
    "Accept: */*",
    "Accept-Encoding: gzip, deflate",
    "Authorization: Bearer " . $_REQUEST['token'],
    "Connection: keep-alive",
    "Content-Length: 20",
    "Content-Type: application/json",
    "Cookie: _csrf_token=uiwSAqRrtI9aaTu6Mw2HARgvTSMAW241RrvF6JmvnJPiGGtN9A3xui4mQtxYXeNEYE1%2FZzkpH3QW7aObrd76yQ%3D%3D; log_session_id=77151061ca9e712ce4837c3f867b6b93; canvas_session=SnirbucBmqxEJZ64VR-Kcw.4M5wgRlDmNr0rJUaxoM3FAADPZD5DkwxuqWQGVUXn9VtwZvepnyhyZJzo4woUNBxGOsGHSgArdisMonkLbdBboNuDkVCcNIrqP40iEjeh4_8AAAFHi2Vt86nfW7N63fd.9WAxL0Gi8IRfMbHBpp72j3lpgCg.Xa9Jlw",
    "Host: canvas.instructure.com",
    "User-Agent: PostmanRuntime/7.19.0"
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

?>
