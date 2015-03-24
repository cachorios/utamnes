<?php

namespace spec\AppBundle\Model;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class TrabajadorModelSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('AppBundle\Model\TrabajadorModel');
    }
}
