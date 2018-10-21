<?php
namespace Yoanm\SymfonyJsonRpcHttpServerOpenAPIDoc\Provider;

use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Yoanm\JsonRpcHttpServerOpenAPIDoc\Normalizer\DocNormalizer;
use Yoanm\JsonRpcServerDoc\Model\HttpServerDoc;
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
    private $HttpServerDocCreator;
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
        $this->HttpServerDocCreator = $HttpServerDocCreator;
        $this->docNormalizer = $docNormalizer;
    }

    /**
     * @param string|null $host
     *
     * @return array
     */
    public function getDoc($host = null)
    {
        $rawDoc = $this->HttpServerDocCreator->create($host);

        $openApiDoc = $this->docNormalizer->normalize($rawDoc);

        $event = new OpenAPIDocCreatedEvent($openApiDoc, $rawDoc);
        $this->dispatcher->dispatch($event::EVENT_NAME, $event);

        return $event->getOpenAPIDoc();
    }

    /**
     * {@inheritdoc}
     */
    public function supports($filename, $host = null)
    {
        return 'openapi.json' === $filename;
    }
}
