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
    /** @var HttpServerDoc|null */
    private $serverDoc;

    /**
     * @param array              $openAPIDoc
     * @param HttpServerDoc|null $serverDoc
     */
    public function __construct(
        array $openAPIDoc,
        HttpServerDoc $serverDoc = null
    ) {

        $this->openAPIDoc = $openAPIDoc;
        $this->serverDoc = $serverDoc;
    }

    /**
     * @return array
     */
    public function getOpenAPIDoc()
    {
        return $this->openAPIDoc;
    }

    /**
     * @return HttpServerDoc|null
     */
    public function getServerDoc()
    {
        return $this->serverDoc;
    }

    /**
     * @param array $openAPIDoc
     *
     * @return OpenAPIDocCreatedEvent
     */
    public function setOpenAPIDoc(array $openAPIDoc)
    {
        $this->openAPIDoc = $openAPIDoc;

        return $this;
    }
}
