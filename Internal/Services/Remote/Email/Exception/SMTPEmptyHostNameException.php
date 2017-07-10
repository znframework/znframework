<?php namespace ZN\Services\Remote\Email\Exception;

class SMTPEmptyHostNameException extends \InvalidArgumentException
{
    use \ExclusionAbility;
}
