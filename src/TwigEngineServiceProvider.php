<?php declare(strict_types=1);

namespace Ellipse\Adapters\Templating\Twig;

use Interop\Container\ServiceProvider;

use Ellipse\Contracts\Templating\EngineAdapterFactoryInterface;

class TwigEngineServiceProvider implements ServiceProvider
{
    public function getServices()
    {
        return [
            EngineAdapterFactoryInterface::class => function () {

                return new EngineAdapterFactory;

            },
        ];
    }
}
