<?php

use Twig\Loader\LoaderInterface;
use Twig\Environment;
use Twig\TwigFunction;
use Twig\Extension\ExtensionInterface;

use Ellipse\Contracts\Templating\EngineAdapterInterface;

use Ellipse\Adapters\Templating\Twig\EngineAdapter;

describe('EngineAdapter', function () {

    beforeEach(function () {

        $this->loader = Mockery::mock(LoaderInterface::class);
        $this->environment = Mockery::mock(Environment::class);

        $this->engine = new EngineAdapter($this->loader, $this->environment);

    });

    afterEach(function () {

        Mockery::close();

    });

    it('should implement EngineAdapterInterface', function () {

        expect($this->engine)->to->be->an->instanceof(EngineAdapterInterface::class);

    });

    describe('::withPath()', function () {

        it('should return a new EngineAdapter', function () {

            $path = sys_get_temp_dir();

            $test = EngineAdapter::withPath($path);

            expect($test)->to->be->an->instanceof($test);

        });

    });

    describe('->registerNamespace()', function () {

        it('should proxy the underlying loader ->addPath() method', function () {

            $this->loader->shouldReceive('addPath')->once()
                ->with('path', 'namespace');

            $this->engine->registerNamespace('namespace', 'path');

        });

    });

    describe('->registerFunction()', function () {

        it('should proxy the underlying twig environment ->addFunction() method', function () {

            $this->environment->shouldReceive('addFunction')->once()
                ->with(Mockery::type(TwigFunction::class));

            $this->engine->registerFunction('name', function () {});

        });

    });

    describe('->registerExtension()', function () {

        it('should proxy the underlying twig environment ->addExtension() method', function () {

            $extension = Mockery::mock(ExtensionInterface::class);

            $this->environment->shouldReceive('addExtension')->once()
                ->with($extension);

            $this->engine->registerExtension($extension);

        });

    });

    describe('->render()', function () {

        it('should proxy the underlying twig environment ->render() method', function () {

            $this->environment->shouldReceive('render')->once()
                ->with('name', ['data'])
                ->andReturn('contents');

            $test = $this->engine->render('name', ['data']);

            expect($test)->to->be->equal('contents');

        });

    });

});
