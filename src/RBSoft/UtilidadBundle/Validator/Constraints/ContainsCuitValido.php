<?php
/**
 * Created by PhpStorm.
 * User: beto
 * Date: 03/02/2015
 * Time: 14:25
 */

namespace RBSoft\UtilidadBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
/**
 * @Annotation
 */
class ContainsCuitValido extends Constraint
{
    public $message = 'No Valido, debe disponer mas de "%string%" items';
}
