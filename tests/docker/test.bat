cd %~dp0
chcp 65001
docker build -t phplog ./php/
docker-compose  up -d
rem 等待mysql服务完全启动
ping 127.0.0.1 -n 10 > nul
docker exec   docker_mysql_1 mysql -e "create database IF NOT EXISTS `doc`;"
docker exec   docker_mysql_1 mysql -e "create database IF NOT EXISTS `doclog`;"
docker cp doc.sql docker_mysql_1:/
docker exec   docker_mysql_1 mysql  doc  --default-character-set=utf8 -e "source /doc.sql;"
docker exec   docker_mysql_1 mysql -e "show databases;"
docker exec   docker_php_1 bash -c "/usr/local/bin/docker-php-ext-install  pdo_mysql"
docker exec   docker_php_1 bash -c "cd /orm && php tests/docker/LoadDataTest"
docker exec   docker_php_1 bash -c "cd /orm && vendor/bin/phpunit"
rem docker-compose down