<?php
    $client_id = 'd8ae63b9fb3d4821a40bcfff6e7c0c6b'; 
    $client_secret = '94900dd4cfc0440dbd97c59065b2422e'; 
   

    // access token
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, "https://accounts.spotify.com/api/token");
    
    curl_setopt($curl, CURLOPT_POST, 1);
    
    curl_setopt($curl, CURLOPT_POSTFIELDS, 'grant_type=client_credentials'); 
    $headers = array("Authorization: Basic ".base64_encode($client_id.":".$client_secret));
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $result = curl_exec($curl);
    $token = json_decode($result)->access_token;

    curl_close($curl);    

    $curl = curl_init();
    
    curl_setopt($curl, CURLOPT_URL, "https://api.spotify.com/v1/search?type=playlist&q=orologio");
    
    $headers = array("Authorization: Bearer ".$token);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); 
    $res=curl_exec($curl);
    curl_close($curl);
    print_r($res);

?>