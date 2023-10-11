<?php
// Function to generate YouTube titles using OpenAI API
function generate_youtube_title($input_text) {
    $api_key = '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';

    $data = array(
        'prompt' => $input_text,
        'max_tokens' => 10,
        'temperature' => 0.8,
        'n' => 1,
        'stop' => ['\n']
    );

    $headers = array(
        'Content-Type: application/json',
        'Authorization: Bearer ' . $api_key
    );

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://api.openai.com/v1/engines/davinci-codex/completions');
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);

    $json_response = json_decode($response, true);
    $generated_title = $json_response['choices'][0]['text'];

    return $generated_title;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['input_text'])) {
    echo generate_youtube_title($_POST['input_text']);
}
?>
