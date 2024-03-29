<?php
namespace DemoApp;

class KernelWithDocCreatedListener extends AbstractKernel
{
    public function getConfigDirectoryName() : string
    {
        return 'config_with_doc_created_listener';
    }
}
