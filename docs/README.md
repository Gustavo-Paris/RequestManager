# Request Management Package

<hr>

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
### Using in a specific class


In the example below, the method call is being prepared inside a try catch block and the class
CallExampleWithoutTryCacthGuzzle has a request method which calls our client in this case the GuzzleRequest.

### Call to method
```php

    try {
        $data = [
            'url' => 'https://domain.com/',
            'username' => 'test',
            'password' => 'test',
        ];
    
        $callExample = new CallExampleWithoutTryCacthGuzzle();
        $response = $callExample->request($data);
    
        echo json_encode($response);
    
    } catch (RequestException $e) {
        echo $e->getMessage();
    }

```

### Class template with request method
```php
    <?php
    
    namespace RequestManager\examples;
    
    use Exception;
    use RequestManager\RequestRunner;
    use RequestManager\Requests\GuzzleRequest;
    
    class CallExampleWithoutTryCacthGuzzle
    {
        
        private const TESTS_LIST = 'test';
        
        public function request(array $data)
        {
            $url = sprintf(
                '%s%s',
                '/',
                self::TESTS_LIST
            );
    
            return (new RequestRunner())
                ->setClient(new GuzzleRequest())
                ->basicAuth($data['username'], $data['password'])
                ->setHeader(['name' => 'value'])
                ->setUri($data['url'])
                ->get($url);
        }
    }

```