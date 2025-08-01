<?php

declare(strict_types=1);

namespace LemonSqueezy\Entity;

final class License extends AbstractEntity
{
    public int $id;
    public int $store_id;
    public int $customer_id;
    public int $order_id;
    public int $order_item_id;
    public int $product_id;
    public string $user_name;
    public string $user_email;
    public string $key;
    public string $key_short;
    public int $activation_limit;
    public int $instances_count;
    public bool $disabled;
    public ?ProductStatusEnum $status;
    public string $status_formatted;
    public string|null $expires_at;
    public string $created_at;
    public string $updated_at;
}
