# Request Management Package

<hr>

### Requirements
```text
Request Management Package requires PHP version 7.3.0 or greater.
```

### Installation
```text
To use the package it is necessary to install it via composer:
```

```php
composer require wbsartori/request-manager
```

### Basic Example of use GuzzleRequest

### GET Method with basic authentication
```php
    try {
        $url = sprintf('%s%s',
          '/',$router
        );

        $response = (new RequestRunner())
            ->setClient(new GuzzleRequest())
            ->basicAuth($username, $password)
            ->setHeader($headers)
            ->setUri($uri)
            ->get($url);
    
            echo json_encode($response);

    } catch (Exception $e) {
        echo json_encode([
            'code: ' => $e->getCode(),
            'message: ' => $e->getMessage()
        ]);
    }

```

### Documentantion

[Link to documentation and examples.](https://github.com/Gustavo-Paris/RequestManager/blob/master/docs/README.md)

### Contributing

[Link to contributing.](https://github.com/Gustavo-Paris/RequestManager/blob/master/docs/CONTRIBUTING.md)

