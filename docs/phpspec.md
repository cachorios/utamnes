# PHPSpec #

1. Se describe la clase
2. Creación del ejemplos
3. Ejecución de ejemplos
4. Implementación de código
5. Más ejemplo, refactorización...


Los Matchers son como los assert de phpunits

	 			-> should
	$result							be....()
				-> shouldNot

 
$this hace referencia a la clase que estas probando.

## Identity Matcher ##

	$this->getRating()->shouldBe(5);
	$this->getTitle()->shouldBeEqualTo("Star Wars");
	$this->getReleaseDate()->shouldReturn(233366400);
	$this->getDescription()->shouldEqual("Inexplicably popular children's film");

## Comparison Matcher ##

	$this->getRating()->shouldBeLike('5');

## Throw Matcher ##

	$this->shouldThrow('\InvalidArgumentException')->duringSetRating(-3);

## Type Matcher ##

	$this->shouldHaveType('Movie');
    $this->shouldReturnAnInstanceOf('Movie');
    $this->shouldBeAnInstanceOf('Movie');
    $this->shouldImplement('Movie');

## ObjectState Matcher ##
	
	$this->shouldBeAvailableOnCinemas();
	
	$this->shouldHaveSoundtrack();

## Count Matcher ##	

	$this->getDirectors()->shouldHaveCount(1);

## Scalar Matcher ##

	$this->getTitle()->shouldBeString();

	$this->getCast()->shouldBeArray();

## ArrayContain Matcher ##
	
	$this->getCast()->shouldContain('Jane Smith');

## ArrayKey Matcher ##

 	$this->getReleaseDates()->shouldHaveKey('France');	

## StringStart Matcher ##

	$this->getTitle()->shouldStartWith('The Wizard');

## StringEnd Matcher ##

	$this->getTitle()->shouldEndWith('of Oz');

## StringRegex Matcher ##
	
	$this->getTitle()->shouldMatch('/wizard/i');

## Inline Matcher ##

	 function it_should_have_some_specific_options_by_default()
    {
        $this->getOptions()->shouldHaveKey('username');
        $this->getOptions()->shouldHaveValue('diegoholiveira');
    }

    public function getMatchers()
    {
        return [
            'haveKey' => function($subject, $key) {
                return array_key_exists($key, $subject);
            },
            'haveValue' => function($subject, $value) {
                return in_array($value, $subject);
            },
        ];
    }


