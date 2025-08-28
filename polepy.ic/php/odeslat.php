<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $jmeno  = htmlspecialchars($_POST['jmeno']);
    $email  = htmlspecialchars($_POST['email']);
    $typ = htmlspecialchars($_POST['typ']);
    $rozpocet   = htmlspecialchars($_POST['rozpocet']);

    $webhookurl = "https://discordapp.com/api/webhooks/1408413303176167514/0hc-S_ywNueYP2u5jR7n9XQC-y3lSbFbDRoKHdSj49bIKkWDhmJ9XAO8u7UK0zEIr7dp";


    $message  = "**📩 Nová objednávka polepu!**\n";
    $message .= "```👤 Jméno: $jmeno\n";
    $message .= "📧 Email: $email\n";
    $message .= "🚗 Vozidlo: $typ\n";
    $message .= "💰 Rozpočet: $rozpocet Kč```";

 
   $json_data = json_encode([
        "content" => "<@&1409969747306741831>\n" . $message,
        "allowed_mentions" => ["parse" => ["roles"]]
    ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

    $ch = curl_init($webhookurl);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-type: application/json']);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    $response = curl_exec($ch);
    if (curl_errno($ch)) {
        echo "Chyba: " . curl_error($ch);
    } else {
        echo "Všechno v pořádku!";
    }
    curl_close($ch);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
 
    header("Location: ../success_order.html");
    exit;

}

}
?>

