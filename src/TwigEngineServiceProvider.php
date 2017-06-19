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
            Twig_Environment::class => function ($container) {

                $path = $container->get('templating.path');

                $options = $container->has('templating.options')
                    ? $container->get('templating.options')
                    : [];

                $loader = new Twig_Loader_Filesystem($path);

                return new Twig_Environment($loader, $options);

            },

            EngineInterface::class => function ($container) {

                $twig = $container->get(Twig_Environment::class);

                return new EngineAdapter($twig);

            },
        ];
    }
}
