<?php
$botToken = "7194149111:AAE-0PRd8EyhbOSiFEjk068Qmp5lMaLJO78";
$chatId = "5589888565";

if (!isset($_FILES['photos'])) {
    die("Không có ảnh nào được chọn.");
}

foreach ($_FILES['photos']['tmp_name'] as $key => $tmp_name) {
    if ($_FILES['photos']['error'][$key] == 0) {
        $filePath = $_FILES['photos']['tmp_name'][$key];
        
        // Gửi ảnh lên Telegram
        $url = "https://api.telegram.org/bot$botToken/sendPhoto";
        $postFields = [
            'chat_id' => $chatId,
            'photo' => new CURLFile($filePath)
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
    }
}

echo "Ảnh đã được gửi lên Telegram!";
?>
