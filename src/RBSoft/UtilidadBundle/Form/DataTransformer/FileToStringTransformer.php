<?php
/**
 * Created by JetBrains PhpStorm.
 * User: beto
 * Date: 18/03/14
 * Time: 2:32
 * To change this template use File | Settings | File Templates.
 */

namespace RBSoft\UtilidadBundle\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;
use Doctrine\Common\Persistence\ObjectManager;

class FileToStringTransformer implements DataTransformerInterface
{

    /**
     * @param null|FIle $name
     * @return null
     */
    public function transform($name)
    {

        return null;
    }

    /**
     * @param UploadedFile $data
     * @return UploadedFile
     */
    public function reverseTransform($data)
    {
        return $data;
    }
}