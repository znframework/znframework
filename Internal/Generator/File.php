<?php namespace ZN\Generator;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

use ZN\Base;
use ZN\Datatype;
use ZN\ErrorHandling\Errors;

class File
{
    /**
     * Keeps Settings
     * 
     * @var array
     */
    protected $settings = [];

    /**
     * Settings
     * 
     * @param array $settings
     * 
     * @return Generate
     */
    public function settings(Array $settings) : Generate
    {
        $this->settings = $settings;

        return $this;
    }

    /**
     * Delete Structure
     * 
     * @param string $name
     * @param string $type = 'controller'
     * @param string $app  = NULL
     * 
     * @return bool
     */
    public function delete(String $name, String $type = 'controller', String $app = NULL) : Bool
    {
        if( ! empty($app) )
        {
            $this->settings['application'] = $app;
        }

        $file = $this->path($name, $type);

        if( is_file($file) )
        {
            return unlink($file);
        }

        return false;
    }

    /**
     * Generate Object
     * 
     * @param string $type
     * @param string $name
     * @param array  $settings
     * 
     * @return bool
     */
    public function object(String $type, String $name, Array $settings) : Bool
    {
        if( ! empty($settings) )
        {
            $this->settings = $settings;
        }

        if( empty($name) )
        {
            $this->error = Errors::message('Error', 'emptyParameter', '1.(name)');
        }
        
        # Start Generate
        $controller = "<?php".EOL;

        # Object Data
        $this->settings['object'] = $this->settings['object'] ?? 'class';

        # Namespace Data
        $this->namespace($controller, $namespace);

        # Uses Data
        $this->uses($controller);

        # Class Name
        if( ! empty($this->settings['name']) )
        {
            $name = $this->settings['name'];
        }

        $controller .= $this->settings['object']." ".$name;

        # Extends Data
        $this->extends($controller);

        # Implements Data
        $this->implements($controller);

        # Start Body
        $controller .= EOL . "{" . EOL;

        # Traits Data
        $this->traits($controller);

        # Constants Data
        $this->constants($controller);

        # Vars Data
        $this->vars($controller);

        # Functions Data
        $this->functions($controller);

        # Finish Class
        $controller = rtrim($controller, EOL) . EOL . "}";

        # Alias Data
        $this->alias($controller, $namespace);
        
        # File Write
        return $this->write($name, $type, $controller);
    }

    /**
     * Protected Path
     */
    protected function path($name, $type)
    {
        if( empty($this->settings['application']) )
        {
            $this->settings['application'] = Datatype::divide(rtrim(PROJECT_DIR, '/'), '/', -1);
        }

        return PROJECTS_DIR.$this->settings['application'].$this->type($type).Base::suffix($name, '.php');
    }

    /**
     * Protected Write
     * 
     * @param string $name
     * @param string $type
     * @param string $controller
     * 
     * @return bool
     */
    protected function write($name, $type, $controller) : Bool
    {
        if( ! empty($this->settings['path']) )
        {
            $filePath = Base::suffix($this->settings['path'], '/') . $name;
        }
        else
        {
            $filePath = $name;
        }

        $file = $this->path($filePath, $type);;

        if( ! is_file($file) )
        {
            if( file_put_contents($file, $controller) )
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        else
        {
            return false;
        }
    }

    /**
     * Protected Functions
     * 
     * @param string & $controller
     * @param string   $namespace = NULL
     */
    protected function alias(String & $controller, String $namespace = NULL)
    {
        if( ! empty($this->settings['alias']) )
        {
            $controller .= EOL.EOL.'class_alias("'.Base::suffix($namespace, '\\').$name.'", "'.$this->settings['alias'].'");';
        }
    }

    /**
     * Protected Functions
     * 
     * @param string & $controller
     */
    protected function functions(String & $controller)
    {
        $parameters = NULL;

        if( ! empty($this->settings['functions']) ) foreach( $this->settings['functions'] as $isKey => $function )
        {
            if( ! empty($function) )
            {
                if( ! is_numeric($isKey) )
                {
                    if( is_array($function) )
                    {
                        $subValue = '';

                        foreach( $function as $key => $val )
                        {
                            if( ! is_numeric($key) )
                            {
                                $subValue = $val;
                                $val      = $key;
                            }

                            if( strpos($val, '...') === 0 )
                            {
                                $varprefix = str_replace('...', '...$', $val);
                                $subValue  = '';
                            }
                            else
                            {
                                $varprefix = '$'.$val;
                            }

                            $parameters .= $varprefix.( ! empty($subValue) ? ' = '.$subValue : '').', ';
                        }

                        $parameters = rtrim($parameters, ', ');
                    }

                    $function = $isKey;
                }

                $function = $this->vartype($function);

                $controller .= HT.$function->priority." function {$function->var}({$parameters})".EOL;
                $controller .= HT."{".EOL;
                $controller .= HT.HT."// Your codes...".EOL;
                $controller .= HT."}".EOL.EOL;
            }
        }
    }

    /**
     * Protected Uses
     * 
     * @param string & $controller
     * @param string & $namespace = NULL
     */
    protected function namespace(String & $controller, String & $namespace = NULL)
    {
        if( ! empty($this->settings['namespace']) )
        {
            $namespace   = $this->settings['namespace'];
            $controller .= "namespace ".$namespace.";".EOL.EOL;
        }
    }

    /**
     * Protected Uses
     * 
     * @param string & $controller
     */
    protected function uses(String & $controller)
    {
        if( ! empty($this->settings['use']) )
        {
            foreach( $this->settings['use'] as $key => $use )
            {
                if( is_numeric($key) )
                {
                    $controller .= "use {$use};".EOL;
                }
                else
                {
                    $controller .= "use {$key} as {$use};".EOL;
                }
            }

            $controller .= EOL;
        }
    }

    /**
     * Protected Extends
     * 
     * @param string & $controller
     */
    protected function extends(String & $controller)
    {
        if( ! empty($this->settings['extends']) )
        {
            $controller .= " extends ".$this->settings['extends'];
        }
    }
    
    /**
     * Protected Implements
     * 
     * @param string & $controller
     */
    protected function implements(String & $controller)
    {
        if( ! empty($this->settings['implements']) )
        {
            $controller .= " implements ".( is_array($this->settings['implements'])
                                            ? implode(', ', $this->settings['implements'])
                                            : $this->settings['implements']
                                          );
        }
    }

    /**
     * Protected Traits
     * 
     * @param string & $controller
     */
    protected function traits(String & $controller)
    {
        if( ! empty($this->settings['traits']) )
        {
            if( is_array($this->settings['traits']) ) foreach( $this->settings['traits'] as $trait )
            {
                $controller .= HT."use {$trait};".EOL;
            }
            else
            {
                $controller .= HT."use ".$this->settings['traits'].";".EOL;
            }

            $controller .= EOL;
        }
    }

    /**
     * Protected Contants
     * 
     * @param string & $controller
     */
    protected function constants(String & $controller)
    {
        if( ! empty($this->settings['constants']) )
        {
            foreach( $this->settings['constants'] as $key => $val )
            {
                $controller .= HT."const {$key} = {$val};".EOL;
            }

            $controller .= EOL;
        }
    }

    /**
     * Protected Vars
     * 
     * @param string & $controller
     */
    protected function vars(String & $controller)
    {
        if( ! empty($this->settings['vars']) )
        {
            $var = '';
            foreach( $this->settings['vars'] as $isKey => $var )
            {
                if( ! is_numeric($isKey) )
                {
                    $value = $var;
                    $var   = $isKey;
                }

                $vars = $this->vartype($var);
                $controller .= HT.$vars->priority.' $'.$vars->var.( ! empty($value) ? " = ".$value : '' ).";".EOL;
            }

            $controller .= EOL;
        }
    }

    /**
     * Protected Variable Type
     */
    protected function vartype($var)
    {
        $static = NULL;

        if( strstr($var, 'static') )
        {
            $static = ' static';
        }

        if( stripos($var, 'protected'.$static.':') === 0 )
        {
            $priority = 'protected';
            $var      = str_ireplace('protected'.$static.':', '', $var);
        }
        elseif( stripos($var, 'public'.$static.':') === 0 )
        {
            $priority = 'public';
            $var      = str_ireplace('public'.$static.':', '', $var);
        }
        elseif( stripos($var, 'private'.$static.':') === 0 )
        {
            $priority = 'private';
            $var     = str_ireplace('private'.$static.':', '', $var);
        }
        else
        {
            $priority = 'public';
            $var      = $var;
        }

        return (object)
        [
            'priority' => $priority . $static,
            'var'      => $var
        ];
    }

    /**
     * Protected type
     */
    protected function type($type)
    {
        switch( $type )
        {
            case 'model'     : $return = 'Models';      break;
            case 'controller': $return = 'Controllers'; break;
            case 'library'   : $return = 'Libraries';   break;
            case 'command'   : $return = 'Commands';    break;
        }

        return Base::presuffix($return ?? NULL, '/');
    }
}
