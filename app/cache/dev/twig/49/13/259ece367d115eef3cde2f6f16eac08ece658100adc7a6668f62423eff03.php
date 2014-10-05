<?php

/* TlmalpQrcodePhotoAssociateBundle:Default:associate.html.twig */
class __TwigTemplate_4913259ece367d115eef3cde2f6f16eac08ece658100adc7a6668f62423eff03 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "Hello l'action était ";
        echo twig_escape_filter($this->env, (isset($context["action"]) ? $context["action"] : $this->getContext($context, "action")), "html", null, true);
        echo ", le qrcode ";
        echo twig_escape_filter($this->env, (isset($context["qrcode"]) ? $context["qrcode"] : $this->getContext($context, "qrcode")), "html", null, true);
        echo ", et la photo ";
        echo twig_escape_filter($this->env, (isset($context["photo"]) ? $context["photo"] : $this->getContext($context, "photo")), "html", null, true);
        echo "!!
";
    }

    public function getTemplateName()
    {
        return "TlmalpQrcodePhotoAssociateBundle:Default:associate.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  19 => 1,);
    }
}
