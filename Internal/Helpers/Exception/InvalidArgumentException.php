<?php namespace ZN\Helpers\Exception;

class InvalidArgumentException extends \InvalidArgumentException
{
    use \ExclusionAbility;
}
