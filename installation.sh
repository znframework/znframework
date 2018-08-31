#!/usr/bin/env bash
chmod -R 777 .
php zerocore generate-project-key
docker-compose up -d --build znframework
