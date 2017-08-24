<?php namespace ZN\Services\Remote\Email\Exception;

class SMTPEmptyUserPasswordException extends \InvalidArgumentException
{
    use \ExclusionAbility;
}
