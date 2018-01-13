<?php namespace Project\Commands;

use Email;

class Example extends Command
{
    public function send()
    {
        file_put_content('abc.txt', 1);
    }
}