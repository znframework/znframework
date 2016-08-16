<?php class ComponentsTest extends Controller
{
    public function calendar()
    {
        echo Calendar::nameType('short', 'short') 
                     ->style(array('current' => 'background:red; color:white;', 'table' => 'background:white; color:red')) 
                     ->linkNames('Önceki', 'Sonraki') 
                     ->create();
    }

    public function captcha()
    {
        echo Captcha::length(6) 
                    ->textColor('180|20|10') 
                    ->grid(true, '30|30|30') 
                    ->gridSpace(2, 6) 
                    ->background('200|200|200') 
                    ->create(true);
    }

    //--------------------------------------------------------------------------------------------------------
    // PROBLEM !!!
    //--------------------------------------------------------------------------------------------------------
    public function datagrid()
    {
        echo DataGrid::table('uyeler')
                     ->processColumn('dataId')
                     ->limit(10)
                     ->columns(array 
                     ( 
                         'id'      => array('title' => 'ID'), 
                         'name'    => array('title' => 'Name'), 
                         'address' => array('title' => 'Address', 'input' => 'textarea') 
                     )) 
                    ->create();
    }

    public function pagination()
    {
        echo Pagination::limit(10)
                       ->totalRows(200)
                       ->start(0)
                       ->style(array('current' => 'color:blue', 'font-size' => '11px'))
                       ->create();
    }

    public function schedule()
    {
        echo Schedule::create(array('ul type="disc"' => array
        (
            1, 
            2, 
            4,
            'ol type="i"' => array('a', 'b')
        ))); 
    }

    public function table()
    {
        echo Table::size(300, 100) 
                  ->cell(0, 0) 
                  ->border(1, 'red') 
                  ->content
                  ( 
                      array(1 => array('colspan' => 2)),
                      array('a', 'b')                                                          
                  )
                  ->create();
    }

    public function terminal()
    {
        echo Terminal::run();
    }
}