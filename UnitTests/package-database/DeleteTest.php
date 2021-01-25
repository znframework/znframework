<?php namespace ZN\Database;

use DB;

class DeleteTest extends Test\Constructor
{
    public function testDelete()
    {
        DB::where('name', 'Ozan')->delete('persons');

        $person = DB::where('name', 'Ozan')->persons()->row();

        $this->assertEmpty($person);
    }

    public function testDeleteUnconditionalException()
    {
        try
        {
            DB::delete('persons');
        }
        catch( Exception\UnconditionalException $exception )
        {
            $this->assertStringStartsWith
            (
                'You can not perform unconditional deletion!',
                $exception->getMessage()    
            );
        }
    }
}