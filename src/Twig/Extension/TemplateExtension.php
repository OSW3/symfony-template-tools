<?php
namespace OSW3\TemplateTools\Twig\Extension;

use Twig\TwigFunction;
use Twig\Extension\AbstractExtension;
use OSW3\TemplateTools\Twig\Runtime\TemplateExtensionRuntime;

class TemplateExtension extends AbstractExtension
{
    public function getFunctions(): array
    {
        return [
            new TwigFunction('template_html_path', [TemplateExtensionRuntime::class, 'getHtmlPath']),
        ];
    }
}