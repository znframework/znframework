<?php namespace ZN\IndividualStructures\User;

interface SendEmailInterface
{
    //--------------------------------------------------------------------------------------------------------
    // Attachment ->5.0.0
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $file
    // @param string $disposition
    // @param string $newName
    // @param mixed  $mime
    //
    //--------------------------------------------------------------------------------------------------------
    public function attachment(String $file, String $disposition = NULL, String $newName = NULL, $mime = NULL);

    //--------------------------------------------------------------------------------------------------------
    // Send Email All -> 5.0.0
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $subject
    // @param string $body
    //
    //--------------------------------------------------------------------------------------------------------
    public function send(String $subject, String $body);
}
