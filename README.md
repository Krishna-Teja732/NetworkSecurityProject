# Network Security Project

### Prerequsite
1. Docker cli

### How to run the server
- Run the following command in the terminal
```sh
docker compose up --watch
```
- Visit "http://localhost:10001/login" in browser

### Clear previous docker containers and images
**NOTE: These commands deletes all the containers and images present on your host machine**

- Run the following command to delete all the docker containers
```sh
docker rm $(docker ps -aq)
```

- Run the following command to delete all the docker images
```sh
docker rmi $(docker image ls -q)
```
