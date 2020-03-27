# Symfony JSON-RPC Http server OpenAPI documentation
[![License](https://img.shields.io/github/license/adgoal/symfony-jsonrpc-http-server-openapi-doc.svg)](https://github.com/adgoal/symfony-jsonrpc-http-server-openapi-doc) [![Code size](https://img.shields.io/github/languages/code-size/adgoal/symfony-jsonrpc-http-server-openapi-doc.svg)](https://github.com/adgoal/symfony-jsonrpc-http-server-openapi-doc) [![Dependabot Status](https://api.dependabot.com/badges/status?host=github&repo=adgoal/symfony-jsonrpc-http-server-openapi-doc)](https://dependabot.com)


[![Scrutinizer Build Status](https://img.shields.io/scrutinizer/build/g/adgoal/symfony-jsonrpc-http-server-openapi-doc.svg?label=Scrutinizer&logo=scrutinizer)](https://scrutinizer-ci.com/g/adgoal/symfony-jsonrpc-http-server-openapi-doc/build-status/master) [![Scrutinizer Code Quality](https://img.shields.io/scrutinizer/g/adgoal/symfony-jsonrpc-http-server-openapi-doc/master.svg?logo=scrutinizer)](https://scrutinizer-ci.com/g/adgoal/symfony-jsonrpc-http-server-openapi-doc/?branch=master) [![Code Coverage](https://img.shields.io/scrutinizer/coverage/g/adgoal/symfony-jsonrpc-http-server-openapi-doc/master.svg?logo=scrutinizer)](https://scrutinizer-ci.com/g/adgoal/symfony-jsonrpc-http-server-openapi-doc/?branch=master)

[![Travis Build Status](https://img.shields.io/travis/com/adgoal/symfony-jsonrpc-http-server-openapi-doc/master.svg?label=Travis&logo=travis)](https://travis-ci.com/adgoal/symfony-jsonrpc-http-server-openapi-doc) <!-- NOT WORKING WITH travis-ci.com [![Travis PHP versions](https://img.shields.io/travis/php-v/adgoal/symfony-jsonrpc-http-server-openapi-doc.svg?logo=travis)](https://php.net/) --> [![Travis Symfony Versions](https://img.shields.io/badge/Symfony-v3%20%2F%20v4-8892BF.svg?logo=travis)](https://symfony.com/)

[![Latest Stable Version](https://img.shields.io/packagist/v/adgoal/symfony-jsonrpc-http-server-openapi-doc.svg)](https://packagist.org/packages/adgoal/symfony-jsonrpc-http-server-openapi-doc) [![Packagist PHP version](https://img.shields.io/packagist/php-v/adgoal/symfony-jsonrpc-http-server-openapi-doc.svg)](https://packagist.org/packages/adgoal/symfony-jsonrpc-http-server-openapi-doc)

Symfony bundle for easy JSON-RPC server OpenAPI 3.0.0 documentation

Symfony bundle for [adgoal/jsonrpc-http-server-openapi-doc-sdk](https://github.com/adgoal/php-jsonrpc-http-server-openapi-doc-sdk)

## How to use

Once configured, your project is ready to handle HTTP `GET` request on `/doc/openapi.json` endpoint. Result will be a openapi compatible file.

See below how to configure it.

## Configuration

[Behat demo app configuration folders](./features/demo_app) can be used as examples.

 - Add the bundles in your config/bundles.php file:
   ```php
   // config/bundles.php
   return [
       ...
       Symfony\Bundle\FrameworkBundle\FrameworkBundle::class => ['all' => true],
       Yoanm\SymfonyJsonRpcHttpServer\JsonRpcHttpServerBundle::class => ['all' => true],
       Yoanm\SymfonyJsonRpcHttpServerDoc\JsonRpcHttpServerDocBundle::class => ['all' => true],
       Yoanm\SymfonyJsonRpcHttpServerOpenAPIDoc\JsonRpcHttpServerOpenAPIDocBundle::class => ['all' => true],
       ...
   ];
   ```
   
 - Configure `adgoal/symfony-jsonrpc-http-server` as described on [adgoal/symfony-jsonrpc-http-server](https://github.com/adgoal/symfony-jsonrpc-http-server) documentation.
 
 - Configure `adgoal/symfony-jsonrpc-http-server-doc` as described on [adgoal/symfony-jsonrpc-http-server-doc](https://github.com/adgoal/symfony-jsonrpc-http-server-doc) documentation.
 
 - Query your project at `/doc/openapi.json` endpoint and you will have a OpenAPI json documentation file of your server.

## Event

You are able to enhance resulting documentation by listening on `json_rpc_http_server_openapi_doc.array_created` event.

See below an example of listener service configuration:
```yaml
  method_doc_created.listener:
    class: Full\Namespace\DocCreatedListener # <-- replace by your class name
    tags:
      - name: 'kernel.event_listener'
        event: 'json_rpc_http_server_openapi_doc.array_created'
        method: 'enhanceMethodDoc' # <-- replace by your method name
``` 

You will receive an event of type [`OpenAPIDocCreatedEvent`](./src/Event/OpenAPIDocCreatedEvent.php).

You can take example on Behat [`DocCreatedListener`](./features/demo_app/src/Listener/DocCreatedListener.php)   

## Contributing
See [contributing note](./CONTRIBUTING.md)
