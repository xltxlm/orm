cd %~dp0
docker-compose  up -d
ping 127.0.0.1 -n 6 > nul
docker exec   docker_mysql_1 mysql -e "create database IF NOT EXISTS `doc`;"
docker exec   docker_mysql_1 mysql -e "create database IF NOT EXISTS `doclog`;"
docker cp doc.sql docker_mysql_1:/
docker exec   docker_mysql_1 mysql  doc  --default-character-set=utf8 -e "source /doc.sql;"
docker exec   docker_mysql_1 mysql -e "show databases;"
docker exec   docker_php_1 bash -c "/usr/local/bin/docker-php-ext-install  pdo_mysql"
docker exec   docker_php_1 bash -c "cd /orm && php tests/docker/LoadDataTest"
docker exec   docker_php_1 bash -c "cd /orm && vendor/bin/phpunit"
