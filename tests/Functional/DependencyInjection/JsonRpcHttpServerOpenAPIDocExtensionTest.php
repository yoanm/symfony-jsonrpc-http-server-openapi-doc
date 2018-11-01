<?php
namespace Tests\Functional\DependencyInjection;

use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Reference;
use Tests\Common\DependencyInjection\AbstractTestClass;
use Tests\Common\DependencyInjection\ConcreteDocProvider;
use Yoanm\SymfonyJsonRpcHttpServerOpenAPIDoc\DependencyInjection\JsonRpcHttpServerDocExtension;
use Yoanm\SymfonyJsonRpcHttpServerOpenAPIDoc\DependencyInjection\JsonRpcHttpServerOpenAPIDocExtension;

/**
 * @covers \Yoanm\SymfonyJsonRpcHttpServerOpenAPIDoc\DependencyInjection\JsonRpcHttpServerOpenAPIDocExtension
 */
class JsonRpcHttpServerOpenAPIDocExtensionTest extends AbstractTestClass
{
    public function testShouldBeLoadable()
    {
        $this->load();

        $this->assertDocProviderIsLoadable();
    }

    public function testShouldReturnAnXsdValidationBasePath()
    {
        $this->assertNotNull((new JsonRpcHttpServerOpenAPIDocExtension())->getXsdValidationBasePath());
    }

    public function testShouldBindDocProviderToNormalizedDocFinder()
    {
        $docProviderServiceId =  'my-doc-provider';
        $docProviderServiceDefinition = new Definition(ConcreteDocProvider::class);
        $docProviderServiceDefinition->addTag(self::EXPECTED_DOC_PROVIDER_TAG);

        $this->setDefinition($docProviderServiceId, $docProviderServiceDefinition);

        $this->load();

        // Assert custom resolver is an alias of the stub
        $this->assertContainerBuilderHasServiceDefinitionWithMethodCall(
            self::EXPECTED_NORMALIZED_DOC_FINDER_SERVICE_ID,
            'addProvider',
            [new Reference($docProviderServiceId)],
            0
        );

        $this->assertDocProviderIsLoadable();
    }
}
