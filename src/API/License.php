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

    public function getStoreLicenses(int $storeId): array
    {
        $licenses = $this->get('/license-keys?filter[store_id]=' . $storeId);

        return array_map(function ($license) {
            $licenseEntity = new LicenseEntity($license->attributes);
            $licenseEntity->id = (int) $license->id;

            return $licenseEntity;
        }, $licenses->data);
    }

    public function getLicense(int $licenseId): LicenseEntity
    {
        $license = $this->get('/license-keys/' . $licenseId);

        $licenseEntity = new LicenseEntity($license->data->attributes);
        $licenseEntity->id = (int) $license->data->id;

        return $licenseEntity;
    }
}
