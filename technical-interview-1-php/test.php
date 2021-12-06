<?php

$template = "Hello, my name is {#Name}. This message was sent from {#Country}.";
$data = ['Name' => 'Alan', 'Country' => 'Zimbabwe'];

function create_message(string $template, array $data): string
{
    foreach ($data as $replaceKey => $replaceContent) {
        $referKey = "{#{$replaceKey}}";
        $template = str_replace($referKey, $replaceContent, $template);
    }
    return $template;
}

$result = create_message($template, $data);
echo "Result was: {$result}" . PHP_EOL;

if ($result === 'Hello, my name is Alan. This message was sent from Zimbabwe.') {
    echo 'yep!' . PHP_EOL;
} else {
    echo 'nope :(' . PHP_EOL;
}
