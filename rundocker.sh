#!/bin/bash

# stopping old container 
docker stop lib-sys-container 2>/dev/null

# deleting old container and image
docker rm lib-sys-container 2>/dev/null
docker rmi lib-sys-image 2>/dev/null

docker build -t lib-sys-image . --no-cache
docker run -p 8000:8000 --name lib-sys-container lib-sys-image