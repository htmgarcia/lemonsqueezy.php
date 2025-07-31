This is a fork from [seisigmasrl](https://github.com/seisigmasrl/lemonsqueezy.php).

```php
# Initializing the Package
<?php
require_once  'vendor/autoload.php';

// Create a new LemonSqueezy client
$client = new \LemonSqueezy\LemonSqueezy();

// Authenticate the client by providing your API Token which can be
// generated at https://app.lemonsqueezy.com/settings/api
$client->authenticate('yourApiToken');
```

Here's the list of the current methods provided by this package base on the existed endpoints:

### User
```php
<?php
# Initialize the Package from the step before
...
// Get the user information base on the defined in the Lemon Squeeze API Documentation
// https://docs.lemonsqueezy.com/api/users#the-user-object
$user = $client->user();
$userDetails = $user->getUserInformation();

var_dump($userDetails);
// object(LemonSqueezy\Entity\User)#4567 (7) {
//   ["id"]=> id(5) "13546"   // New
//   ["name"]=> string(14) "Marco Polo"
//   ["email"]=> string(19) "marco@polo.com"
//   ["color"]=> string(7) "#7047EB"
//   ["avatar_url"]=> string(72) "https://www.gravatar.com/avatar/cc27e9f9e9a66d0fb6a988a?d=blank"
//   ["has_custom_avatar"]=> bool(false)
//   ["createdAt"]=> string(27) "2023-01-18T13:56:46.000000Z"
//   ["updatedAt"]=> string(27) "2023-01-18T14:00:01.000000Z"
// }

// Get only the ID of the User
// $userId = $user->getUserId(); Deprecated.
```

### Store
```php
<?php
# Initialize the Package from the step before
...
// Get the user information base on the defined in the Lemon Squeeze API Documentation
// https://docs.lemonsqueezy.com/api/stores#the-store-object
$lemonSqueeze = $client->store();
$storeList = $lemonSqueeze->getAllStores();     // List all existing Stores
$store = $lemonSqueeze->getStore(12685);        // Get details of the store with the ID: 12685
```

### Customer
```php
<?php
# Initialize the Package from the step before
...
// Get the user information base on the defined in the Lemon Squeeze API Documentation
// https://docs.lemonsqueezy.com/api/customers#the-customer-object
$lemonSqueeze = $client->customer();
$allCustomers = $lemonSqueeze->getAllCustomers();           // List all existing Customers
$storeCustomers = $lemonSqueeze->getStoreCustomers(12689);  // List all customers from the Store ID: 12689
$customer = $lemonSqueeze->getCustomer(596510);             // Get the details of the Customer with the ID: 596510
```

### Product
```php
<?php
# Initialize the Package from the step before
...
// Get the user information base on the defined in the Lemon Squeeze API Documentation
// https://docs.lemonsqueezy.com/api/products#the-product-object
$lemonSqueeze = $client->product();
$allProducts = $lemonSqueeze->getAllProducts();                      // List all existing Products
$storeCustomers = $lemonSqueeze->getStoreProducts(12689);            // List all Products from the Store ID: 12689
$product = $lemonSqueeze->getProduct(59920);                         // Get the details of the Products with the ID: 59920
$productVariants = $lemonSqueeze->getProductVariants(59920);         // Get all Variants from the Product ID: 59920
$productWithVariants = $lemonSqueeze->getProductWithVariants(59920); // Get a Product with All their Variants
```

### License Keys

These are methods to retrieve license keys only. Doesn't include activations/deactivations neither instances.

```php
<?php
# Initialize the Package from the step before
// https://docs.lemonsqueezy.com/api/license-keys/the-license-key-object
// 
$lemonSqueeze = $client->license();
$allLicenses = $lemonSqueeze->getAllLicenses();         // List all existing Licenses
$storeLicenses = $lemonSqueeze->getStoreLicenses(123);  // List all Licenses for Store ID: 123
$license = $lemonSqueeze->getLicense(123); // Get the License key ID: 123
```

### License Instances

These are licenses instances (is NOT license key!) that has been either activated, deactivated, expired, etc.

```php
<?php
# Initialize the Package from the step before
// https://docs.lemonsqueezy.com/api/license-key-instances/the-license-key-instance-object
$lemonSqueeze = $client->license();
$allLicenseInstances = $lemonSqueeze->getAllLicenseInstances(); // Get all license instances
$licenseInstance = $lemonSqueeze->getLicenseInstance(123); // Get the License instance with ID: 123 (is NOT the license key!)
```

### License API

These methods perform activations/deactivations of license instances (NOT license keys!).

```php
<?php
# Initialize the Package from the step before
...
// https://docs.lemonsqueezy.com/api/license-api
$lemonSqueeze = $client->license();

// Activate license
$response = $lemonSqueeze->activateLicense(
    'XXXXXXXX-XXXX-XXXX-XXXX-XXXXXXXXXXXX', // License key
    'MyAppInstance' // Set a custom name
);

// Deactivate license
$response = $lemonSqueeze->deactivateLicense(
    'xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx' // Instance id (NOT license key!)
);
```