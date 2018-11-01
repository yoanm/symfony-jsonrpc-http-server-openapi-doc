<?php
namespace DemoApp\Listener;

use Yoanm\SymfonyJsonRpcHttpServerOpenAPIDoc\Event\OpenAPIDocCreatedEvent;

/**
 * Class DocCreatedListener
 */
class DocCreatedListener
{
    /**
     * @param OpenAPIDocCreatedEvent $event
     */
    public function enhanceMethodDoc(OpenAPIDocCreatedEvent $event) : void
    {
        $swaggerDoc = $event->getOpenAPIDoc();
        $swaggerDoc['externalDocs'] = [
            'description' => 'Find out more about OpenAPI',
            'url' => 'http://swagger.io',
        ];

        $event->setOpenAPIDoc($swaggerDoc);
    }
}
