<?php

namespace spec\AppBundle\Model;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class EmpleadorModelSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('AppBundle\Model\EmpleadorModel');
    }
}
