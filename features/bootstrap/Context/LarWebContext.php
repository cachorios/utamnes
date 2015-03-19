<?php
/**
 * Created by PhpStorm.
 * User: cachorios
 * Date: 18/03/2015
 * Time: 10:40
 */

namespace Context;
use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Behat\Tester\Exception\PendingException;

abstract class LarWebContext extends DefaultContext implements Context, SnippetAcceptingContext{


    /**
     * @When /^estoy en el inicio del sitio$/
     */

    public function voyAlHome()
    {
        $this->getSession()->visit('/');
    }

    /**
     * @Given /^(?:|que )estoy en la pagina "([^"]+)"$/
     * @when /^(?:|yo )estoy en la pagina "([^"]+)"$/
     * @when /^voy a la pagina "([^"]+)"$/
     */
    public function yoEstoyEnLaPagina($pagina)
    {
        $this->getSession()->visit($this->locatePath($pagina));
    }

    /**
     * @Given /^(?:|que )estoy en la ruta "([^"]+)"$/
     * @when /^(?:|yo )estoy en la ruta"([^"]+)"$/
     */
    public function yoVoyARuta($ruta)
    {
        $this->getSession()->visit($ruta);
    }
    /**
     * @Given /^(?:|que )estoy autenticado como "([^"]+)" clave "([^"]+)"$/
     */
    public function estoyAutenticadoComo($username, $password) {

        $this->visitPath('/login');
        $this->fillField('login-username', $username);
        $this->fillField('login-password', $password);
        $this->pressButton('Ingresar');
    }

    /**
     * @Then /^(?:|yo )deberia estar en la pagina "([^"]+)"$/
     * @Then /^(?:|yo )todabia deberia estar en la pagina "([^"]+)"$/
     */
    public function yoDeberiaEstarEn($pagina)
    {

        $this->assertSession()->addressEquals($this->locatePath($pagina));
        try {
            $this->assertSession()->statusCodeEquals(200);
        } catch (UnsupportedDriverActionException $e) {
        }

    }

    /**
     * @Then /^(?:|yo )debo ver "([^"]+)" (como titulo|de titulo|como subtitulo)$/
     */
    public function YoDeberiaVerEnLaCabecera($texto)
    {
        $container = $this->getSession()->getPage();
        $nodes = $container->findAll('xpath', '//h1|//h2|//h3');
        $regex   = '/'.preg_quote($texto, '/').'/ui';
        $found = false;
        $element = null;
        foreach($nodes as $node ){
            $element = $node;
            if(!$found){
                $found = preg_match($regex, $node->getText());
            }
        }
        $message = sprintf('El Titulo/Subtitulo "%s" no existe.',$texto );
        if(!$found)
            throw new ElementTextException($message, $this->getSession(), $node);

    }

    /**
     * @When /^(?:|yo )doy cliek en el link "([^"]+)"$/
     * @When /^(?:|yo )presiono en el link "([^"]+)"$/
     */
    public function presionoEnLink($link)
    {
        $this->clickLink($link);
    }

    /**
     * @Given /^relleno el campo "([^"]+)" con "([^"]+)"$/
     * @Given /^completo el campo "([^"]+)" con "([^"]+)"$/
     */
    public function rellenarCampo($filedname, $valor)
    {
        $this->fillField($filedname, $valor);
    }

    /**
    * @Given /^presiono en el boton "([^"]+)"$/
    */
    public function presionarEnBoton($boton){
        $this->pressButton($boton);
    }

    /**
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



    public function printPage(){
        print_r($this->getSession()->getPage()->getHtml());
    }

}