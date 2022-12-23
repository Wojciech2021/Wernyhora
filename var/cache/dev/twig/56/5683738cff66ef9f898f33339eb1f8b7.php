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
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["project"], "slug", [], "any", false, false, false, 22), "html", null, true);
            echo "\" class=\"text-white text-decoration-none\">Edycja</a></button>
                </td>
                <td>
                    <button type=\"button\" class=\"btn btn-danger\" onclick=\"return confirm('Czy jesteś pewien że chcesz usunąć projekt?')\"><a href=\"/projects/delete/";
            // line 25
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["project"], "slug", [], "any", false, false, false, 25), "html", null, true);
            echo "\" class=\"text-white text-decoration-none\">Usuń</a></button>
                </td>
                ";
            // line 27
            if ((((((((((((twig_length_filter($this->env, twig_get_attribute($this->env, $this->source,             // line 28
$context["project"], "critery", [], "any", false, false, false, 28)) && twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["project"], "critery", [], "any", false, false, false, 28), 0, [], "array", false, false, false, 28), "VariantValue", [], "any", false, false, false, 28))) && twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source,             // line 29
$context["project"], "critery", [], "any", false, false, false, 29), 0, [], "array", false, false, false, 29), "alfaQ", [], "any", false, false, false, 29)) && twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["project"], "critery", [], "any", false, false, false, 29), 0, [], "array", false, false, false, 29), "betaQ", [], "any", false, false, false, 29)) && twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source,             // line 30
$context["project"], "critery", [], "any", false, false, false, 30), 0, [], "array", false, false, false, 30), "alfaP", [], "any", false, false, false, 30)) && twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["project"], "critery", [], "any", false, false, false, 30), 0, [], "array", false, false, false, 30), "betaP", [], "any", false, false, false, 30)) && twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source,             // line 31
$context["project"], "critery", [], "any", false, false, false, 31), 0, [], "array", false, false, false, 31), "alfaV", [], "any", false, false, false, 31)) && twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["project"], "critery", [], "any", false, false, false, 31), 0, [], "array", false, false, false, 31), "betaV", [], "any", false, false, false, 31)) && twig_length_filter($this->env, twig_get_attribute($this->env, $this->source,             // line 32
$context["project"], "variant", [], "any", false, false, false, 32))) && twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, $context["project"], "klas", [], "any", false, false, false, 32))) && twig_length_filter($this->env, twig_get_attribute($this->env, $this->source,             // line 33
$context["project"], "profil", [], "any", false, false, false, 33))) && twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["project"], "profil", [], "any", false, false, false, 33), 0, [], "array", false, false, false, 33), "profilValue", [], "any", false, false, false, 33)))) {
                // line 34
                echo "                <td>
                    <button type=\"button\" class=\"btn btn-warning\"><a href=\"/projects/raport/";
                // line 35
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["project"], "slug", [], "any", false, false, false, 35), "html", null, true);
                echo "\" class=\"text-white text-decoration-none\">Raport</a></button>
                </td>
                ";
            }
            // line 38
            echo "            </tr>

        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['project'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 41
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
        return array (  119 => 41,  111 => 38,  105 => 35,  102 => 34,  100 => 33,  99 => 32,  98 => 31,  97 => 30,  96 => 29,  95 => 28,  94 => 27,  89 => 25,  83 => 22,  78 => 20,  74 => 19,  70 => 18,  66 => 17,  63 => 16,  59 => 15,  43 => 1,);
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
                    <button type=\"button\" class=\"btn btn-primary\"><a href=\"/projects/edit/{{ project.slug }}\" class=\"text-white text-decoration-none\">Edycja</a></button>
                </td>
                <td>
                    <button type=\"button\" class=\"btn btn-danger\" onclick=\"return confirm('Czy jesteś pewien że chcesz usunąć projekt?')\"><a href=\"/projects/delete/{{ project.slug }}\" class=\"text-white text-decoration-none\">Usuń</a></button>
                </td>
                {% if
                    project.critery|length and project.critery[0].VariantValue|length
                    and project.critery[0].alfaQ and project.critery[0].betaQ
                    and project.critery[0].alfaP and project.critery[0].betaP
                    and project.critery[0].alfaV and project.critery[0].betaV
                    and project.variant|length and project.klas|length
                    and project.profil|length and project.profil[0].profilValue|length %}
                <td>
                    <button type=\"button\" class=\"btn btn-warning\"><a href=\"/projects/raport/{{ project.slug }}\" class=\"text-white text-decoration-none\">Raport</a></button>
                </td>
                {% endif %}
            </tr>

        {% endfor %}

        </tbody>
    </table>
</div>
", "projects/projects_list.html.twig", "D:\\Studia\\Praca magisterska\\Projekt_Wernyhora\\Wernyhora\\templates\\projects\\projects_list.html.twig");
    }
}
