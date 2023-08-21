<?php
$ip = $_SERVER['REMOTE_ADDR'];
$json = file_get_contents("https://ipinfo.io/{$ip}/json");
$data = json_decode($json);

$ipv4 = $data->ip;
$ipv6 = $_SERVER['REMOTE_ADDR']; // L'IPv6 du visiteur

// Récupérez d'autres informations de localisation si nécessaire, par exemple : $city = $data->city;

// Enregistrez les informations dans un fichier texte
$file = fopen("visitors.txt", "a");
fwrite($file, "IPv4: $ipv4, IPv6: $ipv6\n");
fclose($file);
?>
