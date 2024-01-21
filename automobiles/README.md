# SOAP Client/Server in PHP (Authentication & AJAX)

Develop a PHP web page that consumes the authenticated SOAP server from the "Automóviles example" using Ajax.
 
## Server Side

### Folder soap-automobiles 

Authetication (*service-automobiles-auth.php*)

```php
 public function authenticate($header_params) {
        if ($header_params->username == 'ies' && $header_params->password == 'daw') {
            $this->IsAuthenticated = true;
            return true;
        } else {
            throw new SoapFault('Wrong user/pass combination', 401);
        }
    }
```

## Client Side

### Folder multibrand [Structure]
![alt structure] (structure.png]
