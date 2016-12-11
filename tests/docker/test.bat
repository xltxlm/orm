cd %~dp0
docker-compose  up -d
docker exec -it  docker_mysql_1 mysql -e "create database IF NOT EXISTS `doc`;"
docker exec -it  docker_mysql_1 mysql -e "create database IF NOT EXISTS `doclog`;"
docker cp doc.sql docker_mysql_1:/
docker exec -it  docker_mysql_1 mysql  doc  --default-character-set=utf8 -e "source /doc.sql;"
docker exec -it  docker_mysql_1 mysql -e "show databases;"
