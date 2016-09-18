<?php namespace Project\Controllers;

use Encode;

class EncodeExample extends Controller
{
    public function main(String $params = NULL)
    {
        $create = Encode::create(4);

        writeLine('Create: '.$create);

        $golden = Encode::golden('Example Data');

        writeLine('Golden: '.$golden);

        $super  = Encode::super('Example Data');

        writeLine('Super: '.$super);

        $type   = Encode::type('Example Data', 'sha1');

        writeLine('Type: '.$type);
    }
}
