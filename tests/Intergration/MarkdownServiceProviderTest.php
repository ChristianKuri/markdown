<?php

namespace ChristianKuri\Markdown\Tests\Intergration;

class MarkdownServiceProviderTest extends TestCase
{
    /** @test */
    public function it_can_register_markdown()
    {
        $this->assertInstanceOf(\ChristianKuri\Markdown\ParserManager::class, $this->app['markdown']);
    }

    /** @test */
    public function it_can_register_markdown_null_parser()
    {
        $this->assertInstanceOf(\ChristianKuri\Markdown\Parsers\NullParser::class, $this->app['markdown.parser']);
    }

    /** @test */
    public function it_can_register_markdown_parsedown_parser()
    {
        $this->app['config']['markdown.default'] = 'parsedown';

        $this->assertInstanceOf(\ChristianKuri\Markdown\Parsers\ParsedownParser::class, $this->app['markdown.parser']);
    }

    /** @test */
    public function it_can_register_markdown_parsedown_extra_parser()
    {
        $this->app['config']['markdown.default'] = 'parsedownextra';

        $this->assertInstanceOf(\ChristianKuri\Markdown\Parsers\ParsedownParser::class, $this->app['markdown.parser']);
    }

    /** @test */
    public function it_can_register_markdown_markdown_parser()
    {
        $this->app['config']['markdown.default'] = 'markdown';

        $this->assertInstanceOf(\ChristianKuri\Markdown\Parsers\MarkdownParser::class, $this->app['markdown.parser']);
    }

    /** @test */
    public function it_can_register_markdown_markdown_extra_parser()
    {
        $this->app['config']['markdown.default'] = 'markdownextra';

        $this->assertInstanceOf(\ChristianKuri\Markdown\Parsers\MarkdownParser::class, $this->app['markdown.parser']);
    }

    /** @test */
    public function it_can_register_markdown_commonmark_parser()
    {
        $this->app['config']['markdown.default'] = 'commonmark';

        $this->assertInstanceOf(\ChristianKuri\Markdown\Parsers\CommonMarkParser::class, $this->app['markdown.parser']);
    }

    /** @test */
    public function it_can_enable_markdown_blade_tags()
    {
        $this->app['config']['markdown.extend'] = true;

        $this->provider->register();

        $this->assertInstanceOf(\ChristianKuri\Markdown\Compilers\BladeCompiler::class, $this->app['blade.compiler']);
    }

    /** @test */
    public function it_can_ignore_markdown_blade_tags()
    {
        $this->app['config']['markdown.extend'] = false;

        $this->provider->register();

        $this->assertNotInstanceOf(\ChristianKuri\Markdown\Compilers\BladeCompiler::class, $this->app['blade.compiler']);
        $this->assertInstanceOf(\Illuminate\View\Compilers\BladeCompiler::class, $this->app['blade.compiler']);
    }

    /** @test */
    public function it_can_enable_markdown_views()
    {
        $this->app['config']['markdown.views'] = true;

        $this->provider->register();

        $actual = $this->app['view']->getExtensions();
        $expected = [
            'md.php' => 'markdown',
            'md' => 'markdown',
            'md-blade.php' => 'markdownblade',
            'md.blade.php' => 'markdownblade',
            'blade.php' => 'blade',
            'php' => 'php',
            'css' => 'file',
        ];

        $this->assertSame($expected, $actual);
    }

    /** @test */
    public function it_can_ignore_markdown_views()
    {
        $this->app['config']['markdown.views'] = false;

        $this->provider->register();

        $actual = $this->app['view']->getExtensions();
        $expected = [
            'blade.php' => 'blade',
            'php' => 'php',
            'css' => 'file',
        ];

        $this->assertSame($expected, $actual);
    }
}
