- Instalamos y configuramos el Behat con mink
- creamos el .feature


>
>   
>     #language: es
> 
> 	Característica: Mostrar Contenidos en el home del sitio
> 	Se mostraran contenidos en el home del sitio
> 	Y se mostraran segun un orden establecido.
> 	 	
> 	#Antecedentes:
> 	
> 	Escenario: Crear un tipo de contenido Carrusel
> 	Dado un tipo de contenido "carrusel".
> 	
> 	Y le asignamos datos basicos como un nombre "Carrusel 1",
> 	Y le asignamos a activo 1
> 
> 	..
> 
> 	..
> 
> 	Entonces debo obtener un contenido en la base de datos, de nombre "Carrusel 1".
> 

- Ejecutamos para armar la estructura de FeatureContext
 
>   
>   bin/behat
	
nos genera la estructura:
	/**
     * @Given un tipo de contenido :arg1.
     */
    public function unTipoDeContenido($arg1)
    {
        throw new PendingException();
    }

    /**
     * @Given le asignamos datos basicos como un nombre :arg1,
     */
    public function leAsignamosDatosBasicosComoUnNombre($arg1)
    {
        throw new PendingException();
    }

    /**
     * @Given le asignamos a activo :arg1
     */
    public function leAsignamosAActivo($arg1)
    {
        throw new PendingException();
    }

	..

	..

Lo colocamos en FixrureContext.php (esta es una estructura basica necesaria), 

	<?php
	namespace AppBundle\Features\Context;
	
	require_once 'PHPUnit/Autoload.php';
	require_once 'PHPUnit/Framework/Assert/Functions.php';
	
	
	use Behat\Symfony2Extension\Context\KernelDictionary;
	
	use Behat\Behat\Context\Context;
	use Behat\Behat\Context\SnippetAcceptingContext;
	use Behat\Behat\Tester\Exception\PendingException;
	
	//use Behat\Gherkin\Node\PyStringNode;
	use Behat\Gherkin\Node\TableNode;
	
	/**
	 * Defines application features from the specific context.
	 */
	class FeatureContext  implements Context, SnippetAcceptingContext{
	    use KernelDictionary;
	{

	}

**Ahora empezamos con lo primero, debemos hacer que pase el primer test:**
	
Utilizaremos **Goutte** como navegador

  	use Behat\Mink\Driver\GoutteDriver;
	use Behat\Mink\Session;
	
		..
		..


    /** @BeforeScenario */
    public function before()
    {
        $driver = new GoutteDriver();
        $this->session = new Session($driver);
        $this->session->start();
    }

