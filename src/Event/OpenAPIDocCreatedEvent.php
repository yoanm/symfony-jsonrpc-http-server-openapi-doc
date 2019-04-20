<?php
namespace Yoanm\SymfonyJsonRpcHttpServerOpenAPIDoc\Event;

use Yoanm\JsonRpcServerDoc\Domain\Model\HttpServerDoc;
use Yoanm\SymfonyJsonRpcHttpServerDoc\Event\DocEvent;

/**
 * Class OpenAPIDocCreatedEvent
 */
class OpenAPIDocCreatedEvent extends DocEvent
{
    const EVENT_NAME = 'json_rpc_http_server_openapi_doc.array_created';

    /** @var array */
    private $openAPIDoc;
    /** @var HttpServerDoc */
    private $serverDoc;

    /**
     * @param array         $openAPIDoc
     * @param HttpServerDoc $serverDoc
     */
    public function __construct(array $openAPIDoc, HttpServerDoc $serverDoc)
    {

        $this->openAPIDoc = $openAPIDoc;
        $this->serverDoc = $serverDoc;
    }

    /**
     * @return array
     */
    public function getOpenAPIDoc() : array
    {
        return $this->openAPIDoc;
    }

    /**
     * @return HttpServerDoc
     */
    public function getServerDoc() : HttpServerDoc
    {
        return $this->serverDoc;
    }

    /**
     * @param array $openAPIDoc
     *
     * @return OpenAPIDocCreatedEvent
     */
    public function setOpenAPIDoc(array $openAPIDoc) : OpenAPIDocCreatedEvent
    {
        $this->openAPIDoc = $openAPIDoc;

        return $this;
    }
}
