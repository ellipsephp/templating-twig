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
            Twig_Loader_Filesystem::class => function ($container) {

                $path = $container->get('templating.path');

                return new Twig_Loader_Filesystem($path);

            },

            Twig_Environment::class => function ($container) {

                $loader = $container->get(Twig_Loader_Filesystem::class);

                $options = $container->get('templating.options');

                return new Twig_Environment($loader, $options);

            },

            EngineInterface::class => function ($container) {

                $loader = $container->get(Twig_Loader_Filesystem::class);
                $twig = $container->get(Twig_Environment::class);

                return new EngineAdapter($loader, $twig);

            },
        ];
    }
}
