<?php declare(strict_types=1);

namespace Ellipse\Adapters\Templating;

use Exception;

use Interop\Container\ServiceProvider;

use Twig_Loader_Filesystem;

use Ellipse\Contracts\Templating\EngineInterface;

class TwigEngineServiceProvider implements ServiceProvider
{
    public function getServices()
    {
        return [
            EngineInterface::class => function ($container) {

                $path = $container->get('templating.path');

                try {

                    $options = $container->get('templating.options');

                }

                catch (Exception $e) {

                    $options = [];

                }

                $twig = new Twig_Loader_Filesystem($path);

                return new EngineAdapter($twig, $options);

            },
        ];
    }
}
