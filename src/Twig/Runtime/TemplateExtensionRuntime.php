<?php
namespace OSW3\TemplateTools\Twig\Runtime;

use Twig\Extension\RuntimeExtensionInterface;

class TemplateExtensionRuntime implements RuntimeExtensionInterface
{
    public function __construct(
    ){}

    public function getHtmlPath(string $file): string
    {
        return str_replace('.twig', '.html', $file);
    }
}