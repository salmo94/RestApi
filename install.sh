function checkDocker() {
    if ! (docker info); then
      echo "docker не запущений. Неможливо продовжити."
      exit
    fi

}

function checkDockerCompose() {
    if ! (hash docker-compose 2>/dev/null); then
      echo "docker-compose не запущений. Неможливо продовжити налаштування."
      exit
    fi

}

function checkDockerComposeYml() {
    if ! [[ -f 'docker-compose.yml' ]]; then
      echo "Не знайдено файл docker-compose.yml. Неможливо продовжити налаштування."
      exit
    fi

}

function upDockerCompose() {
    if ! docker-compose up -d; then
      echo "docker-compose не зміг"
      exit
    fi
}

function installProject() {
      docker exec l_php /bin/bash -c "composer install --ignore-platform-reqs"
}

function checkHosts() {
    HOSTS='127.0.0.1 laravel-test.docker'
    if grep "${HOSTS}" /etc/hosts | grep -v '^#'; then
      echo "${HOSTS} вже присутні в /etc/hosts"
    else
      sudo /bin/bash -c "echo -e '\n${HOSTS}' >> /etc/hosts"
      echo "${HOSTS} успішно додані в /etc/hosts."
    fi
}

checkDocker
checkDockerCompose
checkDockerComposeYml
upDockerCompose
installProject
checkHosts

echo 'Розгортання проекту пройшоло успішно!'
echo 'URL проекту: http://laravel-test.docker:1111'
