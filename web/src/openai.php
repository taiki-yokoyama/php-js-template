<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
header("Content-Type: application/json; charset=utf-8");

// APIキー（改行・空白なし）
define("OPENAI_API_KEY", getenv('API_KEY')); // 本番は環境変数推奨

// JSONリクエストを受け取る
$input = json_decode(file_get_contents("php://input"), true);
$name = $input["name"] ?? "";

// OpenAI APIにリクエスト
$ch = curl_init("https://api.openai.com/v1/chat/completions");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Content-Type: application/json",
    "Authorization: Bearer " . OPENAI_API_KEY,
]);

$data = [
    "model" => "gpt-4o-mini",
    "messages" => [
        ["role" => "system", "content" => "あなたはフレンドリーなアシスタントです。"],
        ["role" => "user", "content" => "この名前「{$name}」から面白い自己紹介を作ってください。"],
    ],
];

curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data, JSON_UNESCAPED_UNICODE));

$response = curl_exec($ch);

if ($response === false) {
    echo json_encode(["error" => curl_error($ch)]);
    exit;
}

curl_close($ch);

// OpenAIのレスポンスをそのまま返す
echo $response;
exit;
