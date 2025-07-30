<?php

declare(strict_types=1);

namespace LemonSqueezy\Entity;

final class LicenseInstance extends AbstractEntity
{
    public int $id;
    public int $license_key_id;
    public string $identifier;
    public string $name;
    public string $created_at;
    public string $updated_at;
}
