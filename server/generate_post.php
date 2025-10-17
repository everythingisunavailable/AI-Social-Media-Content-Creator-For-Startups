<?php
require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../env.php';
require __DIR__ . '/session.inc.php';
require __DIR__ . '/product.php';

use GuzzleHttp\Client;

$product_id = $_POST['product_id'] ?? null;
$platforms = $_POST['platforms'] ?? [];
$ai_option = $_POST['ai_option'] ?? null;

$product = get_product($product_id);
$client = new Client([
    'base_uri' => 'https://api.groq.com/openai/v1/',
    'headers' => [
        'Authorization' => AI_API_KEY,
        'Content-Type'  => 'application/json',
    ]
]);

try {
    $response = $client->post('chat/completions', [
        'json' => [
            'model' => 'openai/gpt-oss-20b',
            'messages' => [
                ['role' => 'system', 'content' => 'You are a professional social media copywriter and content strategist. 
                                                    Your task is to create engaging, platform-appropriate captions based on:
                                                    1) The platform(s) chosen by the user (e.g. Instagram, TikTok, LinkedIn, Facebook, X/Twitter)
                                                    2) The product or service description provided by the user

                                                    Follow these rules:
                                                    - Adapt tone, format, and style to each platform:
                                                    • Instagram: trendy, casual, with emojis and hashtags
                                                    • TikTok: viral, playful, short, high energy
                                                    • LinkedIn: professional, value-driven, no slang, motivational
                                                    • Facebook: friendly, conversational, broad audience
                                                    • X/Twitter: concise, bold, punchy
                                                    - If multiple platforms are provided, generate **captions separately for each platform**.
                                                    - If the user provides a specific tone (e.g., “funny”, “luxurious”, “formal”), adapt all captions to match that tone in addition to the platform style.
                                                    - Prefix each caption with the platform name in square brackets, e.g. [Instagram], [LinkedIn]
                                                    - Separate each platform caption with **exactly one empty line**.
                                                    - Focus on benefits and emotional appeal of the product
                                                    - Use simple, scroll-stopping language
                                                    - Avoid generic phrases like “Introducing our product…”

                                                    Always output:
                                                    - **No placeholder words like “Caption”**
                                                    - MAIN caption text only
                                                    - Suggested hashtags if platform allows

                                                    Wait for the user to provide:
                                                    - Platform name(s)
                                                    - Product description

                                                    Then create the best captions possible for the provided platforms, formatted exactly as described above.
                '],
                ['role' => 'user', 'content' => 'Platform: '.json_encode($platforms).' ;Product Name: '.$product['name'].';Product Description:'.$product['description'].';Tone: '. $product['tone']]
            ]
        ]
    ]);

    $data = json_decode($response->getBody(), true);
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}

$captions = seperate_output($data['choices'][0]['message']['content']);

setSession("captions", $captions);
header("Location: ../public/preview.php");

function seperate_output($output){
    preg_match_all('/\[(.*?)\]\s*(?:\(.*?\))?\s*(.*?)(?=\n\[[^\]]+\]|\z)/s', $output, $matches, PREG_SET_ORDER);

    $captions = [];

    foreach ($matches as $match) {
        $platform = $match[1];
        $caption = trim($match[2]);
        $captions[$platform] = $caption;
    }

    return $captions;
}