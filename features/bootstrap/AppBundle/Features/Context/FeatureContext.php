<?php

namespace AppBundle\Features\Context;

require_once 'PHPUnit/Autoload.php';
require_once 'PHPUnit/Framework/Assert/Functions.php';
use AppBundle\Model\Sumador;

use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Behat\Exception\PendingException;

//use Behat\Gherkin\Node\PyStringNode;
//use Behat\Gherkin\Node\TableNode;

/**
 * Defines application features from the specific context.
 */
class FeatureContext  implements Context, SnippetAcceptingContext
{
    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    /**
     * @var \AppBundle\Model\Sumador
     */
    private $sumador;
    public function __construct()
    {

    }

    /**
     * @Given que tengo el objeto sumador
     */
    public function inicio()
    {
        $this->sumador = new Sumador();

    }

    /**
     * @When /^ingreso los numero ([-]?\d+) y ([-]?\d+)$/
     */
    public function IngresarNumero($n1, $n2)
    {
        $this->sumador->setX($n1);
        $this->sumador->setY($n2);
    }

    /**
     * @Then /^el resultado debe ser ([-]?\d+)$/
     */
    public function sumar($resultado)
    {
        $res = $this->sumador->sumar();

  //      if($res <> $resultado )
//           throw new \Exception("El Valor de la suma no coinciden". $resultado . " - " .$res);
            assertEquals($res,$resultado);

    }

}
