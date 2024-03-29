<?php
namespace DemoApp;

class DefaultKernel extends AbstractKernel
{
    public function getConfigDirectoryName() : string
    {
        return 'default_config';
    }
}
