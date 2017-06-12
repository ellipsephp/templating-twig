<?php declare(strict_types=1);

namespace Ellipse\Adapters\Templating;

use Twig_LoaderInterface;
use Twig_Environment;

use Ellipse\Contracts\Templating\EngineInterface;

class EngineAdapter implements EngineInterface
{
    /**
     * The underlying twig instance.
     *
     * @var \Twig_Environment
     */
    private $twig;

    /**
     * Set up a twig adapter with a twig loader instance and the twig options.
     *
     * @param \Twig_LoaderInterface $loader
     * @param array                 $options
     */
    public function __construct(Twig_LoaderInterface $loader, array $options = [])
    {
        $this->twig = new Twig_Environment($loader, $options);
    }

    /**
     * @inheritdoc
     */
    public function render(string $file, array $values = []): string
    {
        return $this->twig->render($file, $values);
    }
}
