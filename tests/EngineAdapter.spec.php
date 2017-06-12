<?php

use Ellipse\Contracts\Templating\EngineInterface;

use Ellipse\Adapters\Templating\Twig\EngineAdapter;

describe('EngineAdapter', function () {

    beforeEach(function () {

        $this->decorated = Mockery::mock(Twig_Environment::class);

        $this->engine = new EngineAdapter($this->decorated);

    });

    it('should implement EngineInterface', function () {

        expect($this->engine)->to->be->an->instanceof(EngineInterface::class);

    });

    describe('->render()', function () {

        it('should proxy the underlying twig instance render method', function () {

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
