<?php declare(strict_types=1);

namespace Ellipse\Adapters\Templating\Twig;

use Interop\Container\ServiceProvider;

use Twig_Loader_Filesystem;
use Twig_Environment;

use Ellipse\Contracts\Templating\EngineAdapterInterface;

class TwigEngineServiceProvider implements ServiceProvider
{
    public function getServices()
    {
        return [
            // Provides a Twig_Loader_Filesystem implementation.
            Twig_Loader_Filesystem::class => function ($container) {

                $path = $container->get('templating.path');

                return new Twig_Loader_Filesystem($path);

            },

            // Provides a Twig_Environment implementation.
            Twig_Environment::class => function ($container) {

                $loader = $container->get(Twig_Loader_Filesystem::class);

                $options = $container->get('templating.options');

                return new Twig_Environment($loader, $options);

            },

            // Provides a Twig engine adapter.
            EngineAdapterInterface::class => function ($container) {

                $loader = $container->get(Twig_Loader_Filesystem::class);
                $twig = $container->get(Twig_Environment::class);

                return new EngineAdapter($loader, $twig);

            },
        ];
    }
}
