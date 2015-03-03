<?php

namespace RBSoft\UsuarioBundle\Behat\Context;


require_once 'PHPUnit/Autoload.php';
require_once 'PHPUnit/Framework/Assert/Functions.php';

use Behat\Behat\Definition\Call\Given;
use Behat\Behat\Definition\Call\When;
use Behat\Behat\Output\Node\EventListener\AST\StepListener;
use Behat\Symfony2Extension\Context\KernelDictionary;

use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Behat\Tester\Exception\PendingException;

use Behat\Mink\Driver\GoutteDriver;
use Behat\Mink\Session;
//use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;

use Context\WebContext;

/**
 * Defines application features from the specific context.
 */
class UsuarioContext extends WebContext
{
    protected $usuario = array();
    protected $links = array();

    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
    }


}
