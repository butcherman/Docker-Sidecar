#!/bin/sh
set -eu

DOCKER_SOCKET="${DOCKER_SOCKET:-/var/run/docker.sock}"

if [ -S "$DOCKER_SOCKET" ]; then
    DOCKER_GID="$(stat -c '%g' "$DOCKER_SOCKET")"

    if ! getent group docker >/dev/null 2>&1; then
        addgroup --gid "$DOCKER_GID" docker
    fi

    adduser www-data docker 2>/dev/null || true
fi

exec su -s /bin/sh www-data -c "$*"