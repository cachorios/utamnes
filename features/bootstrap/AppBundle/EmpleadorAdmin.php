<?php

namespace AppBundle;

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use Context\DefaultContext;
use Context\LarWebContext;

/**
 * Defines application features from the specific context.
 */
class EmpleadorAdmin extends LarWebContext
    //implements Context, SnippetAcceptingContext
{

    /**
     * @Given aun no existe el empleador Amarilla Eugenia
     */
    public function aunNoExisteElEmpleadorAmarillaEugenia()
    {
        $em = $this->getContainer()->get("doctrine.orm.entity_manager");
        $empl = $em->getRepository("AppBundle:Empleador")->findOneByRazon("Amarilla Eugenia");
        if(!$empl == null){
            $em->remove($empl);
            $em->flush();
        }
    }


}
