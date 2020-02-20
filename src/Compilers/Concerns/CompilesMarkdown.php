<?php

namespace ChristianKuri\Markdown\Compilers\Concerns;

trait CompilesMarkdown
{
    /**
     * Compile the raw Markdown statements into valid PHP.
     *
     * @param  string  $expression
     * @return string
     */
    protected function compileMarkdownStatement($expression)
    {
        return $expression ? "<?php echo markdown$expression; ?>" : '<?php echo markdown(\'';
    }

    /**
     * Compile end Markdown statement into valid PHP.
     *
     * @param  string  $expression
     * @return string
     */
    protected function compileEndmarkdownStatement($expression)
    {
        return '\'); ?>';
    }

    /**
     * Alias for Markdown directive.
     *
     * @param  string  $expression
     * @return string
     */
    protected function compileMarkdown($expression)
    {
        return $this->compileMarkdownStatement($expression);
    }

    /**
     * Alias for end Markdown directive.
     *
     * @param  string  $expression
     * @return string
     */
    protected function compileEndmarkdown($expression)
    {
        return $this->compileEndmarkdownStatement($expression);
    }
}
