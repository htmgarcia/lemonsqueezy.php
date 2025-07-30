<?php

declare(strict_types=1);

namespace LemonSqueezy\API;

use function array_map;

use LemonSqueezy\Entity\License as LicenseEntity;

class License extends AbstractApi
{
    public function getAllLicenses(): array
    {
        $licenses = $this->get('/license-keys');

        return array_map(function ($license) {
            $licenseEntity = new LicenseEntity($license->attributes);
            $licenseEntity->id = (int) $license->id;

            return $licenseEntity;
        }, $licenses->data);
    }
}
