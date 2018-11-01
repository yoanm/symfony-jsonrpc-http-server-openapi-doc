<?php
namespace Tests\Functional\DependencyInjection;

use Tests\Common\DependencyInjection\AbstractTestClass;
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
}
