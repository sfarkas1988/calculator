# Calculator

A simple REST based calculator.

## Installation

``` 
 docker build -t calculator .
 docker run --rm -p 81:80 calculator
```

## Usage

Call the following URL and you'll have access to the API documentation:

```
http://localhost:81/api/doc
```

## Development

```
docker run --rm -v $(pwd):/var/www/html calculator composer install
docker run --rm -p 81:80 -v $(pwd):/var/www/html calculator
```

## Tests
Run the test with the following command

```
docker run --rm calculator composer test
```

## Code Quality

To fix code quality issues with php cs fixer, run the following command:
```
docker run --rm -v $(pwd):/var/www/html calculator composer cs:fix
```

To list all current code quality issues with php cs fixer, run the following command:
```
docker run --rm -v $(pwd):/var/www/html calculator composer cs:check
```
