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

/* projects/edit.html.twig */
class __TwigTemplate_a847af68c6dbaf7fc5e7c6a13128fb26 extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->blocks = [
            'title' => [$this, 'block_title'],
            'body' => [$this, 'block_body'],
        ];
    }

    protected function doGetParent(array $context)
    {
        // line 1
        return "base.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "projects/edit.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "projects/edit.html.twig"));

        $this->parent = $this->loadTemplate("base.html.twig", "projects/edit.html.twig", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

    }

    // line 4
    public function block_title($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "title"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "title"));

        echo "Projekt ";
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, (isset($context["project"]) || array_key_exists("project", $context) ? $context["project"] : (function () { throw new RuntimeError('Variable "project" does not exist.', 4, $this->source); })()), "name", [], "any", false, false, false, 4), "html", null, true);
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

    }

    // line 6
    public function block_body($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body"));

        // line 7
        echo "    ";
        $this->loadTemplate("top_menu.html.twig", "projects/edit.html.twig", 7)->display($context);
        // line 8
        echo "    ";
        echo         $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderBlock((isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 8, $this->source); })()), 'form_start');
        echo "
    <div class=\"d-flex justify-content-center mt-5\">
        <div class=\"flex-container col-3 justify-content-center col-1 form-group\">
            <div class=\"pt-3\">
                <div class=\"pb-1\">
                    ";
        // line 13
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(twig_get_attribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 13, $this->source); })()), "name", [], "any", false, false, false, 13), 'label');
        echo "
                </div>
                <div>
                    ";
        // line 16
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(twig_get_attribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 16, $this->source); })()), "name", [], "any", false, false, false, 16), 'widget');
        echo "
                </div>
            </div>
            <div class=\"pt-3 input-group\">
                <div class=\"pb-1 input-group-prepend\">
                    ";
        // line 21
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(twig_get_attribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 21, $this->source); })()), "description", [], "any", false, false, false, 21), 'label', ["label_attr" => ["class" => "input-group-text"]]);
        // line 23
        echo "
                </div>
                <div>
                    ";
        // line 26
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(twig_get_attribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 26, $this->source); })()), "description", [], "any", false, false, false, 26), 'widget', ["attr" => ["class" => "form-control"], "aria-label" => "Opis:"]);
        // line 28
        echo "
                </div>
            </div>
            <div class=\"pt-3\">
            </div>
        </div>
    </div>

    <div class=\"row\">
        <div class=\"col-1\"></div>
        <div class=\"col-2\">
            <div class=\"row js-criteries-wrapper\"
                 data-prototype=\"<div class='js-critery-item d-flex flex-row'>";
        // line 40
        echo twig_escape_filter($this->env, $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 40, $this->source); })()), "criteriesCollection", [], "any", false, false, false, 40), "criteries", [], "any", false, false, false, 40), "vars", [], "any", false, false, false, 40), "prototype", [], "any", false, false, false, 40), 'widget'), "html_attr");
        echo "</div>\"
                 data-index=\"";
        // line 41
        echo twig_escape_filter($this->env, twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 41, $this->source); })()), "criteriesCollection", [], "any", false, false, false, 41), "criteries", [], "any", false, false, false, 41)), "html", null, true);
        echo "\"
            >
                ";
        // line 43
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 43, $this->source); })()), "criteriesCollection", [], "any", false, false, false, 43), "criteries", [], "any", false, false, false, 43));
        foreach ($context['_seq'] as $context["_key"] => $context["criteriesForm"]) {
            // line 44
            echo "                    <div class=\"js-critery-item d-flex flex-row\">
                        ";
            // line 45
            echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(twig_get_attribute($this->env, $this->source, $context["criteriesForm"], "name", [], "any", false, false, false, 45), 'row');
            echo "
";
            // line 48
            echo "                        ";
            echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(twig_get_attribute($this->env, $this->source, $context["criteriesForm"], "removeCritery", [], "any", false, false, false, 48), 'row');
            echo "
                    </div>
                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['criteriesForm'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 51
        echo "
                ";
        // line 52
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 52, $this->source); })()), "criteriesCollection", [], "any", false, false, false, 52), "addCritery", [], "any", false, false, false, 52), 'row');
        echo "
            </div>
        </div>
        <div class=\"col\">
            <div class=\"row js-variants-wrapper row flex-nowrap\"
                 data-prototype=\"<div class='js-variant-item col'>";
        // line 57
        echo twig_escape_filter($this->env, $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 57, $this->source); })()), "variantsCollection", [], "any", false, false, false, 57), "variants", [], "any", false, false, false, 57), "vars", [], "any", false, false, false, 57), "prototype", [], "any", false, false, false, 57), 'widget'), "html_attr");
        echo "</div>\"
                 data-index=\"";
        // line 58
        echo twig_escape_filter($this->env, twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 58, $this->source); })()), "variantsCollection", [], "any", false, false, false, 58), "variants", [], "any", false, false, false, 58)), "html", null, true);
        echo "\"
            >
                <div class=\"row\">
                    ";
        // line 61
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 61, $this->source); })()), "variantsCollection", [], "any", false, false, false, 61), "variants", [], "any", false, false, false, 61));
        foreach ($context['_seq'] as $context["_key"] => $context["variantsForm"]) {
            // line 62
            echo "                        <div class=\"js-variant-item col\">
                            ";
            // line 63
            echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(twig_get_attribute($this->env, $this->source, $context["variantsForm"], "name", [], "any", false, false, false, 63), 'row');
            echo "
                            ";
            // line 64
            echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(twig_get_attribute($this->env, $this->source, $context["variantsForm"], "removeVariant", [], "any", false, false, false, 64), 'row');
            echo "
                        </div>
                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['variantsForm'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 67
        echo "                    ";
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 67, $this->source); })()), "variantsCollection", [], "any", false, false, false, 67), "addVariant", [], "any", false, false, false, 67), 'row');
        echo "
                </div>

            </div>

            <div class=\"js-variants-values-wrapper\"
                 data-prototype=\"<div class='js-variant-value-item col'>";
        // line 73
        echo twig_escape_filter($this->env, $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 73, $this->source); })()), "variantsValuesCollection", [], "any", false, false, false, 73), "variantsValues", [], "any", false, false, false, 73), "vars", [], "any", false, false, false, 73), "prototype", [], "any", false, false, false, 73), 'widget'), "html_attr");
        echo "</div>\"
                 data-index=\"";
        // line 74
        echo twig_escape_filter($this->env, twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 74, $this->source); })()), "variantsValuesCollection", [], "any", false, false, false, 74), "variantsValues", [], "any", false, false, false, 74)), "html", null, true);
        echo "\"
            >
                ";
        // line 77
        echo "
                ";
        // line 78
        if ((twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 78, $this->source); })()), "variantsValuesCollection", [], "any", false, false, false, 78), "variantsValues", [], "any", false, false, false, 78)) > 1)) {
            // line 79
            echo "
                    ";
            // line 80
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 80, $this->source); })()), "criteriesCollection", [], "any", false, false, false, 80), "criteries", [], "any", false, false, false, 80));
            $context['loop'] = [
              'parent' => $context['_parent'],
              'index0' => 0,
              'index'  => 1,
              'first'  => true,
            ];
            if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof \Countable)) {
                $length = count($context['_seq']);
                $context['loop']['revindex0'] = $length - 1;
                $context['loop']['revindex'] = $length;
                $context['loop']['length'] = $length;
                $context['loop']['last'] = 1 === $length;
            }
            foreach ($context['_seq'] as $context["_key"] => $context["critery"]) {
                // line 81
                echo "                        <div class=\"row tr-";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["loop"], "index", [], "any", false, false, false, 81), "html", null, true);
                echo "\">

                            ";
                // line 83
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 83, $this->source); })()), "variantsCollection", [], "any", false, false, false, 83), "variants", [], "any", false, false, false, 83));
                foreach ($context['_seq'] as $context["_key"] => $context["variant"]) {
                    // line 84
                    echo "                                ";
                    $context['_parent'] = $context;
                    $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 84, $this->source); })()), "variantsValuesCollection", [], "any", false, false, false, 84), "variantsValues", [], "any", false, false, false, 84));
                    foreach ($context['_seq'] as $context["_key"] => $context["variantsValues"]) {
                        // line 85
                        echo "
                                    ";
                        // line 86
                        if (((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["variantsValues"], "vars", [], "any", false, false, false, 86), "data", [], "any", false, false, false, 86), "critery", [], "any", false, false, false, 86) === twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["critery"], "vars", [], "any", false, false, false, 86), "data", [], "any", false, false, false, 86)) && (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["variantsValues"], "vars", [], "any", false, false, false, 86), "data", [], "any", false, false, false, 86), "variant", [], "any", false, false, false, 86) === twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["variant"], "vars", [], "any", false, false, false, 86), "data", [], "any", false, false, false, 86)))) {
                            // line 87
                            echo "                                        <div class=\"js-variant-value-item col\">
                                            ";
                            // line 88
                            echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock($context["variantsValues"], 'widget');
                            echo "
                                        </div>
                                    ";
                        }
                        // line 91
                        echo "                                ";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['variantsValues'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 92
                    echo "                            ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['variant'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 93
                echo "                        </div>
                    ";
                ++$context['loop']['index0'];
                ++$context['loop']['index'];
                $context['loop']['first'] = false;
                if (isset($context['loop']['length'])) {
                    --$context['loop']['revindex0'];
                    --$context['loop']['revindex'];
                    $context['loop']['last'] = 0 === $context['loop']['revindex0'];
                }
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['critery'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 95
            echo "
                ";
        } else {
            // line 97
            echo "
                    <div class=\"row tr-";
            // line 98
            echo twig_escape_filter($this->env, twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 98, $this->source); })()), "variantsValuesCollection", [], "any", false, false, false, 98), "variantsValues", [], "any", false, false, false, 98)), "html", null, true);
            echo "\" data-index=\"";
            echo twig_escape_filter($this->env, twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 98, $this->source); })()), "variantsValuesCollection", [], "any", false, false, false, 98), "variantsValues", [], "any", false, false, false, 98)), "html", null, true);
            echo "\">
                        ";
            // line 99
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 99, $this->source); })()), "variantsValuesCollection", [], "any", false, false, false, 99), "variantsValues", [], "any", false, false, false, 99));
            foreach ($context['_seq'] as $context["_key"] => $context["variantsValues"]) {
                // line 100
                echo "                            <div class=\"js-variant-value-item col\">
                                ";
                // line 101
                echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(twig_get_attribute($this->env, $this->source, $context["variantsValues"], "value", [], "any", false, false, false, 101), 'widget');
                echo "
                            </div>
                        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['variantsValues'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 104
            echo "                    </div>

                ";
        }
        // line 107
        echo "                ";
        // line 108
        echo "            </div>
        </div>


    </div>




    ";
        // line 117
        echo $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->searchAndRenderBlock(twig_get_attribute($this->env, $this->source, (isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 117, $this->source); })()), "addProject", [], "any", false, false, false, 117), 'widget');
        echo "
    ";
        // line 118
        echo         $this->env->getRuntime('Symfony\Component\Form\FormRenderer')->renderBlock((isset($context["form"]) || array_key_exists("form", $context) ? $context["form"] : (function () { throw new RuntimeError('Variable "form" does not exist.', 118, $this->source); })()), 'form_end');
        echo "



";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

    }

    public function getTemplateName()
    {
        return "projects/edit.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  360 => 118,  356 => 117,  345 => 108,  343 => 107,  338 => 104,  329 => 101,  326 => 100,  322 => 99,  316 => 98,  313 => 97,  309 => 95,  294 => 93,  288 => 92,  282 => 91,  276 => 88,  273 => 87,  271 => 86,  268 => 85,  263 => 84,  259 => 83,  253 => 81,  236 => 80,  233 => 79,  231 => 78,  228 => 77,  223 => 74,  219 => 73,  209 => 67,  200 => 64,  196 => 63,  193 => 62,  189 => 61,  183 => 58,  179 => 57,  171 => 52,  168 => 51,  158 => 48,  154 => 45,  151 => 44,  147 => 43,  142 => 41,  138 => 40,  124 => 28,  122 => 26,  117 => 23,  115 => 21,  107 => 16,  101 => 13,  92 => 8,  89 => 7,  79 => 6,  59 => 4,  36 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("{% extends 'base.html.twig' %}


{% block title %}Projekt {{ project.name }}{% endblock %}

{% block body %}
    {% include 'top_menu.html.twig' %}
    {{ form_start(form) }}
    <div class=\"d-flex justify-content-center mt-5\">
        <div class=\"flex-container col-3 justify-content-center col-1 form-group\">
            <div class=\"pt-3\">
                <div class=\"pb-1\">
                    {{ form_label(form.name) }}
                </div>
                <div>
                    {{ form_widget(form.name) }}
                </div>
            </div>
            <div class=\"pt-3 input-group\">
                <div class=\"pb-1 input-group-prepend\">
                    {{ form_label(form.description, null,
                        {'label_attr': {'class': 'input-group-text'}}
                    ) }}
                </div>
                <div>
                    {{ form_widget(form.description,
                        {'attr': {'class': 'form-control'}, 'aria-label': 'Opis:'}
                    ) }}
                </div>
            </div>
            <div class=\"pt-3\">
            </div>
        </div>
    </div>

    <div class=\"row\">
        <div class=\"col-1\"></div>
        <div class=\"col-2\">
            <div class=\"row js-criteries-wrapper\"
                 data-prototype=\"<div class='js-critery-item d-flex flex-row'>{{ form_widget(form.criteriesCollection.criteries.vars.prototype)|e('html_attr') }}</div>\"
                 data-index=\"{{ form.criteriesCollection.criteries|length }}\"
            >
                {% for criteriesForm in form.criteriesCollection.criteries %}
                    <div class=\"js-critery-item d-flex flex-row\">
                        {{ form_row(criteriesForm.name) }}
{#                        {{ form_row(criteriesForm.unit) }}#}
{#                        {{ form_row(criteriesForm.weight) }}#}
                        {{ form_row(criteriesForm.removeCritery) }}
                    </div>
                {% endfor %}

                {{ form_row(form.criteriesCollection.addCritery) }}
            </div>
        </div>
        <div class=\"col\">
            <div class=\"row js-variants-wrapper row flex-nowrap\"
                 data-prototype=\"<div class='js-variant-item col'>{{ form_widget(form.variantsCollection.variants.vars.prototype)|e('html_attr') }}</div>\"
                 data-index=\"{{ form.variantsCollection.variants|length }}\"
            >
                <div class=\"row\">
                    {% for variantsForm in form.variantsCollection.variants %}
                        <div class=\"js-variant-item col\">
                            {{ form_row(variantsForm.name) }}
                            {{ form_row(variantsForm.removeVariant) }}
                        </div>
                    {% endfor %}
                    {{ form_row(form.variantsCollection.addVariant) }}
                </div>

            </div>

            <div class=\"js-variants-values-wrapper\"
                 data-prototype=\"<div class='js-variant-value-item col'>{{ form_widget(form.variantsValuesCollection.variantsValues.vars.prototype)|e('html_attr') }}</div>\"
                 data-index=\"{{ form.variantsValuesCollection.variantsValues|length }}\"
            >
                {#        <table>#}

                {% if form.variantsValuesCollection.variantsValues|length > 1 %}

                    {% for critery in form.criteriesCollection.criteries %}
                        <div class=\"row tr-{{ loop.index }}\">

                            {% for variant in form.variantsCollection.variants %}
                                {% for variantsValues in form.variantsValuesCollection.variantsValues %}

                                    {% if variantsValues.vars.data.critery is same as(critery.vars.data) and variantsValues.vars.data.variant is same as(variant.vars.data)  %}
                                        <div class=\"js-variant-value-item col\">
                                            {{ form_widget(variantsValues) }}
                                        </div>
                                    {% endif %}
                                {% endfor %}
                            {% endfor %}
                        </div>
                    {% endfor %}

                {% else %}

                    <div class=\"row tr-{{ form.variantsValuesCollection.variantsValues|length }}\" data-index=\"{{ form.variantsValuesCollection.variantsValues|length }}\">
                        {% for variantsValues in form.variantsValuesCollection.variantsValues %}
                            <div class=\"js-variant-value-item col\">
                                {{ form_widget(variantsValues.value) }}
                            </div>
                        {% endfor %}
                    </div>

                {% endif %}
                {#        </table>#}
            </div>
        </div>


    </div>




    {{ form_widget(form.addProject) }}
    {{ form_end(form) }}



{% endblock %}", "projects/edit.html.twig", "D:\\Studia\\Praca magisterska\\Projekt_Wernyhora\\Wernyhora\\templates\\projects\\edit.html.twig");
    }
}
