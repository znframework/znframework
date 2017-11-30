<?php namespace ZN\Services\Exception;

class InvalidArgumentException extends \InvalidArgumentException
{
    use \ExclusionAbility;
}
