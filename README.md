# RequestManager

### Example of use GuzzleRequest

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
### POST Method with basic authentication    

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
            ->setData(['form_params' => $data])
            ->post($url);
    
        echo json_encode($response);
    
    } catch (Exception $e) {
        echo json_encode([
            'code: ' => $e->getCode(),
            'message: ' => $e->getMessage()
        ]);
    }
```
### PUT Method with basic authentication

```php
    try {
        $url = sprintf('%s%s%s%s',
        '/',
            $router,
            DIRECTORY_SEPARATOR,
            11
        );
        $response = (new RequestRunner())
            ->setClient(new GuzzleRequest())
            ->basicAuth($username, $password)
            ->setHeader($headers)
            ->setUri($uri)
            ->setData($data)
            ->put($url);
    
    } catch (Exception $e) {
        echo json_encode([
            'code: ' => $e->getCode(),
            'message: ' => $e->getMessage()
        ]);
    }
```
### DELETE Method with basic authentication

```php
    try {  
        $url = sprintf('%s%s%s%s',
        '/',
            $router,
            DIRECTORY_SEPARATOR,
            11
        );
    
        $response = (new RequestRunner())
            ->setClient(new GuzzleRequest())
            ->basicAuth($username, $password)
            ->setHeader($headers)
            ->setUri($uri)
            ->delete($url);
    
    } catch (Exception $e) {
        echo json_encode([
            'code: ' => $e->getCode(),
            'message: ' => $e->getMessage()
        ]);
    }
```