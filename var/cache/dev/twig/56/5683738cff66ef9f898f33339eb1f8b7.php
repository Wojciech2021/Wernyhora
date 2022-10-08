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

/* projects/projects_list.html.twig */
class __TwigTemplate_60084e7df369298047236b19adbbabea extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "projects/projects_list.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "projects/projects_list.html.twig"));

        // line 1
        echo "
<div class=\"container\">
    <table class=\"table\">
        <thead>
        <tr>
            <th>Nazwa:</th>
            <th>Opis:</th>
            <th>Data utworzenia:</th>
            <th>Data edycji:</th>
            <th></th>
        </tr>
        </thead>
        <tbody>

        ";
        // line 15
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["projectsArray"]) || array_key_exists("projectsArray", $context) ? $context["projectsArray"] : (function () { throw new RuntimeError('Variable "projectsArray" does not exist.', 15, $this->source); })()));
        foreach ($context['_seq'] as $context["_key"] => $context["project"]) {
            // line 16
            echo "            <tr>
                <td>";
            // line 17
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["project"], "name", [], "any", false, false, false, 17), "html", null, true);
            echo "</td>
                <td>";
            // line 18
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["project"], "description", [], "any", false, false, false, 18), "html", null, true);
            echo "</td>
                <td>";
            // line 19
            echo twig_escape_filter($this->env, twig_date_format_filter($this->env, twig_get_attribute($this->env, $this->source, $context["project"], "creationTime", [], "any", false, false, false, 19), "Y-m-d H:i:s"), "html", null, true);
            echo "</td>
                <td>";
            // line 20
            echo twig_escape_filter($this->env, twig_date_format_filter($this->env, twig_get_attribute($this->env, $this->source, $context["project"], "updateTime", [], "any", false, false, false, 20), "Y-m-d H:i:s"), "html", null, true);
            echo "</td>
                <td>
                    <button type=\"button\" class=\"btn btn-primary\"><a href=\"/projects/edit/";
            // line 22
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["project"], "id", [], "any", false, false, false, 22), "html", null, true);
            echo "\" class=\"text-white text-decoration-none\">Edycja</a></button>
                </td>
            </tr>

        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['project'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 27
        echo "
        </tbody>
    </table>
</div>
";
        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

    }

    public function getTemplateName()
    {
        return "projects/projects_list.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  94 => 27,  83 => 22,  78 => 20,  74 => 19,  70 => 18,  66 => 17,  63 => 16,  59 => 15,  43 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("
<div class=\"container\">
    <table class=\"table\">
        <thead>
        <tr>
            <th>Nazwa:</th>
            <th>Opis:</th>
            <th>Data utworzenia:</th>
            <th>Data edycji:</th>
            <th></th>
        </tr>
        </thead>
        <tbody>

        {% for project in projectsArray %}
            <tr>
                <td>{{ project.name }}</td>
                <td>{{ project.description }}</td>
                <td>{{ project.creationTime|date(\"Y-m-d H:i:s\") }}</td>
                <td>{{ project.updateTime|date(\"Y-m-d H:i:s\") }}</td>
                <td>
                    <button type=\"button\" class=\"btn btn-primary\"><a href=\"/projects/edit/{{ project.id }}\" class=\"text-white text-decoration-none\">Edycja</a></button>
                </td>
            </tr>

        {% endfor %}

        </tbody>
    </table>
</div>
", "projects/projects_list.html.twig", "D:\\Studia\\Praca magisterska\\Projekt_Wernyhora\\Wernyhora\\templates\\projects\\projects_list.html.twig");
    }
}
