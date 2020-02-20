<?php

namespace ChristianKuri\Markdown\Tests\Unit\Compilers;

use ChristianKuri\Markdown\Compilers\BladeCompiler;

class BladeCompilerTest extends \ChristianKuri\Markdown\Tests\Unit\TestCase
{
    protected function setUp()
    {
        parent::setUp();

        $this->compiler = new BladeCompiler($this->filesystem, __DIR__);
    }

    /** @test */
    public function it_can_compile_unescaped_blade_tags()
    {
        $actual = $this->compiler->compileString('{!! $foo !!}');
        $expected = '<?php echo $foo; ?>';

        $this->assertSame($expected, $actual);
    }

    /** @test */
    public function it_can_compile_escaped_blade_tags()
    {
        $actual[] = $this->compiler->compileString('{{ $foo }}');
        $actual[] = $this->compiler->compileString('{{{ $foo }}}');
        $expected = '<?php echo e($foo); ?>';

        $this->assertSame($expected, $actual[0]);
        $this->assertSame($expected, $actual[1]);
    }

    /** @test */
    public function it_can_compile_untouched_blade_tags()
    {
        $actual = $this->compiler->compileString('@{{ foo }}');
        $expected = '{{ foo }}';

        $this->assertSame($expected, $actual);
    }

    /** @test */
    public function it_can_compile_markdown_tags()
    {
        $actual = $this->compiler->compileString('{% $foo %}');
        $expected = '<?php echo markdown($foo); ?>';

        $this->assertSame($expected, $actual);
    }

    /** @test */
    public function it_can_compile_untouched_markdown_tags()
    {
        $actual = $this->compiler->compileString('@{% foo %}');
        $expected = '{% foo %}';

        $this->assertSame($expected, $actual);
    }

    /** @test */
    public function it_can_compile_markdown_directives_expressions()
    {
        $actual = $this->compiler->compileString('@markdown(\'foo\')');
        $expected = '<?php echo markdown(\'foo\'); ?>';

        $this->assertSame($expected, $actual);
    }

    /** @test */
    public function it_can_compile_markdown_directives_block()
    {
        $actual = $this->compiler->compileString('@markdown foo @endmarkdown');
        $expected = '<?php echo markdown(\' foo \'); ?>';

        $this->assertSame($expected, $actual);
    }

    /** @test */
    public function it_can_compile_markdown_directives_alias_expressions()
    {
        $actual = $this->compiler->compileString('@markdown(\'foo\')');
        $expected = '<?php echo markdown(\'foo\'); ?>';

        $this->assertSame($expected, $actual);
    }

    /** @test */
    public function it_can_compile_markdown_directives_alias_block()
    {
        $actual = $this->compiler->compileString('@markdown foo @endmarkdown');
        $expected = '<?php echo markdown(\' foo \'); ?>';

        $this->assertSame($expected, $actual);
    }


}
