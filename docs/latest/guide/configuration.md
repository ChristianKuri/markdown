# Configuration

## Options

### Default Markdown Parser

The option `default` specifies the default parser markdown will use to parse markdown into valid HTML. You may set the choosen parser inside the configuration file array or inside your `.env` file with the key `MARKDOWN_PARSER`.

#### Enable Markdown Extensions

The option `tags` specifies if you wish to extend blade with markdown tags and directives.  If set to `true` you will be able to render markdown via the "curly" braces  `{% raw %}{%{% endraw %}` `{% raw %}%}{% endraw %}` and `@markdown` inside your `blade.php` files.

#### Enable Views Extensions

The option `views` specifies if you wish to intergrate extended views extensions.  If set to `true` you will be able to render markdown views with the following extensions:  `*.md`, `*.md.php`, and `*.md.blade.php`.

#### Parsers Configuration

The option `parsers` specifies the driver name as well as the configuration of the choosen parser. For available configuration you will need to look at the parser documentation.

## Publish The Configuration

You will need to pull the configuration in you app's configuration folder to make modifications to the default configuration. You can achieve this with the following artisan command:

``` bash
php artisan vendor:publish --provider "ChristianKuri\Markdown\MarkdownServiceProvider"
```

The configuration file will be created at `config/markdown.php`.
