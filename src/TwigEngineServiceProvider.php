<?php declare(strict_types=1);

namespace Ellipse\Adapters\Templating\Twig;

use Interop\Container\ServiceProvider;

use Twig\Loader\LoaderInterface;
use Twig\Loader\FilesystemLoader;

use Ellipse\Contracts\Templating\EngineAdapterInterface;

class TwigEngineServiceProvider implements ServiceProvider
{
    public function getServices()
    {
        return [
            // Provides a twig loader implementation. Can be overrided by the
            // end user.
            LoaderInterface::class => function ($container, $previous = null) {

                if (is_null($previous)) {

                    $path = $container->get('templating.path');

                    return new FilesystemLoader($path);

                }

                return $previous();

            },

            // Provides an engine adapter interface using the twig loader and
            // the templating options.
            EngineAdapterInterface::class => function ($container) {

                $loader = $container->get(LoaderInterface::class);
                $options = $container->get('templating.options');

                return new EngineAdapter($loader, $options);

            },
        ];
    }
}
