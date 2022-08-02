## Vocation
Praction with Redis & Pub/Sub

## Description
Project starts listen (subscribes to channel), after button 'Listen' has clicked. Writes recived messages to redis's
set. Outputs set with messages has received.

## How to run
```
docker-compose up -d
```
```
docker exec -it 37_php-apache_1 bash
```
```
service redis-server restart
```
Visit http://localhost, press listen.
```
redis-cli
```
```
publish control_chanel <your_message>
```