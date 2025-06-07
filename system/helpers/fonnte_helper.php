<?php

function send_wa_message($target, $message, $token, $options = [])
{
    $payload = [
        'target' => $target, // Format: '08xxxxx|Nama|Role'
        'message' => $message,
        'countryCode' => '62',
    ];

    // Tambahkan opsional parameter jika ada
    if (isset($options['url']))
        $payload['url'] = $options['url'];
    if (isset($options['filename']))
        $payload['filename'] = $options['filename'];
    if (isset($options['schedule']))
        $payload['schedule'] = $options['schedule'];
    if (isset($options['typing']))
        $payload['typing'] = $options['typing'];
    if (isset($options['delay']))
        $payload['delay'] = $options['delay'];
    if (isset($options['location']))
        $payload['location'] = $options['location'];
    if (isset($options['followup']))
        $payload['followup'] = $options['followup'];
    if (isset($options['file']))
        $payload['file'] = new CURLFile($options['file']); // full path

    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.fonnte.com/send',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => $payload,
        CURLOPT_HTTPHEADER => array(
            'Authorization: ' . $token
        ),
    ));

    $response = curl_exec($curl);
    $error = curl_error($curl);
    curl_close($curl);

    if ($error) {
        return ['status' => false, 'error' => $error];
    } else {
        return ['status' => true, 'response' => $response];
    }
}
?>