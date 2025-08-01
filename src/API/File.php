<?php

declare(strict_types=1);

namespace LemonSqueezy\API;

use LemonSqueezy\Entity\File as FileEntity;

class File extends AbstractApi
{
    public function getAllFiles(): array
    {
        $files = $this->get('/files?page=1&page[size]=100');

        return array_map(function ($file) {
            $fileEntity = new FileEntity($file->attributes);
            $fileEntity->id = (int) $file->id;

            return $fileEntity;
        }, $files->data);
    }

    public function getFile(int $fileId): FileEntity
    {
        $file = $this->get('/files/' . $fileId);
        $fileEntity = new FileEntity($file->data->attributes);
        $fileEntity->id = (int) $file->data->id;

        return $fileEntity;
    }

    public function getFileByVariantId(int $variantId): array
    {
        $file = $this->get('/files?filter[variant_id]=' . $variantId);

        return $file->data;
    }
}
