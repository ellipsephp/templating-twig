<?php

use Ellipse\Contracts\Templating\EngineAdapterFactoryInterface;

use Ellipse\Adapters\Templating\Twig\EngineAdapterFactory;
use Ellipse\Adapters\Templating\Twig\EngineAdapter;

describe('EngineAdapterFactory', function () {

    beforeEach(function () {

        $this->factory = new EngineAdapterFactory;

    });

    it('should implement EngineAdapterFactoryInterface', function () {

        expect($this->factory)->to->be->an->instanceof(EngineAdapterFactoryInterface::class);

    });

    describe('->getEngine()', function () {

        it('should return an instance of EngineAdapter', function () {

            $path = sys_get_temp_dir();

            $engine = $this->factory->getEngine($path);

            expect($engine)->to->be->an->instanceof(EngineAdapter::class);

        });

    });

});
