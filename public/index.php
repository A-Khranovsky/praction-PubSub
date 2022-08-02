<?php

require_once(__DIR__ . '/../vendor/autoload.php');
$messageBox = new \Predis\Client();

if($_SERVER['REQUEST_METHOD'] == 'POST'){   
    $redis = new \Predis\Client('tcp://127.0.0.1:6379'."?read_write_timeout=0");    
   

    $pubsub = $redis->pubSubLoop();
    $pubsub->subscribe($_POST['channel']);

    foreach($pubsub as $message) {
        if($message->kind == 'message') {
            $messageBox->sAdd('messageBox', $message->payload);                     
            $pubsub->unsubscribe();
        }
     }
}

foreach($messageBox->sMembers('messageBox') as $message) {
    echo $message . '<br />';
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <title></title>
    <meta charset="utf-8">
</head>
<body>
    <form method="post">
        Input channel: <input type=text name="channel" value="control_chanel"><br />
        <input type='submit' value='Listen'>
    </form>
</body>
</html>