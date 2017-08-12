<?php declare(strict_types=1);

namespace Ellipse\Adapters\Templating\Twig;

use Ellipse\Contracts\Templating\EngineAdapterFactoryInterface;
use Ellipse\Contracts\Templating\EngineAdapterInterface;

class EngineAdapterFactory implements EngineAdapterFactoryInterface
{
    /**
     * @inheritdoc
     */
    public function getEngine(string $path, array $options = []): EngineAdapterInterface
    {
        return EngineAdapter::withPath($path, $options);
    }
}
