<?php declare(strict_types=1);

namespace Ellipse\Adapters\Templating\Twig;

use Twig_Environment;
use Twig_Function;

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
     * @param \Twig_Environment $twig
     */
    public function __construct(Twig_Environment $twig)
    {
        $this->twig = $twig;
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
