#!/bin/bash
NAME=rspg.kku.ac.th;
docker stop $NAME;
docker rm -f $NAME;
docker run -it -d -p 8111:443 \
    --name $NAME \
    --restart=always \
    -v $(pwd)/../:/app \
    docker-images.kku.ac.th/rnd/yii2-basic;

docker exec $NAME chown -R www-data:www-data /app/runtime
docker exec $NAME chmod -R 755 /app/runtime

docker exec $NAME chown -R www-data:www-data /app/web/assets
docker exec $NAME chmod -R 755 /app/web/assets

docker exec $NAME chown -R www-data:www-data /app/web/uploads
docker exec $NAME chmod -R 755 /app/web/uploads
