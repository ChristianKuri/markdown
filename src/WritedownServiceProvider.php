<?php

namespace ChristianKuri\Markdown;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use ChristianKuri\Markdown\Engines\CompilerEngine;
use ChristianKuri\Markdown\Compilers\BladeCompiler;
use ChristianKuri\Markdown\Compilers\MarkdownCompiler;
use ChristianKuri\Markdown\Compilers\BladeMarkdownCompiler;
use Illuminate\View\Engines\CompilerEngine as BaseCompilerEngine;

class MarkdownServiceProvider extends ServiceProvider
{
    /**
     * Boot the service provider.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/markdown.php' => config_path('markdown.php'),
        ], 'config');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/markdown.php', 'markdown');

        $this->registerMarkdown();
        $this->registerCompilersEngines();
    }

    /**
     * Register the Markdown parser.
     *
     * @return void
     */
    protected function registerMarkdown()
    {
        $this->app->singleton('markdown', function ($app) {
            return new ParserManager($app);
        });

        $this->app->singleton('markdown.parser', function ($app) {
            return (new ParserManager($app))->parser();
        });

        $this->app->alias('markdown', ParserManager::class);
    }

    /**
     * Register the Markdown compilers and engines.
     *
     * @return void
     */
    protected function registerCompilersEngines()
    {
        $resolver = $this->app['view.engine.resolver'];

        if ($this->app['config']['markdown.extend']) {
            $this->registerBladeEngine($resolver);
        }

        if ($this->app['config']['markdown.views']) {
            $this->registerMarkdownBladeEngine($resolver);
            $this->registerMarkdownEngine($resolver);
        }
    }

    /**
     * Overwrite the Blade engine implementation.
     *
     * @param  \Illuminate\View\Engines\EngineResolver  $resolver
     * @return void
     */
    protected function registerBladeEngine($resolver)
    {
        $app = $this->app;

        // The Compiler engine requires an instance of the CompilerInterface, which in
        // this case will be the Blade compiler, so we'll first create the compiler
        // instance to pass into the engine so it can compile the views properly.
        $app->singleton('blade.compiler', function ($app) {
            $cache = $app['config']['view.compiled'];

            return new BladeCompiler($app['files'], $cache);
        });

        $resolver->register('blade', function () use ($app) {
            return new BaseCompilerEngine($app['blade.compiler']);
        });
    }

    /**
     * Register the Markdown engine implementation.
     *
     * @param  \Illuminate\View\Engines\EngineResolver  $resolver
     * @return void
     */
    protected function registerMarkdownBladeEngine($resolver)
    {
        $app = $this->app;

        // The Compiler engine requires an instance of the CompilerInterface, which in
        // this case will be the Markdown compiler, so we'll first create the compiler
        // instance to pass into the engine so it can compile the views properly.
        $app->singleton('markdownblade.compiler', function ($app) {
            $cache = $app['config']['view.compiled'];

            return new BladeMarkdownCompiler($app['markdown.parser'], $app['files'], $cache);
        });

        $resolver->register('markdownblade', function () use ($app) {
            return new CompilerEngine($app['markdownblade.compiler']);
        });

        // Add markdown file extension to the view instance and
        // make the view instance to use the Markdown engine.
        $app['view']->addExtension('md.blade.php', 'markdownblade');
        $app['view']->addExtension('md-blade.php', 'markdownblade');
    }

    /**
     * Register the Markdown engine implementation.
     *
     * @param  \Illuminate\View\Engines\EngineResolver  $resolver
     * @return void
     */
    protected function registerMarkdownEngine($resolver)
    {
        $app = $this->app;

        // The Compiler engine requires an instance of the CompilerInterface, which in
        // this case will be the Markdown compiler, so we'll first create the compiler
        // instance to pass into the engine so it can compile the views properly.
        $app->singleton('markdown.compiler', function ($app) {
            $cache = $app['config']['view.compiled'];

            return new MarkdownCompiler($app['markdown.parser'], $app['files'], $cache);
        });

        $resolver->register('markdown', function () use ($app) {
            return new CompilerEngine($app['markdown.compiler']);
        });

        // Add markdown file extension to the view instance and
        // make the view instance to use the Markdown engine.
        $app['view']->addExtension('md', 'markdown');
        $app['view']->addExtension('md.php', 'markdown');
    }
}
