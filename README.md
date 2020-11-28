# Как поднять сервер 

0. Поставить docker и docker-compose

1. Выполнить 

   ```bash
   $ docker-compose build 
   $ docker-compose up -d
   $ docker-compose exec php bin/console d:s:u -f 
   ```

2. Перейти http://127.0.0.1:8080
