<?php
namespace Tests\Functional\DependencyInjection;

use Tests\Common\DependencyInjection\AbstractTestClass;
use Yoanm\JsonRpcHttpServerOpenAPIDoc\App\Normalizer\Component\ErrorDocNormalizer;
use Yoanm\JsonRpcHttpServerOpenAPIDoc\App\Normalizer\Component\ExternalSchemaListDocNormalizer;
use Yoanm\JsonRpcHttpServerOpenAPIDoc\App\Normalizer\Component\OperationDocNormalizer;
use Yoanm\JsonRpcHttpServerOpenAPIDoc\App\Normalizer\Component\RequestDocNormalizer;
use Yoanm\JsonRpcHttpServerOpenAPIDoc\App\Normalizer\Component\ResponseDocNormalizer;
use Yoanm\JsonRpcHttpServerOpenAPIDoc\App\Normalizer\Component\SchemaTypeNormalizer;
use Yoanm\JsonRpcHttpServerOpenAPIDoc\App\Normalizer\Component\ShapeNormalizer;
use Yoanm\JsonRpcHttpServerOpenAPIDoc\App\Normalizer\Component\TypeDocNormalizer;
use Yoanm\JsonRpcHttpServerOpenAPIDoc\App\Resolver\DefinitionRefResolver;
use Yoanm\JsonRpcHttpServerOpenAPIDoc\Infra\Normalizer\DocNormalizer;
use Yoanm\SymfonyJsonRpcHttpServerDoc\DependencyInjection\JsonRpcHttpServerDocExtension;
use Yoanm\SymfonyJsonRpcHttpServerOpenAPIDoc\Provider\DocProvider;

/**
 * /!\ This test class does not cover JsonRpcHttpServerDocExtension, it covers yaml configuration files
 * => So no [at]covers tag !
 */
class ConfigFilesTest extends AbstractTestClass
{
    /**
     * @dataProvider provideSDKInfraServiceIdAndClass
     * @dataProvider provideSDKAppServiceIdAndClass
     * @dataProvider provideBundlePublicServiceIdAndClass
     *
     * @param string $serviceId
     * @param string $expectedClassName
     * @param bool   $public
     */
    public function testShouldHaveService($serviceId, $expectedClassName, $public)
    {
        $this->loadContainer();

        $this->assertContainerBuilderHasService($serviceId, $expectedClassName);
        if (true === $public) {
            // Check that service is accessible through the container
            $this->assertNotNull($this->container->get($serviceId));
        }
    }

    public function testDocProviderShouldHaveDocProviderTag()
    {
        $this->loadContainer();

        // From yoanm/symfony-jsonrpc-http-server
        $this->assertContainerBuilderHasServiceDefinitionWithTag(
            self::EXPECTED_DOC_PROVIDER_SERVICE_ID,
            JsonRpcHttpServerDocExtension::DOC_PROVIDER_TAG
        );
    }

    /**
     * @return array
     */
    public function provideSDKInfraServiceIdAndClass()
    {
        return [
            'SDK - Infra - DocNormalizer' => [
                'serviceId' => 'json_rpc_http_server_open_api_doc_sdk.normalizer.doc',
                'serviceClassName' => DocNormalizer::class,
                'public' => true,
            ],
        ];
    }

    /**
     * @return array
     */
    public function provideSDKAppServiceIdAndClass()
    {
        return [
            'SDK - APP - DefinitionRefResolver' => [
                'serviceId' => 'json_rpc_http_server_open_api_doc_sdk.app.resolver.definition_ref',
                'serviceClassName' => DefinitionRefResolver::class,
                'public' => false,
            ],
            'SDK - APP - SchemaTypeNormalizer' => [
                'serviceId' => 'json_rpc_http_server_open_api_doc_sdk.app.normalizer.component.schema_type',
                'serviceClassName' => SchemaTypeNormalizer::class,
                'public' => false,
            ],
            'SDK - APP - TypeDocNormalizer' => [
                'serviceId' => 'json_rpc_http_server_open_api_doc_sdk.app.normalizer.component.type_doc',
                'serviceClassName' => TypeDocNormalizer::class,
                'public' => false,
            ],
            'SDK - APP - ShapeNormalizer' => [
                'serviceId' => 'json_rpc_http_server_open_api_doc_sdk.app.normalizer.component.shape',
                'serviceClassName' => ShapeNormalizer::class,
                'public' => false,
            ],
            'SDK - APP - ErrorDocNormalizer' => [
                'serviceId' => 'json_rpc_http_server_open_api_doc_sdk.app.normalizer.component.error',
                'serviceClassName' => ErrorDocNormalizer::class,
                'public' => false,
            ],
            'SDK - APP - ExternalSchemaListDocNormalizer' => [
                'serviceId' => 'json_rpc_http_server_open_api_doc_sdk.app.normalizer.component.external_schema_list',
                'serviceClassName' => ExternalSchemaListDocNormalizer::class,
                'public' => false,
            ],'SDK - APP - RequestDocNormalizer' => [
                'serviceId' => 'json_rpc_http_server_open_api_doc_sdk.app.normalizer.component.request',
                'serviceClassName' => RequestDocNormalizer::class,
                'public' => false,
            ],
            'SDK - APP - ResponseDocNormalizer' => [
                'serviceId' => 'json_rpc_http_server_open_api_doc_sdk.app.normalizer.component.response',
                'serviceClassName' => ResponseDocNormalizer::class,
                'public' => false,
            ],
            'SDK - APP - OperationDocNormalizer' => [
                'serviceId' => 'json_rpc_http_server_open_api_doc_sdk.app.normalizer.component.operation',
                'serviceClassName' => OperationDocNormalizer::class,
                'public' => false,
            ],
        ];
    }

    /**
     * @return array
     */
    public function provideBundlePublicServiceIdAndClass()
    {
        return [
            'Bundle - Public - DocProvider' => [
                'serviceId' => 'json_rpc_http_server_open_api_doc.provider',
                'serviceClassName' => DocProvider::class,
                'public' => true,
            ],
        ];
    }
}
