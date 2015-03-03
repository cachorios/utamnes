<?php

namespace Context;

use Behat\Mink\Exception\UnsupportedDriverActionException;

/**
 * 
 * @author Athlan
 *
 */
class WebContext extends DefaultContext
{
    /**
     * @When /^I go to the website root$/
     */
    public function iGoToTheWebsiteRoot()
    {
        $this->getSession()->visit('/');
    }
    
    /**
     * @Given /^I am on the "([^"]+)"  page?$/
     * @When /^(?:|I )go to the "([^"]+)"  page?$/
     * @Given /^(?:|que )estoy en la ruta "([^"]+)"$/
     */
    public function iAmOnThePage($page)
    {
        $this->getSession()->visit($this->generateUrl($page));
    }
    
    /**
     * Checks, that current page PATH matches regular expression.
     *
     * @Then /^(?:|I )should be redirected to (?P<pattern>"(?:[^"]|\\")*")$/
     */
    public function iAmRedirectedToUrl($pattern)
    {
        $this->assertSession()->addressMatches($this->fixStepArgument($pattern));
    }
    
    /**
     * @Then /^(?:|I )should be on the "([^"]+)" (page)$/
     * @Then /^(?:|I )should be redirected to the "([^"]+)" (page)$/
     * @Then /^(?:|I )should still be on the "([^"]+)" (page)$/
     * @Then /^(?:|Yo )deberia estar en la ruta "([^"]+)"$/
     */
    public function iShouldBeOnThePage($page)
    {
//        ld($this->generateUrl($page));
        $this->assertSession()->addressEquals($this->generateUrl($page));
        try {
            $this->assertSession()->statusCodeEquals(200);
        } catch (UnsupportedDriverActionException $e) {
        }
    }

    /**
     * @When /^(?:|I )click into "([^"]+)" link?$/
     * @When /^(?:|I )click "([^"]+)" link?$/
     * @When /^(?:|yo )presiono en el link "([^"]+)"$/
     */
    public function iClickLink($link)
    {
        $this->clickLink($link);
    }

    /**
     * @When /^Print page content$/
     */
    public function printPageContent()
    {
        echo $this->getSession()->getPage()->getContent();
    }
    
    /**
     * @Then /^(?:|I )should see "([^"]+)" (heading|headline)$/
     * @Then /^Ver "([^"]+)" como tiulo$/
     */
    public function iShouldSeeHeading($heading)
    {
        $this->assertSession()->elementTextContains('xpath', '//h1 | //h2 | //h3', $this->fixStepArgument($heading));
    }

    /**
     * @Then /^(?:|I )should see (?P<type>[(error|success|info|warning)]+) message "(?P<message>[^"]+)"$/
     * @Then /^(?:|yo )debo ver el mensaje de (?P<type>[(error|success|info|warning)]+) "(?P<message>[^"]+)"$/
     */
    public function deberiaVerElMensaje($type, $message)
    {
        $classesMap = [
            'success' => 'success',
            'error' => 'danger',
            'info' => 'info',
            'warning' => 'warning',
        ];
        $class = $classesMap[$type];
        
        $this->assertSession()->elementTextContains('xpath', '//div[@class="alert alert-' . $class . '"]',
            $this->fixStepArgument($message));
    }

    /**
     * @Given /^(?:|que )estoy autentificado como "([^"]+)"$/
     */
    public function estoyAutenticadoComo($username) {
        if (!isset($this->usuario[$username])) {
            throw new \OutOfBoundsException('Invalid user ' . $username);
        }

        $this->visitPath('/login');
        $this->fillField('login-username', $username);
        $this->fillField('login-password', $this->usuario[$username]);
//        $this->checkField('remember_me');
        $this->pressButton('Ingresar');
    }

    /**
     * @Given /^(?:|que )estoy en "([^"]+)"$/
     */
    public function estoyEn($name)
    {
        $this->visitPath($name);

    }

    /**
     * @Given relleno campo :arg1 con :arg2
     */
    public function rellenoCampo($field, $value)
    {
        $this->fillField($field, $value);
    }

    /**
     * @Given presiono el boton :arg1
     */
    public function clickButton($nombre)
    {
        $this->pressButton($nombre);

    }


}
