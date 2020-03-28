<?php
namespace Yoanm\SymfonyJsonRpcHttpServerOpenAPIDoc\Provider;

use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;
use Yoanm\JsonRpcHttpServerOpenAPIDoc\Infra\Normalizer\DocNormalizer;
use Yoanm\SymfonyJsonRpcHttpServerDoc\Creator\HttpServerDocCreator;
use Yoanm\SymfonyJsonRpcHttpServerDoc\Provider\DocProviderInterface;
use Yoanm\SymfonyJsonRpcHttpServerOpenAPIDoc\Event\OpenAPIDocCreatedEvent;

/**
 * Class DocProvider
 */
class DocProvider implements DocProviderInterface
{
    /** @var EventDispatcherInterface */
    private $dispatcher;
    /** @var HttpServerDocCreator */
    private $httpServerDocCreator;
    /** @var DocNormalizer */
    private $docNormalizer;

    /**
     * @param EventDispatcherInterface $dispatcher
     * @param HttpServerDocCreator         $HttpServerDocCreator
     * @param DocNormalizer     $docNormalizer
     */
    public function __construct(
        EventDispatcherInterface $dispatcher,
        HttpServerDocCreator $HttpServerDocCreator,
        DocNormalizer $docNormalizer
    ) {
        $this->dispatcher = $dispatcher;
        $this->httpServerDocCreator = $HttpServerDocCreator;
        $this->docNormalizer = $docNormalizer;
    }

    /**
     * @param string|null $host
     *
     * @return array
     *
     * @throws \ReflectionException
     */
    public function getDoc($host = null) : array
    {
        $rawDoc = $this->httpServerDocCreator->create($host);

        $openApiDoc = $this->docNormalizer->normalize($rawDoc);

        $event = new OpenAPIDocCreatedEvent($openApiDoc, $rawDoc);
        $this->dispatcher->dispatch($event, $event::EVENT_NAME);

        return $event->getOpenAPIDoc();
    }

    /**
     * {@inheritdoc}
     */
    public function supports($filename, $host = null) : bool
    {
        return 'openapi.json' === $filename;
    }
}
