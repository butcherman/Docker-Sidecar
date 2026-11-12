<?php

namespace App\Services;

use RuntimeException;

class InstallationManager
{
    private string $envFile;

    public function __construct()
    {
        $directory = config('docker-manager.installation.directory');

        if (! is_string($directory) || $directory === '') {
            throw new RuntimeException(
                'Tech Bench installation directory is not configured.'
            );
        }

        $this->envFile = rtrim($directory, '/').'/.env';
    }

    public function currentVersion(): string
    {
        if (! is_file($this->envFile) || ! is_readable($this->envFile)) {
            throw new RuntimeException(
                'Tech Bench environment file is missing or unreadable.'
            );
        }

        $contents = file_get_contents($this->envFile);

        if ($contents === false) {
            throw new RuntimeException(
                'Unable to read Tech Bench environment file.'
            );
        }

        if (! preg_match('/^APP_VERSION=(.*)$/m', $contents, $matches)) {
            throw new RuntimeException(
                'APP_VERSION is not defined in the Tech Bench environment file.'
            );
        }

        return trim($matches[1], " \t\n\r\0\x0B\"'");
    }

    public function setVersion(string $version): void
    {
        if (! preg_match('/^\d+\.\d+\.\d+$/', $version)) {
            throw new RuntimeException(
                'The version must use X.Y.Z format.'
            );
        }

        if (! is_file($this->envFile) || is_link($this->envFile)) {
            throw new RuntimeException(
                'Tech Bench environment file is missing or is a symbolic link.'
            );
        }

        $contents = file_get_contents($this->envFile);

        if ($contents === false) {
            throw new RuntimeException(
                'Unable to read Tech Bench environment file.'
            );
        }

        $matches = preg_match_all('/^APP_VERSION=.*$/m', $contents);

        if ($matches !== 1) {
            throw new RuntimeException(
                'Expected exactly one APP_VERSION entry in the environment file.'
            );
        }

        $updated = preg_replace(
            '/^APP_VERSION=[^\r\n]*/m',
            "APP_VERSION={$version}",
            $contents,
            1
        );

        if ($updated === null) {
            throw new RuntimeException(
                'Unable to update APP_VERSION.'
            );
        }

        $directory = dirname($this->envFile);
        $temporaryFile = tempnam($directory, '.env-update-');

        if ($temporaryFile === false) {
            throw new RuntimeException(
                'Unable to create temporary environment file.'
            );
        }

        try {
            $permissions = fileperms($this->envFile);
            $owner = fileowner($this->envFile);
            $group = filegroup($this->envFile);

            if (file_put_contents($temporaryFile, $updated) === false) {
                throw new RuntimeException(
                    'Unable to write temporary environment file.'
                );
            }

            if ($permissions !== false && ! chmod($temporaryFile, $permissions & 0777)) {
                throw new RuntimeException(
                    'Unable to preserve environment file permissions.'
                );
            }

            if ($owner !== false && ! chown($temporaryFile, $owner)) {
                throw new RuntimeException(
                    'Unable to preserve environment file ownership.'
                );
            }

            if ($group !== false && ! chgrp($temporaryFile, $group)) {
                throw new RuntimeException(
                    'Unable to preserve environment file group.'
                );
            }

            if (! rename($temporaryFile, $this->envFile)) {
                throw new RuntimeException(
                    'Unable to replace Tech Bench environment file.'
                );
            }
        } finally {
            if (is_file($temporaryFile)) {
                unlink($temporaryFile);
            }
        }
    }
}
