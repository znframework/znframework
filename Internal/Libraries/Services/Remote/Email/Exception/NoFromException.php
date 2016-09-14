<?php namespace ZN\Services\Remote\Email\Exception;

class NoFromException extends \InvalidArgumentException
{
    use \ExclusionAbility;
}
