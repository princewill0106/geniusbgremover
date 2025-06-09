<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $apiKey = 'ZWKEY3HyEAGNgzhH2QtphdF3';

    $file = $_FILES['image']['tmp_name'];
    $cfile = new CURLFile($file, $_FILES['image']['type'], $_FILES['image']['name']);

    $curl = curl_init();

    curl_setopt_array($curl, [
        CURLOPT_URL => "https://api.remove.bg/v1.0/removebg",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => ['image_file' => $cfile, 'size' => 'auto'],
        CURLOPT_HTTPHEADER => ["X-Api-Key: $apiKey"]
    ]);

    $response = curl_exec($curl);
    $http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    curl_close($curl);

    if ($http_code == 200) {
        header("Content-Type: image/png");
        echo $response;
    } else {
        http_response_code($http_code);
        echo $response;
    }
}
?>
