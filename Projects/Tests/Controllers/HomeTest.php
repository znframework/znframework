<?php class HomeTest extends Controller
{
    public function main()
    {
        writeLine('Welcome Test'.Html::br());

        $urls = 
        [
            'Components',
            'CryptoGraphy',
            'DatabaseTest'
        ];
       
        foreach( $urls as $key => $val )
        {
            writeLine(($key + 1).' - '.$val);
        }
    }
}