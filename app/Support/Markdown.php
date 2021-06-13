<?php

namespace App\Support;

use Illuminate\Support\Arr;
use League\CommonMark\Environment;
use League\CommonMark\CommonMarkConverter;
use League\CommonMark\Extension\ExtensionInterface;
use League\CommonMark\ConfigurableEnvironmentInterface;
use Emberfuse\Scorch\Support\Concerns\InteractsWithContainer;
use League\CommonMark\Extension\GithubFlavoredMarkdownExtension;

class Markdown
{
    use InteractsWithContainer;

    /**
     * The markdown parser environment instance.
     *
     * @var \League\CommonMark\ConfigurableEnvironmentInterface
     */
    protected $environment;

    /**
     * Create new markdown parser instance.
     *
     * @param \League\CommonMark\ConfigurableEnvironmentInterface|null $environment
     *
     * @return void
     */
    public function __construct(?ConfigurableEnvironmentInterface $environment = null)
    {
        if (is_null($environment)) {
            $environment = $this->createEnvironment();
        }

        $this->environment = $environment;
    }

    /**
     * Find the path to a localized Markdown resource.
     *
     * @param string $name
     *
     * @return string|null
     */
    public function localizedMarkdownPath(string $name): ?string
    {
        return (new CommonMarkConverter([], $this->environment))->convertToHtml(
            file_get_contents(Arr::first([
                resource_path('markdown/' . $this->getLocalName($name)),
                resource_path('markdown/' . $name),
            ], function (string $path): bool {
                return file_exists($path);
            }))
        );
    }

    /**
     * Create parser environment.
     *
     * @return \League\CommonMark\ConfigurableEnvironmentInterface
     */
    protected function createEnvironment(): ConfigurableEnvironmentInterface
    {
        $environment = Environment::createCommonMarkEnvironment();

        $environment->addExtension($this->createDefaultExtension());

        return $environment;
    }

    /**
     * Create an environment extension to be used for the parser.
     *
     * @return \League\CommonMark\Extension\ExtensionInterface
     */
    protected function createDefaultExtension(): ExtensionInterface
    {
        return new GithubFlavoredMarkdownExtension();
    }

    /**
     * Get the name of the file in default locale.
     *
     * @param string $name
     *
     * @return string
     */
    protected function getLocalName(string $name): string
    {
        return preg_replace(
            '#(\.md)$#i', '.' . $this->resolve()->getLocale() . '$1', $name
        );
    }
}
