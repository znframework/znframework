<?php namespace ZN\IndividualStructures;

use Support, Exceptions, AbilityController;

class InternalCart extends AbilityController implements CartInterface
{
    //--------------------------------------------------------------------------------------------------------
    //
    // Author     : Ozan UYKUN <ozanbote@gmail.com>
    // Site       : www.znframework.com
    // License    : The MIT License
    // Telif Hakkı: Copyright (c) 2012-2016, znframework.com
    //
    //--------------------------------------------------------------------------------------------------------

    const config = 'IndividualStructures:cart';

    //--------------------------------------------------------------------------------------------------------
    // Items
    //--------------------------------------------------------------------------------------------------------
    //
    // @var array
    //
    //--------------------------------------------------------------------------------------------------------
    protected $items = [];

    //--------------------------------------------------------------------------------------------------------
    // Driver
    //--------------------------------------------------------------------------------------------------------
    //
    // @var array
    //
    //--------------------------------------------------------------------------------------------------------
    protected $driver;

    //--------------------------------------------------------------------------------------------------------
    // Drivers
    //--------------------------------------------------------------------------------------------------------
    //
    // @var array
    //
    //--------------------------------------------------------------------------------------------------------
    protected $drivers =
    [
        'cookie',
        'session'
    ];

    //--------------------------------------------------------------------------------------------------------
    // Construct
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function __construct(String $driver = NULL)
    {
        parent::__construct();

        $defaultDriver = strtolower($this->config['driver']);

        nullCoalesce($driver, $defaultDriver);

        Support::driver($this->drivers, $driver);

        $this->driver = uselib($driver);
    }

    //--------------------------------------------------------------------------------------------------------
    // Insert Item
    //--------------------------------------------------------------------------------------------------------
    //
    // @param array $product
    //
    //--------------------------------------------------------------------------------------------------------
    public function insertItem(Array $product) : Bool
    {
        // Ürünün parametresinin boş olması durumunda rapor edilmesi istenmiştir.
        if( empty($product) )
        {
            return Exceptions::throws('Error', 'emptyParameter', 'product');
        }

        // Ürünün adet parametresinin belirtilmemesi durumunda 1 olarak kabul edilmesi istenmiştir.
        if( ! isset($product['quantity']) )
        {
            $product['quantity'] = 1;
        }

        // Sepettin daha önce oluşturulup oluşturulmadığına göre işlemler gerçekleştiriliyor.
        if( $sessionCart = $this->driver->select(md5('SystemCartData')) )
        {
            $this->items = $sessionCart;
        }

        array_push($this->items, $product);

        $this->driver->insert(md5('SystemCartData'), $this->items);

        $this->items = $this->driver->select(md5('SystemCartData'));

        return true;
    }

    //--------------------------------------------------------------------------------------------------------
    // Select Items
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function selectItems() : Array
    {
        if( $sessionCart = $this->driver->select(md5('SystemCartData')) )
        {
            return $this->items = $sessionCart;
        }
        else
        {
            return [];
        }
    }

    //--------------------------------------------------------------------------------------------------------
    // Select Item
    //--------------------------------------------------------------------------------------------------------
    //
    // @param mixed $code
    //
    //--------------------------------------------------------------------------------------------------------
    public function selectItem($code) : \stdClass
    {
        $this->items = ( $sessionCart = $this->driver->select(md5('SystemCartData')) )
                       ? $sessionCart
                       : '';

        if( empty($this->items) )
        {
            return (object)[];
        }

        foreach( $this->items as $row )
        {
            if( ! is_array($code) )
            {
                $key = array_search($code, $row);
            }
            else
            {
                if( isset($row[key($code)]) && $row[key($code)] == current($code) )
                {
                    $key = $row;
                }
            }

            if( ! empty($key) )
            {
                return (object) $row;
            }
        }
    }

    //--------------------------------------------------------------------------------------------------------
    // Total Items
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function totalItems() : Int
    {
        $totalItems  = 0;

        if( $sessionCart = $this->driver->select(md5('SystemCartData')) )
        {
            $this->items = $sessionCart;

            if( ! empty($this->items) ) foreach( $this->items as $item )
            {
                $totalItems += $item['quantity'];
            }

            return $totalItems;
        }
        else
        {
            return $totalItems;
        }
    }


    //--------------------------------------------------------------------------------------------------------
    // Total Prices
    //--------------------------------------------------------------------------------------------------------
    //
    // @param mixed $code
    //
    //--------------------------------------------------------------------------------------------------------
    public function totalPrices() : Int
    {
        $this->items = ( $sessionSelect = $this->driver->select(md5('SystemCartData')) )
                       ? $sessionSelect
                       : '';

        if( empty($this->items) )
        {
            return 0;
        }

        $total = 0;

        foreach( $this->items as $values )
        {
            $quantity  = isset($values['quantity'])
                       ? $values['quantity']
                       : 1;

            $price = isset($values['price'])
                   ? $values['price']
                   : 0;

            $total += $price * $quantity;
        }

        return $total;
    }

    //--------------------------------------------------------------------------------------------------------
    // Update Item
    //--------------------------------------------------------------------------------------------------------
    //
    // @param mixed $code
    // @param array $data
    //
    //--------------------------------------------------------------------------------------------------------
    public function updateItem($code, Array $data) : Bool
    {
        $this->items = ( $sessionSelect = $this->driver->select(md5('SystemCartData')) )
                       ? $sessionSelect
                       : '';

        if( empty($this->items) )
        {
            return false;
        }

        $i = 0;

        foreach( $this->items as $row )
        {
            if( is_array($code) )
            {
                if(isset($row[key($code)]) && $row[key($code)] == current($code))
                {
                    $code = $row[key($code)];
                }
            }

            $key = array_search($code,$row);

            if( ! empty($key) )
            {
                array_splice($this->items, $i, 1);

                if( count($data) !== count($row) )
                {
                    foreach( $data as $k => $v )
                    {
                        $row[$k] = $v;
                    }

                    array_push($this->items, $row);
                }
                else
                {
                    array_push($this->items, $data);
                }
            }

            $i++;
        }

        return $this->driver->insert(md5('SystemCartData'), $this->items);
    }

    //--------------------------------------------------------------------------------------------------------
    // Delete Item
    //--------------------------------------------------------------------------------------------------------
    //
    // @param mixed $code
    //
    //--------------------------------------------------------------------------------------------------------
    public function deleteItem($code) : Bool
    {
        $this->items = ( $sessionSelect = $this->driver->select(md5('SystemCartData')) )
                       ? $sessionSelect
                       : '';

        if( empty($this->items) )
        {
            return false;
        }

        $i=0;

        foreach( $this->items as $row )
        {
            if( is_array($code) )
            {
                if( isset($row[key($code)]) && $row[key($code)] == current($code) )
                {
                    $code = $row[key($code)];
                }
            }

            $key = array_search($code, $row);

            if( ! empty($key) )
            {
                array_splice($this->items, $i--, 1);
            }

            $i++;
        }

        return $this->driver->insert(md5('SystemCartData'), $this->items);
    }

    //--------------------------------------------------------------------------------------------------------
    // Delete Items
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    //--------------------------------------------------------------------------------------------------------
    public function deleteItems() : Bool
    {
        return $this->driver->delete(md5('SystemCartData'));
    }

    //--------------------------------------------------------------------------------------------------------
    // Money Format
    //--------------------------------------------------------------------------------------------------------
    //
    // @param int    $money
    // @param string $type
    //
    //--------------------------------------------------------------------------------------------------------
    public function moneyFormat(Int $money, String $type = NULL) : String
    {
        $moneyFormat = '';
        $money       = round($money, 2);
        $str_ex      = explode(".",$money);
        $join        = [];
        $str         = strrev($str_ex[0]);

        for( $i = 0; $i < strlen($str); $i++ )
        {
            if( $i%3 === 0 )
            {
                array_unshift($join, '.');
            }

            array_unshift($join, $str[$i]);
        }

        for( $i = 0; $i < count($join); $i++ )
        {
            $moneyFormat .= $join[$i];
        }

        $type = ! empty($type)
                ? ' '.$type
                : '';

        $remaining = ( isset($str_ex[1]) )
                     ? $str_ex[1]
                     : '00';

        if( strlen($remaining) === 1 )
        {
            $remaining .= '0';
        }

        $moneyFormat = substr($moneyFormat,0,-1).','.$remaining.$type;

        return $moneyFormat;
    }

    //--------------------------------------------------------------------------------------------------------
    // Driver
    //--------------------------------------------------------------------------------------------------------
    //
    // @param  string $driver
    // @return object
    //
    //--------------------------------------------------------------------------------------------------------
    public function driver(String $driver) : InternalCart
    {
        return new self($driver);
    }
}
