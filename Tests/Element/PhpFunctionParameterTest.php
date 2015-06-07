<?php

namespace WsdlToPhp\PhpGenerator\Tests\Element;

use WsdlToPhp\PhpGenerator\Element\PhpFunctionParameter;
use WsdlToPhp\PhpGenerator\Tests\TestCase;
use WsdlToPhp\PhpGenerator\Element\PhpMethod;

class PhpFunctionParameterTest extends TestCase
{
    /**
     * @expectedException InvalidArgumentException
     */
    public function testSetType()
    {
        $functionParameter = new PhpFunctionParameter('foo', true);

        $functionParameter->setType(new PhpMethod('Bar'));
    }

    public function testSetTypeOk()
    {
        $functionParameter = new PhpFunctionParameter('foo', true);

        $this->assertInstanceOf('\\WsdlTophp\\PhpGenerator\\Element\\PhpFunctionParameter', $functionParameter->setType('string'));
    }

    public function testTypeIsValid()
    {
        $this->assertTrue(PhpFunctionParameter::typeIsValid('string'));
    }

    public function testTypeIsValidFalse()
    {
        $this->assertFalse(PhpFunctionParameter::typeIsValid('Partagé'));
    }
}
