<?php

declare(strict_types=1);

namespace LemonSqueezy\API;

use function array_map;

use LemonSqueezy\Entity\License as LicenseEntity;
use LemonSqueezy\Entity\LicenseInstance as LicenseInstanceEntity;

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

    public function activateLicense(string $licenseKey, string $instanceName): \stdClass
    {
         $response = $this->post('/licenses/activate', [
            'license_key' => $licenseKey,
            'instance_name' => $instanceName,
        ]);

        return $response;
    }

    public function deactivateLicense(string $licenseKey, string $instanceId): \stdClass|null
    {
        try {
            $response = $this->post('/licenses/deactivate', [
                'license_key' => $licenseKey,
                'instance_id' => $instanceId,
            ]);

            return $response;
        } catch (\Throwable $e) {
            // Can't deactivate license. Request failed.
            return null;
        }
    }

    public function validateLicense(string $licenseKey, string $instanceId): null|bool
    {
        try {
            $response = $this->post('/licenses/validate', [
                'license_key' => $licenseKey,
                'instance_id' => $instanceId,
            ]);

            return $response->valid ?? false;
        } catch (\Throwable $e) {
            // Likely not valid license key...
            return false;
        }
    }

    public function getAllLicenseInstances(): array
    {
        $licenseInstances = $this->get('/license-key-instances?page=1&page[size]=100');

        return array_map(function ($licenseInstance) {
            $licenseInstanceEntity = new LicenseInstanceEntity($licenseInstance->attributes);
            $licenseInstanceEntity->id = (int) $licenseInstance->id;

            return $licenseInstanceEntity;
        }, $licenseInstances->data);
    }

    /**
     * Get license instance
     * 
     * @param int $instanceId Is a number, not a string!
     */
    public function getLicenseInstance(int $instanceId): \stdClass
    {
        $response = $this->get('/license-key-instances/' . $instanceId);

        return $response->data;
    }
}
