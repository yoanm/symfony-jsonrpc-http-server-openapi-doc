<?php
namespace Tests\Functional\Endpoint;

use PHPUnit\Framework\TestCase;
use Prophecy\Prophecy\ObjectProphecy;
use Yoanm\JsonRpcServerDoc\Domain\Model\HttpServerDoc;
use Yoanm\SymfonyJsonRpcHttpServerOpenAPIDoc\Event\OpenAPIDocCreatedEvent;

/**
 * @covers \Yoanm\SymfonyJsonRpcHttpServerOpenAPIDoc\Event\OpenAPIDocCreatedEvent
 */
class OpenAPIDocCreatedEventTest extends TestCase
{
    /** @var OpenAPIDocCreatedEvent */
    private $event;

    /** @var array */
    private $openAPIDoc;
    /** @var HttpServerDoc|ObjectProphecy */
    private $serverDoc;

    protected function setUp(): void
    {
        $this->openAPIDoc = ['openApiDoc'];
        $this->serverDoc = $this->prophesize(HttpServerDoc::class);

        $this->event = new OpenAPIDocCreatedEvent(
            $this->openAPIDoc,
            $this->serverDoc->reveal()
        );
    }

    public function testShoulManageOpenApiDocAndServerDoc()
    {
        $this->assertSame($this->openAPIDoc, $this->event->getOpenAPIDoc());
        $this->assertSame($this->serverDoc->reveal(), $this->event->getServerDoc());
    }

    public function testOpenApiDocShouldBeOverridable()
    {
        $opeapiDoc = ['my-doc'];
        $this->event->setOpenAPIDoc($opeapiDoc);
        $this->assertSame($opeapiDoc, $this->event->getOpenAPIDoc());
    }
}
