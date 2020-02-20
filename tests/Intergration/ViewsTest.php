<?php

namespace ChristianKuri\Markdown\Tests\Intergration;

class ViewsTest extends TestCase
{
    /** @test */
    public function it_can_compile_markdown_blade_views_with_parsedown()
    {
        $this->app['config']['markdown.default'] = 'parsedown';
        $this->app['config']['markdown.views'] = true;

        $this->provider->register();

        $actual = $this->app['view']->make('markdownblade')->render();
        $expected = "<h1>title</h1>\n<p>text</p>\n<p><strong>text</strong></p>";

        $this->assertSame($expected, $actual);
    }

    /** @test */
    public function it_can_compile_markdown_views_with_parsedown()
    {
        $this->app['config']['markdown.default'] = 'parsedown';
        $this->app['config']['markdown.views'] = true;

        $this->provider->register();

        $actual[] = $this->app['view']->make('markdown')->render();
        $actual[] = $this->app['view']->make('markdownphp')->render();
        $expected = "<h1>title</h1>\n<p>text</p>\n<p><strong>text</strong></p>";

        $this->assertSame($expected, $actual[0]);
        $this->assertSame($expected, $actual[1]);
    }

    /** @test */
    public function it_can_compile_markdown_blade_views_with_parsedown_extra()
    {
        $this->app['config']['markdown.default'] = 'parsedownextra';
        $this->app['config']['markdown.views'] = true;

        $this->provider->register();

        $actual = $this->app['view']->make('markdownblade')->render();
        $expected = "<h1>title</h1>\n<p>text</p>\n<p><strong>text</strong></p>";

        $this->assertSame($expected, $actual);
    }

    /** @test */
    public function it_can_compile_markdown_views_with_parsedown_extra()
    {
        $this->app['config']['markdown.default'] = 'parsedownextra';
        $this->app['config']['markdown.views'] = true;

        $this->provider->register();

        $actual[] = $this->app['view']->make('markdown')->render();
        $actual[] = $this->app['view']->make('markdownphp')->render();
        $expected = "<h1>title</h1>\n<p>text</p>\n<p><strong>text</strong></p>";

        $this->assertSame($expected, $actual[0]);
        $this->assertSame($expected, $actual[1]);
    }

    /** @test */
    public function it_can_compile_markdown_blade_views_with_markdown()
    {
        $this->app['config']['markdown.default'] = 'markdown';
        $this->app['config']['markdown.views'] = true;

        $this->provider->register();

        $actual = $this->app['view']->make('markdownblade')->render();
        $expected = "<h1>title</h1>\n\n<p>text</p>\n\n<p><strong>text</strong></p>\n";

        $this->assertSame($expected, $actual);
    }

    /** @test */
    public function it_can_compile_markdown_views_with_markdown()
    {
        $this->app['config']['markdown.default'] = 'markdown';
        $this->app['config']['markdown.views'] = true;

        $this->provider->register();

        $actual[] = $this->app['view']->make('markdown')->render();
        $actual[] = $this->app['view']->make('markdownphp')->render();
        $expected = "<h1>title</h1>\n\n<p>text</p>\n\n<p><strong>text</strong></p>\n";

        $this->assertSame($expected, $actual[0]);
        $this->assertSame($expected, $actual[1]);
    }

    /** @test */
    public function it_can_compile_markdown_blade_views_with_markdown_extra()
    {
        $this->app['config']['markdown.default'] = 'markdownextra';
        $this->app['config']['markdown.views'] = true;

        $this->provider->register();

        $actual = $this->app['view']->make('markdownblade')->render();
        $expected = "<h1>title</h1>\n\n<p>text</p>\n\n<p><strong>text</strong></p>\n";

        $this->assertSame($expected, $actual);
    }

    /** @test */
    public function it_can_compile_markdown_views_with_markdown_extra()
    {
        $this->app['config']['markdown.default'] = 'markdownextra';
        $this->app['config']['markdown.views'] = true;

        $this->provider->register();

        $actual[] = $this->app['view']->make('markdown')->render();
        $actual[] = $this->app['view']->make('markdownphp')->render();
        $expected = "<h1>title</h1>\n\n<p>text</p>\n\n<p><strong>text</strong></p>\n";

        $this->assertSame($expected, $actual[0]);
        $this->assertSame($expected, $actual[1]);
    }

    /** @test */
    public function it_can_compile_markdown_blade_views_with_commonmark()
    {
        $this->app['config']['markdown.default'] = 'commonmark';
        $this->app['config']['markdown.views'] = true;

        $this->provider->register();

        $actual = $this->app['view']->make('markdownblade')->render();
        $expected = "<h1>title</h1>\n<p>text</p>\n<p><strong>text</strong></p>\n";

        $this->assertSame($expected, $actual);
    }

    /** @test */
    public function it_throws_a_view_not_found_invalid_argument_exception()
    {
        $this->app['config']['markdown.views'] = false;

        $this->provider->register();

        $this->expectException(\InvalidArgumentException::class);

        $this->app['view']->make('markdownblade')->render();
    }

}
