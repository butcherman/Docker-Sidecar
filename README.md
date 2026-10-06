# Docker Sidecar

This is a Docker Image and API to monitor other Docker Images.

## API Endpoints

```html
/containers
```

Use this endpoint to get the status of all containers listed within the
docker-manager.php config file.

```html
/containers/{containerKey}/restart
```

Restart the specified container.
