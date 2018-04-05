# Comandos Uteis

```Bash
$ docker run --rm -u=1000:1000 -v $(pwd):/app composer/composer update --prefer-dist --dev -o --ignore-platform-reqs

$ docker run --privileged -d --hostname=host1 docker:dind
$ docker run --privileged -d --hostname=host2 docker:dind
```