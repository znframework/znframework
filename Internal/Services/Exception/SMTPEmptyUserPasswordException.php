<?php namespace ZN\Services\Exception;

class SMTPEmptyUserPasswordException extends \InvalidArgumentException
{
    use \ExclusionAbility;
}
