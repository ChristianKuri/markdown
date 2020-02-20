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
    protected function compileMarkdown($expression)
    {
        return $expression ? "<?php echo markdown$expression; ?>" : '<?php echo markdown(\'';
    }

    /**
     * Compile end Markdown statement into valid PHP.
     *
     * @param  string  $expression
     * @return string
     */
    protected function compileEndmarkdown($expression)
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
        return $this->compileMarkdown($expression);
    }

    /**
     * Alias for end Markdown directive.
     *
     * @param  string  $expression
     * @return string
     */
    protected function compileEndmarkdown($expression)
    {
        return $this->compileEndmarkdown($expression);
    }
}
