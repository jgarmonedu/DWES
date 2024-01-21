# SOAP Client/Server in PHP (Authentication & AJAX)

Develop a PHP web page that consumes the authenticated SOAP server from the "Automóviles example" using Ajax.
 
## Server Side

### Folder soap-automobiles 

Authetication (*service-automobiles-auth.php*)

```php (class ManageAutomobilesAuth)

public function authenticate($header_params)
public function getBrandById($id)
public function getBrandsUrl()
public function getModelsByBrand($brand)

```

## Client Side (class Client)

```php
public function getBrandById($brand)
public function getBrandsUrl()
public function getModelsByBrand($brand

```

### Folder multibrand [Structure]
![alt structure] (structure.png]
