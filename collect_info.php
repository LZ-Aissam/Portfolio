<?php
$ip = $_SERVER['REMOTE_ADDR'];
$json = file_get_contents("https://ipinfo.io/{$ip}/json");
$data = json_decode($json);

$ipv4 = $data->ip;
$ipv6 = $_SERVER['REMOTE_ADDR'];

// Enregistrez les informations dans un fichier texte
$file = fopen("visitors.txt", "a");
fwrite($file, "IPv4: $ipv4, IPv6: $ipv6\n");
fclose($file);

// Déclenchez le webhook Netlify
$webhookUrl = 'https://api.netlify.com/build_hooks/64e37fcc1db18c2962c5ade2';
$ch = curl_init($webhookUrl);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, '{}'); // Le corps de la requête est vide
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);

if (curl_errno($ch)) {
    echo 'Erreur lors de l\'appel du webhook Netlify : ' . curl_error($ch);
} else {
    echo 'Webhook Netlify déclenché avec succès !';
}

curl_close($ch);
?>
