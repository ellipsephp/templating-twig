<?php declare(strict_types=1);

namespace Ellipse\Adapters\Templating\Twig;

use Twig\Loader\LoaderInterface;
use Twig\Loader\FilesystemLoader;
use Twig\Environment;
use Twig\TwigFunction;

use Ellipse\Contracts\Templating\EngineAdapterInterface;

class EngineAdapter implements EngineAdapterInterface
{
    /**
     * The twig loader.
     *
     * @var \Twig\Loader\LoaderInterface
     */
    private $loader;

    /**
     * The twig environment.
     *
     * @var \Twig\Environment
     */
    private $environment;

    /**
     * Create a new twig adapter with the given path and options.
     *
     * @param string    $path
     * @param array     $options
     * @return \Ellipse\Adapters\Templating\Twig\EngineAdapter
     */
    public static function withPath(string $path, array $options = []): EngineAdapter
    {
        $loader = new FilesystemLoader($path);

        return EngineAdapter::withLoader($loader);
    }

    /**
     * Create a new twig adapter with the given loader and options.
     *
     * @param Twig\Loader\LoaderInterface   $loader
     * @param array                         $options
     * @return \Ellipse\Adapters\Templating\Twig\EngineAdapter
     */
    public static function withLoader(LoaderInterface $loader, array $options = []): EngineAdapter
    {
        $twig = new Environment($loader, $options);

        return new EngineAdapter($loader, $twig);
    }

    /**
     * Set up a twig adapter with the given filesystem loader and the given
     * environment.
     *
     * @param Twig\Loader\LoaderInterface   $loader
     * @param \Twig\Environment             $environment
     */
    public function __construct(LoaderInterface $loader, Environment $environment)
    {
        $this->loader = $loader;
        $this->environment = $environment;
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
        $this->environment->addFunction(new TwigFunction($name, $cb));
    }

    /**
     * @inheritdoc
     */
    public function registerExtension($extension): void
    {
        $this->environment->addExtension($extension);
    }

    /**
     * @inheritdoc
     */
    public function render(string $file, array $data = []): string
    {
        return $this->environment->render($file, $data);
    }
}
