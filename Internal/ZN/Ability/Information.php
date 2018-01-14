<?php namespace ZN\Ability;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

use ZN\Lang;

trait Information
{
    /**
     * Catch error
     * 
     * @var mixed
     */
    protected $error;

     /**
     * Catch success
     * 
     * @var mixed
     */
    protected $success;

    /**
     * Get error
     * 
     * @param void
     * 
     * @return mixed
     */
    public function error()
    {
        if( ! empty($this->error) )
        {
            if( is_array($this->error) )
            {
                return implode('<br>', $this->error);
            }

            return $this->error;
        }
        else
        {
            return false;
        }
    }

    /**
     * Get success
     * 
     * @param void
     * 
     * @return mixed
     */
    public function success()
    {
        if( empty($this->error) )
        {
            if( ! empty($this->success) )
            {
                if( is_array($this->success) )
                {
                    return implode('<br>', $this->success);
                }

                return $this->success;
            }
            else
            {
                return Lang::select('Success', 'success');
            }
        }
        else
        {
            return false;
        }
    }

    /**
     * Get status
     * 
     * @param void
     * 
     * @return mixed
     */
    public function status()
    {
        if( $success = $this->success() )
        {
            return $success;
        }

        return $this->error();
    }
}
