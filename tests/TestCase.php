<?php

abstract class TestCase extends Orchestra\Testbench\TestCase {

    protected function getPackageProviders()
    {
        return array('AbyssalArts\SteamApi\SteamApiServiceProvider');
    }

    protected function getPackageAliases()
    {
        return array(
            'SteamApi' => 'AbyssalArts\SteamApi\Facades\SteamApi'
        );
    }

    public function setUp()
    {
        parent::setUp();

        // Migrate the database
        Artisan::call('migrate');
    }
}