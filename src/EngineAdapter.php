<?php declare(strict_types=1);

namespace Ellipse\Adapters\Templating\Twig;

use Twig_Loader_Filesystem;
use Twig_Environment;
use Twig_Function;

use Ellipse\Contracts\Templating\EngineAdapterInterface;

class EngineAdapter implements EngineAdapterInterface
{
    /**
     * The underlying twig loader.
     *
     * @var \Twig_Loader_Filesystem
     */
    private $loader;

    /**
     * The underlying twig instance.
     *
     * @var \Twig_Environment
     */
    private $twig;

    /**
     * Set up a twig adapter with a twig loader instance and the twig options.
     *
     * @param \Twig_Environment $twig
     */
    public function __construct(Twig_Loader_Filesystem $loader, Twig_Environment $twig)
    {
        $this->loader = $loader;
        $this->twig = $twig;
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
        $this->twig->addFunction(new Twig_Function($name, $cb));
    }

    /**
     * @inheritdoc
     */
    public function render(string $file, array $data = []): string
    {
        return $this->twig->render($file, $data);
    }
}
