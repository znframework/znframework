<?php namespace ZN\Services\Exception;

class SMTPEmptyHostNameException extends \InvalidArgumentException
{
    use \ExclusionAbility;
}
