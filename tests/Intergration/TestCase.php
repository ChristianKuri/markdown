<?php

namespace ChristianKuri\Markdown\Tests\Intergration;

class TestCase extends \Orchestra\Testbench\TestCase
{
    protected $provider;

    protected function setUp()
    {
        parent::setUp();

        $this->app['view']->addLocation(__DIR__.'/fixture');

        $this->provider = new \ChristianKuri\Markdown\MarkdownServiceProvider($this->app);
    }

    protected function tearDown()
    {
        $this->artisan('view:clear');

        parent::tearDown();
    }

    protected function getPackageProviders($app)
    {
        return [
            \ChristianKuri\Markdown\MarkdownServiceProvider::class
        ];
    }

    protected function resolveApplicationConfiguration($app)
    {
        parent::resolveApplicationConfiguration($app);

        $app['config']['markdown.extend'] = false;
        $app['config']['markdown.views'] = false;
    }
}
