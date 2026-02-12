<?php 
// src/Twig/IncludeSpyVisitor.php
namespace OSW3\TemplateTools\Twig;

use Twig\Environment;
use Twig\Node\Node;
use Twig\Node\IncludeNode;
use Twig\Node\PrintNode;
use Twig\Node\Expression\ConstantExpression;
use Twig\NodeVisitor\AbstractNodeVisitor;

class IncludeSpyVisitor extends AbstractNodeVisitor
{
    protected function doEnterNode(Node $node, Environment $env): Node
    {
        return $node;
    }

    protected function doLeaveNode(Node $node, Environment $env): Node|null
    {
        // On cible spécifiquement les balises {% include %}
        if ($node instanceof IncludeNode) {
            $templateName = $node->getNode('expr');
            
            // On crée un nœud de texte pour le début
            $startComment = new PrintNode(
                new ConstantExpression("\n\n<!-- >>>>>> START INCLUDE -->\n<!-- >>>>>> {$this->getDebugName($templateName)} -->\n\n", $node->getTemplateLine()),
                $node->getTemplateLine()
            );

            // On crée un nœud de texte pour la fin
            $endComment = new PrintNode(
                new ConstantExpression("\n\n<!-- <<<<<< {$this->getDebugName($templateName)} -->\n<!-- <<<<<< END INCLUDE -->\n\n", $node->getTemplateLine()),
                $node->getTemplateLine()
            );

            // On enveloppe l'include original
            return new Node([$startComment, $node, $endComment]);
        }

        return $node;
    }

    private function getDebugName(Node $expr): string
    {
        return ($expr instanceof ConstantExpression) ? $expr->getAttribute('value') : '(dynamic include)';
    }

    public function getPriority(): int { return 255; }
}