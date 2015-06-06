<?php

namespace WsdlToPhp\PhpGenerator\Element;

class PhpFunctionParameter extends PhpVariable
{
    /**
     * @var string|PhpClass
     */
    protected $type;
    /**
     * @param string $name
     * @param mixed $value
     * @param string $type
     */
    public function __construct($name, $value, $type = null)
    {
        parent::__construct($name, $value);
    }
    /**
     * @throws \InvalidArgumentException
     * @param string|PhpClass $type
     * @return PhpFunctionParameter
     */
    public function setType($type)
    {
        if (!self::typeIsValid($type)) {
            throw new \InvalidArgumentException(sprintf('Type "%s" is not valid', gettype($type)));
        }
        $this->type = $type;
        return $this;
    }
    /**
     * @param string|PhpClass $type
     * @return bool
     */
    public static function typeIsValid($type)
    {
        return $type === null || (is_string($type) && !empty($type)) || $type instanceof PhpClass;
    }
    /**
     * @return string|PhpClass
     */
    public function getType()
    {
        return $this->type;
    }
    /**
     * @return string
     */
    protected function getPhpType()
    {
        $type = $this->getType();
        return empty($type) ? '' : sprintf('%s ', $type instanceof PhpClass ? $type->getPhpName() : $type);
    }
    /**
     * @see \WsdlToPhp\PhpGenerator\Element\AbstractAssignedValueElement::getPhpDeclaration()
     * @return string
     */
    public function getPhpDeclaration()
    {
        return sprintf('%s%s', $this->getPhpType(), parent::getPhpDeclaration());
    }
    /**
     * returns the way the value is assigned to the element
     * @returns string
     */
    public function getAssignmentSign()
    {
        return $this->hasValue() ? ' = ' : '';
    }
    /**
     * indicates if the element finishes with a semicolon or not
     * @return bool
     */
    public function endsWithSemicolon()
    {
        return false;
    }
}
