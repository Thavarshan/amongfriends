<?php

namespace App\Support;

use Illuminate\Support\Arr;
use League\CommonMark\Environment;
use League\CommonMark\CommonMarkConverter;
use League\CommonMark\Extension\GithubFlavoredMarkdownExtension;

class Markdown
{
    /**
     * Find the path to a localized Markdown resource.
     *
     * @param string $name
     *
     * @return string|null
     */
    public static function localizedMarkdownPath(string $name): ?string
    {
        $localName = preg_replace('#(\.md)$#i', '.' . app()->getLocale() . '$1', $name);
        $environment = Environment::createCommonMarkEnvironment();
        $environment->addExtension(new GithubFlavoredMarkdownExtension());

        return (new CommonMarkConverter([], $environment))->convertToHtml(
            file_get_contents(Arr::first([
                resource_path('markdown/' . $localName),
                resource_path('markdown/' . $name),
            ], function (string $path): bool {
                return file_exists($path);
            }))
        );
    }
}
