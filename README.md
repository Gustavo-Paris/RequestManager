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
You can call the Runner class and in the setClient method pass the client you want to use,
currently our package supports GuzzleRequet and PhpCurlClass with some abstractions.

### GET Method with basic authentication

```php
    use RequestManager\RequestRunner;
    use RequestManager\Http\GuzzleRequestAdapter;
    
    try {
        $url = sprintf('%s%s',
          '/',$router
        );

        $response = (new RequestRunner())
            ->setClient(new GuzzleRequestAdapter())
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

### POST Method with basic authentication
```php     
    
    use RequestManager\RequestRunner;
    use RequestManager\Requests\GuzzleRequest;
    
    try {
        $data = [
            [
                'description' => 'description',
                'acronym' => 'acronym'
            ]
         ];
         
        $url = sprintf('%s%s',
            '/', $router
        );
        
        $response = (new RequestRunner())
            ->setClient(new GuzzleRequest())
            ->basicAuth($username, $password)
            ->setHeader(['header' => ''])
            ->setUri($uri)
            ->setData(['multipart' => $data])
            ->post($url);
    
        echo json_encode($response);
    
    } catch (Exception $e) {
        echo json_encode([
            'code: ' => $e->getCode(),
            'message: ' => str_replace('\\', '', $e->getMessage())
        ]);
    }
    
```

### UPDATE Method with basic authentication

```php  
        
    use RequestManager\RequestRunner;
    use RequestManager\Requests\GuzzleRequest;
    
    try {
        $data = [
            'description' => 'New description',
            'acronym' => 'NA'
        ];
        
        $url = sprintf('%s%s%s%s',
        '/',
            $router,
            DIRECTORY_SEPARATOR,
            30
        );
        
        $response = (new RequestRunner())
            ->setClient(new GuzzleRequest())
            ->basicAuth($username, $password)
            ->setHeader(['header' => ''])
            ->setUri($uri)
            ->setData(['json' => $data])
            ->put($url);
    
        echo json_encode($response);
    
    } catch (Exception $e) {
        echo json_encode([
            'code: ' => $e->getCode(),
            'message: ' => str_replace('\\', '', $e->getMessage())
        ]);
    }
    
```

### DELETE Method with basic authentication

```php  
        
    use RequestManager\RequestRunner;
    use RequestManager\Requests\GuzzleRequest;
    
    try {
        $url = sprintf('%s%s%s%s',
        '/',
            $router,
            DIRECTORY_SEPARATOR,
            30
        );
    
        $response = (new RequestRunner())
            ->setClient(new GuzzleRequest())
            ->basicAuth($username, $password)
            ->setHeader(['header' => ''])
            ->setUri($uri)
            ->delete($url);
    
        echo json_encode($response);

    } catch (Exception $e) {
        echo json_encode([
            'code: ' => $e->getCode(),
            'message: ' => $e->getMessage()
        ]);
    }

```

### Methods
```php
    setClient((new Client));         #Set the Client you want to use, if you don't use this method, Guzzle will be set as default.
    basicAuth($username, $password); #Basic authentication, if not used, the default noAuth will be used.
    bearerTokenAuth($token);         #Bearer token authentication, if not used, the default noAuth will be used.
    setHeader($headers)              #Receives an array of headers from the request if necessary.
    setUri($uri)                     #Get the api host with the slash at the end.
    setData($uri)                    #Receives an array of data if the method needs to pass some value.
    get($url)                        #Receives the route for which you want to fetch data.
    post($url)                       #Get the route for which you want to create data.
    put($url)                        #Get the route for which you want to update data.
    delete($url)                     #Get the route for which you want to delete data.
```
You can check the documentation for examples of using Guzzle and PHPCurlClass.

### Documentantion

[Link to documentation and examples.](https://github.com/Gustavo-Paris/RequestManager/blob/master/docs/README.md)

### Contributing

[Link to contributing.](https://github.com/Gustavo-Paris/RequestManager/blob/master/docs/CONTRIBUTING.md)

