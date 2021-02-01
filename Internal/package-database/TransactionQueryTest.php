<?php namespace ZN\Database;

use DB;

class TransactionQueryTest extends DatabaseExtends
{
    public function testError()
    {
        DB::insert('persons', 
        [
            'name'  => 'Jimy',
            'phone' => '1234'
        ]);

        $return = DB::transaction(function()
        {      
            DB::insert('personsx', ['name' => 'John']);
            DB::where('name', 'Jimy')->update('persons', ['phone' => '4321']);
        });

        $person = DB::where('name', 'Jimy')->persons()->row();

        $this->assertFalse($person->phone == '4321');

        DB::where('name', 'Jimy')->delete('persons');
    }

    public function testSuccess()
    {
        DB::insert('persons', 
        [
            'name'  => 'Jimy',
            'phone' => '1234'
        ]);
        
        DB::transaction(function()
        {      
            DB::insert('persons', 
            [
                'name' => 'Hagar'
            ]);

            DB::where('name', 'Jimy')->update('persons', ['phone' => '1000']);
        });

        $person = DB::where('name', 'Jimy')->persons()->row();

        $this->assertEquals('1000', $person->phone);

        DB::where('name', 'Jimy', 'or')->where('name', 'Hagar')->delete('persons');
    }
}