<?php

namespace App\Services;

use RuntimeException;

class UpdateJournal
{
    private function path(): string
    {
        $path = config('docker-manager.journal_path');

        if (! is_string($path) || $path === '') {
            throw new RuntimeException(
                'Docker update journal path is not configured.'
            );
        }

        return rtrim($path, '/').'/active-update.json';
    }

    public function read(): ?array
    {
        $path = $this->path();

        if (! is_file($path)) {
            return null;
        }

        $contents = file_get_contents($path);

        if ($contents === false) {
            throw new RuntimeException(
                'Unable to read the Docker update journal.'
            );
        }

        try {
            $journal = json_decode(
                $contents,
                true,
                512,
                JSON_THROW_ON_ERROR
            );
        } catch (\JsonException $exception) {
            throw new RuntimeException(
                'The Docker update journal contains invalid JSON.',
                previous: $exception
            );
        }

        if (! is_array($journal)) {
            throw new RuntimeException(
                'The Docker update journal has an invalid structure.'
            );
        }

        return $journal;
    }

    public function write(array $journal): void
    {
        $path = $this->path();
        $directory = dirname($path);

        if (
            ! is_dir($directory) &&
            ! mkdir($directory, 0750, true) &&
            ! is_dir($directory)
        ) {
            throw new RuntimeException(
                'Unable to create the Docker update journal directory.'
            );
        }

        try {
            $contents = json_encode(
                $journal,
                JSON_PRETTY_PRINT | JSON_THROW_ON_ERROR
            );
        } catch (\JsonException $exception) {
            throw new RuntimeException(
                'Unable to encode the Docker update journal.',
                previous: $exception
            );
        }

        $temporaryFile = tempnam($directory, '.journal-');

        if ($temporaryFile === false) {
            throw new RuntimeException(
                'Unable to create a temporary journal file.'
            );
        }

        try {
            if (file_put_contents($temporaryFile, $contents, LOCK_EX) === false) {
                throw new RuntimeException(
                    'Unable to write the Docker update journal.'
                );
            }

            if (! chmod($temporaryFile, 0640)) {
                throw new RuntimeException(
                    'Unable to set journal file permissions.'
                );
            }

            if (! rename($temporaryFile, $path)) {
                throw new RuntimeException(
                    'Unable to replace the Docker update journal.'
                );
            }
        } finally {
            if (is_file($temporaryFile)) {
                unlink($temporaryFile);
            }
        }
    }

    public function clear(): void
    {
        $path = $this->path();

        if (is_file($path) && ! unlink($path)) {
            throw new RuntimeException(
                'Unable to clear the Docker update journal.'
            );
        }
    }
}
