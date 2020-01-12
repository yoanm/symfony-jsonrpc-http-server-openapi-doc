<?php
namespace Tests\Functional\Endpoint;

use PHPUnit\Framework\TestCase;
use Prophecy\Argument;
use Prophecy\Prophecy\ObjectProphecy;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Yoanm\JsonRpcHttpServerOpenAPIDoc\Infra\Normalizer\DocNormalizer;
use Yoanm\JsonRpcServerDoc\Domain\Model\HttpServerDoc;
use Yoanm\SymfonyJsonRpcHttpServerDoc\Creator\HttpServerDocCreator;
use Yoanm\SymfonyJsonRpcHttpServerOpenAPIDoc\Event\OpenAPIDocCreatedEvent;
use Yoanm\SymfonyJsonRpcHttpServerOpenAPIDoc\Provider\DocProvider;

/**
 * @covers \Yoanm\SymfonyJsonRpcHttpServerOpenAPIDoc\Provider\DocProvider
 */
class DocProviderTest extends TestCase
{
    /** @var DocProvider */
    private $provider;

    /** @var EventDispatcherInterface|ObjectProphecy */
    private $dispatcher;
    /** @var HttpServerDocCreator|ObjectProphecy */
    private $httpServerDocCreator;
    /** @var DocNormalizer|ObjectProphecy */
    private $docNormalizer;

    protected function setUp(): void
    {
        $this->dispatcher = $this->prophesize(EventDispatcherInterface::class);
        $this->httpServerDocCreator = $this->prophesize(HttpServerDocCreator::class);
        $this->docNormalizer = $this->prophesize(DocNormalizer::class);

        $this->provider = new DocProvider(
            $this->dispatcher->reveal(),
            $this->httpServerDocCreator->reveal(),
            $this->docNormalizer->reveal()
        );
    }

    public function testShouldCreateHttpServerDocAndNormalizeIt()
    {
        $host = 'host';
        $normalizedDoc = ['normalized-doc'];

        /** @var HttpServerDoc|ObjectProphecy $rawDoc */
        $rawDoc = $this->prophesize(HttpServerDoc::class);

        $this->httpServerDocCreator->create($host)
            ->willReturn($rawDoc->reveal())
            ->shouldBeCalled()
        ;

        $this->docNormalizer->normalize($rawDoc->reveal())
            ->willReturn($normalizedDoc)
            ->shouldBeCalled()
        ;

        $this->assertSame(
            $normalizedDoc,
            $this->provider->getDoc($host)
        );
    }

    public function testShouldDispatchAnEvent()
    {
        $host = 'host';
        $normalizedDoc = ['normalized-doc'];

        /** @var HttpServerDoc|ObjectProphecy $rawDoc */
        $rawDoc = $this->prophesize(HttpServerDoc::class);

        $this->httpServerDocCreator->create($host)
            ->willReturn($rawDoc->reveal())
            ->shouldBeCalled()
        ;

        $this->docNormalizer->normalize($rawDoc->reveal())
            ->willReturn($normalizedDoc)
            ->shouldBeCalled()
        ;

        $this->dispatcher
            ->dispatch(
                OpenAPIDocCreatedEvent::EVENT_NAME,
                Argument::allOf(
                    Argument::type(OpenAPIDocCreatedEvent::class),
                    Argument::which('getOpenAPIDoc', $normalizedDoc),
                    Argument::which('getServerDoc', $rawDoc->reveal())
                )
            )
            ->shouldBeCalled()
        ;

        $this->provider->getDoc($host);
    }

    public function testShouldSupportOpenApiJsonFile()
    {
        $filename = 'openapi.json';
        $this->assertTrue($this->provider->supports($filename));
    }
}
