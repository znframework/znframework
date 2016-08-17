<?php class Tester extends Controller
{
    public function syntax()
    {
        global $classMap;

        config('ClassMap');

        foreach( $classMap['classes'] as $key => $val )
        {
            if( ! strstr($key, '\\')  )
            {
                $methods = Classes::methods($key);

                foreach( $methods as $method )
                {
                    if( $method !== '__construct' )
                    {
                        writeLine($key.'::'.$method);

                        new $key;
                    }
                }
            }
        }
    }
}