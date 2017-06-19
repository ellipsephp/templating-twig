<?php declare(strict_types=1);

namespace Ellipse\Adapters\Templating\Twig;

use Interop\Container\ServiceProvider;

use Twig_Loader_Filesystem;
use Twig_Environment;

use Ellipse\Contracts\Templating\EngineInterface;

class TwigEngineServiceProvider implements ServiceProvider
{
    public function getServices()
    {
        return [
            EngineInterface::class => function ($container) {

                $path = $container->get('templating.path');

                $options = $container->has('templating.options')
                    ? $container->get('templating.options')
                    : [];

                $loader = new Twig_Loader_Filesystem($path);

                $twig = new Twig_Environment($loader, $options);

                return new EngineAdapter($twig);

            },
        ];
    }
}
