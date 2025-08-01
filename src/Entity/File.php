<?php

declare(strict_types=1);

namespace LemonSqueezy\Entity;

final class File extends AbstractEntity
{
    public int $id;
    public int $variant_id;
    public string $identifier;
    public string $name;
    public string $extension;
    public string $download_url;
    public int $size;
    public string $size_formatted;
    public ?string $version;
    public int $sort;
    public ?string $status;
    public string $createdAt;
    public string $updatedAt;
    public bool $test_mode;
}
