<?php

declare(strict_types=1);

namespace LemonSqueezy\API;

use function array_map;

use LemonSqueezy\Entity\LicenseInstance as LicenseInstanceEntity;

class LicenseInstance extends AbstractApi
{
    public function getAllLicenseInstances(): array
    {
        $licenseInstances = $this->get('/license-key-instances');

        return array_map(function ($licenseInstance) {
            $licenseInstanceEntity = new LicenseInstanceEntity($licenseInstance->attributes);
            $licenseInstanceEntity->id = (int) $licenseInstance->id;

            return $licenseInstanceEntity;
        }, $licenseInstances->data);
    }

    public function getStoreLicenseInstances(int $storeId): array
    {
        $licenseInstances = $this->get('/licenseInstance-keys?filter[store_id]=' . $storeId);

        return array_map(function ($licenseInstance) {
            $licenseInstanceEntity = new LicenseInstanceEntity($licenseInstance->attributes);
            $licenseInstanceEntity->id = (int) $licenseInstance->id;

            return $licenseInstanceEntity;
        }, $licenseInstances->data);
    }

    public function getLicenseInstance(int $licenseInstanceId): LicenseInstanceEntity
    {
        $licenseInstance = $this->get('/licenseInstance-keys/' . $licenseInstanceId);

        $licenseInstanceEntity = new LicenseInstanceEntity($licenseInstance->data->attributes);
        $licenseInstanceEntity->id = (int) $licenseInstance->data->id;

        return $licenseInstanceEntity;
    }
}
