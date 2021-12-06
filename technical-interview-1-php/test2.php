<?php

$empty_unmatched = false;
$template = "Hello, my name is {#Name}. This message was sent from {#Country}, and today is {#Weekday}.";
$data = ['Name' => 'Alan', 'Country' => 'Zimbabwe'];

function create_message(string $template, array $data): string
{
    foreach ($data as $replaceKey => $replaceContent) {
        $referKey = "{#{$replaceKey}}";
        $template = str_replace($referKey, $replaceContent, $template);
    }
    $template = clear($template);
    return $template;
}

function clear(string $template): string
{
    $regex = '/{#[\w]+}/m';
    return preg_replace($regex, '', $template);    
}

$result = create_message($template, $data);
echo "Result was: {$result}" . PHP_EOL;

if ($result === 'Hello, my name is Alan. This message was sent from Zimbabwe, and today is .') {
    echo 'yep!' . PHP_EOL;
} else {
    echo 'nope :(' . PHP_EOL;
}
