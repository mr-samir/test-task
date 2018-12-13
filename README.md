# test-task

```bash
git clone https://github.com/mr-samir/test-task.git
cd ./test-task

cd ./ratchet
composer install 
cd ..

cd ./symfony-react
composer install
npm install
npm run dev

php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate
php bin/console doctrine:fixtures:load

php bin/console server:start 127.0.0.1:8000

cd ..
cd ./ratchet
php bin/chat-server.php

```

Navigate to `http://127.0.0.1:8000/`
![Alt text](/screen-web.png?raw=true "screen-web.png")

Navigate to `http://localhost:8000/api/doc`
![Alt text](/screen-api-doc.png?raw=true "screen-api-doc.png")

Navigate to `http://localhost:8000/api/slot/banner1`
![Alt text](/screen-api-get.png?raw=true "screen-api-get.png")
