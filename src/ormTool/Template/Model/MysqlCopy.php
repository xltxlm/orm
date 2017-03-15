<?php /** @var \xltxlm\ormTool\OrmMaker $this */?>
cd %~dp0
cd ../..

<?php if($hostflag=='dev'){ $hostflagto='online';}else{ $hostflagto="dev";}?>
docker run  --rm -it --env-file=<?=$hostflag?>2.env  -v %cd%:/data/ -e from=/data/<?=$hostflag?>/<?=(new \ReflectionClass($this->dbConfig))->getShortName()?>.env   -e to=/data/<?=$hostflagto?>/<?=(new \ReflectionClass($this->dbConfig))->getShortName()?>.env  -e table=<?=$backupTable?> registry.cn-hangzhou.aliyuncs.com/xialintai/ssh /root/mysql/copy.sh
