<?php declare(strict_types=1);

namespace Ellipse\Adapters\Templating\Twig;

use Twig\Loader\LoaderInterface;
use Twig\Environment;
use Twig\TwigFunction;

use Ellipse\Contracts\Templating\EngineAdapterInterface;

class EngineAdapter implements EngineAdapterInterface
{
    /**
     * The underlying twig loader.
     *
     * @var \Twig\Loader\LoaderInterface
     */
    private $loader;

    /**
     * The twig environment.
     *
     * @var \Twig\Environment
     */
    private $twig;

    /**
     * Set up a twig adapter with a twig loader instance and the twig options.
     *
     * @param \Twig\Loader\LoaderInterface  $loader
     * @param array                         $options
     */
    public function __construct(LoaderInterface $loader, array $options = [])
    {
        $this->loader = $loader;
        $this->twig = new Environment($loader, $options);
    }

    /**
     * @inheritdoc
     */
    public function registerNamespace(string $namespace, string $path): void
    {
        $this->loader->addPath($path, $namespace);
    }

    /**
     * @inheritdoc
     */
    public function registerFunction(string $name, callable $cb): void
    {
        $this->twig->addFunction(new TwigFunction($name, $cb));
    }

    /**
     * @inheritdoc
     */
    public function registerExtension($extension): void
    {
        $this->twig->addExtension($extension);
    }

    /**
     * @inheritdoc
     */
    public function render(string $file, array $data = []): string
    {
        return $this->twig->render($file, $data);
    }
}
