<?php

use Ellipse\Contracts\Templating\EngineInterface;

use Ellipse\Adapters\Templating\Twig\EngineAdapter;

describe('EngineAdapter', function () {

    beforeEach(function () {

        $this->loader = Mockery::mock(Twig_Loader_Filesystem::class);
        $this->decorated = Mockery::mock(Twig_Environment::class);

        $this->engine = new EngineAdapter($this->loader, $this->decorated);

    });

    it('should implement EngineInterface', function () {

        expect($this->engine)->to->be->an->instanceof(EngineInterface::class);

    });

    describe('->registerNamespace()', function () {

        it('should proxy the underlying twig engine addFunction method', function () {

            $namespace = 'namespace';
            $path = 'path';

            $this->loader->shouldReceive('addPath')->once()
                ->with($path, $namespace);

            $this->engine->registerNamespace($namespace, $path);

        });

    });

    describe('->registerFunction()', function () {

        it('should proxy the underlying twig engine addFunction method', function () {

            $name = 'name';
            $cb = function () {};

            $this->decorated->shouldReceive('addFunction')->once()
                ->with(Mockery::type(Twig_Function::class));

            $this->engine->registerFunction($name, $cb);

        });

    });

    describe('->render()', function () {

        it('should proxy the underlying twig engine render method', function () {

            $name = 'name';
            $data = ['data'];
            $expected = 'expected';

            $this->decorated->shouldReceive('render')->once()
                ->with($name, $data)
                ->andReturn($expected);

            $test = $this->engine->render($name, $data);

            expect($test)->to->be->equal($expected);

        });

    });

});
