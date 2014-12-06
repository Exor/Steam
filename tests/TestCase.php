<?php

abstract class TestCase extends Orchestra\Testbench\TestCase {

    protected function getPackageProviders()
    {
        return array('Syntax\SteamApi\SteamApiServiceProvider');
    }

    protected function getPackageAliases()
    {
        return array(
            'SteamApi' => 'Syntax\SteamApi\Facades\SteamApi'
        );
    }

    public function setUp()
    {
        parent::setUp();

        // Your code here
    }



}