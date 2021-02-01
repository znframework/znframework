<?php namespace ZN\Database;

use DB;

class DeleteTest extends DatabaseExtends
{
    public function testDelete()
    {
        DB::insert('persons', ['name' => 'Ozan']);

        DB::where('name', 'Ozan')->delete('persons');

        $this->assertFalse(DB::isExists('persons', 'name', 'Ozan'));
    }

    public function testDeleteUnconditionalException()
    {
        try
        {
            DB::delete('persons');
        }
        catch( Exception\UnconditionalException $exception )
        {
            $this->assertStringStartsWith('You can not perform unconditional deletion!', $exception->getMessage());
        }
    }
}