<?php

if (! function_exists('markdown')) {
    /**
     * Parse markdown content into HTML.
     *
     * @param  string  $content
     * @return string
     */
    function markdown($content)
    {
        return app('markdown')->content($content)->toHtml();
    }
}
