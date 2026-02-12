<?php 
// src/Twig/AppTwigExtension.php
namespace OSW3\TemplateTools\Twig;

use OSW3\TemplateTools\Twig\IncludeSpyVisitor;
use Twig\Extension\AbstractExtension;

class AppTwigExtension extends AbstractExtension
{
    public function getNodeVisitors(): array
    {
        return [new IncludeSpyVisitor()];
    }
}