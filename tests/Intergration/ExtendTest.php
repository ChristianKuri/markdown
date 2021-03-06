<?php

namespace ChristianKuri\Markdown\Tests\Intergration;

class ExtendTest extends TestCase
{
    /** @test */
    public function it_can_compile_blade_views_markdown_tags_with_parsedown()
    {
        $this->app['config']['markdown.default'] = 'parsedown';
        $this->app['config']['markdown.extend'] = true;

        $this->provider->register();

        $actual = $this->app['view']->make('blade')->render();
        $expected = "<h1>title</h1>\n<p>text</p>\n<p>{% ignore %}</p>\n<p>expression</p><p>block</p>";

        $this->assertSame($expected, $actual);
    }

    /** @test */
    public function it_can_compile_blade_views_markdown_tags_with_parsedown_extra()
    {
        $this->app['config']['markdown.default'] = 'parsedownextra';
        $this->app['config']['markdown.extend'] = true;

        $this->provider->register();

        $actual = $this->app['view']->make('blade')->render();
        $expected = "<h1>title</h1>\n<p>text</p>\n<p>{% ignore %}</p>\n<p>expression</p><p>block</p>";

        $this->assertSame($expected, $actual);
    }

    /** @test */
    public function it_can_compile_blade_views_markdown_tags_with_markdown()
    {
        $this->app['config']['markdown.default'] = 'markdown';
        $this->app['config']['markdown.extend'] = true;

        $this->provider->register();

        $actual = $this->app['view']->make('blade')->render();
        $expected = "<h1>title</h1>\n<p>text</p>\n\n<p>{% ignore %}</p>\n<p>expression</p>\n<p>block</p>\n";

        $this->assertSame($expected, $actual);
    }

    /** @test */
    public function it_can_compile_blade_views_markdown_tags_with_markdown_extra()
    {
        $this->app['config']['markdown.default'] = 'markdownextra';
        $this->app['config']['markdown.extend'] = true;

        $this->provider->register();

        $actual = $this->app['view']->make('blade')->render();
        $expected = "<h1>title</h1>\n<p>text</p>\n\n<p>{% ignore %}</p>\n<p>expression</p>\n<p>block</p>\n";

        $this->assertSame($expected, $actual);
    }

    /** @test */
    public function it_can_compile_blade_views_markdown_tags_with_commonmark()
    {
        $this->app['config']['markdown.default'] = 'commonmark';
        $this->app['config']['markdown.extend'] = true;

        $this->provider->register();

        $actual = $this->app['view']->make('blade')->render();
        $expected = "<h1>title</h1>\n<p>text</p>\n\n<p>{% ignore %}</p>\n<p>expression</p>\n<p>block</p>\n";

        $this->assertSame($expected, $actual);
    }

    /** @test */
    public function it_can_compile_blade_views_ignoring_markdown_tags()
    {
        $this->app['config']['markdown.extend'] = false;

        $this->provider->register();

        $actual = $this->app['view']->make('blade')->render();
        $expected = "<h1>title</h1>\n{% 'text' %}\n<p>@{% ignore %}</p>\n@markdown('expression')\n@markdown\nblock\n@endmarkdown\n";

        $this->assertSame($expected, $actual);
    }
}
