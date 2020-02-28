<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* body.html */
class __TwigTemplate_74ec6a71504344704e94b96a65a3a5551604d1714cc3ea49903a509d3c1991b8 extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
            'stylesheets' => [$this, 'block_stylesheets'],
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 1
        echo "<!DOCTYPE html>
<html>
\t<head>
\t\t<meta charset=\"utf-8\">
\t\t";
        // line 5
        $this->displayBlock('stylesheets', $context, $blocks);
        // line 8
        echo "\t</head>
\t<body>
\t\t<nav>
\t\t\t";
        // line 11
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["navigation"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
            echo "\t
\t\t\t\t<li><a href=\"";
            // line 12
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["item"], "getHref", [], "method", false, false, false, 12), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["item"], "getName", [], "method", false, false, false, 12), "html", null, true);
            echo "</a></li>
\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 14
        echo "\t\t</nav>
\t\t<div class=\"container\">
\t\t\t";
        // line 16
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["contentblocks"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["contentblock"]) {
            // line 17
            echo "\t\t\t\t<article>
\t\t\t\t\t<h1>";
            // line 18
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["contentblock"], "getName", [], "method", false, false, false, 18), "html", null, true);
            echo "</h1>
\t\t\t\t\t<p>";
            // line 19
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["contentblock"], "getContent", [], "method", false, false, false, 19), "html", null, true);
            echo "</p>
\t\t\t\t</article>
\t\t\t\t</section>
\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['contentblock'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 23
        echo "\t\t</div>
\t</body>
\t";
        // line 25
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["scripts"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["script"]) {
            // line 26
            echo "\t\t<script>
\t\t\t";
            // line 27
            echo twig_escape_filter($this->env, $context["script"], "html", null, true);
            echo "
\t\t</script>
\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['script'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 30
        echo "</html>
";
    }

    // line 5
    public function block_stylesheets($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 6
        echo "\t\t\t<link rel=\"stylesheet\" type=\"text/css\" href=\"styles/style.css\">
\t\t";
    }

    public function getTemplateName()
    {
        return "body.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  121 => 6,  117 => 5,  112 => 30,  103 => 27,  100 => 26,  96 => 25,  92 => 23,  82 => 19,  78 => 18,  75 => 17,  71 => 16,  67 => 14,  57 => 12,  51 => 11,  46 => 8,  44 => 5,  38 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "body.html", "/home/fire/Git/Y2P3/templates/body.html");
    }
}
