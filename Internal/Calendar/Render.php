<?php namespace ZN\Calendar;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

use ZN\Request\URL;
use ZN\Request\URI;
use ZN\IS;
use ZN\Config;
use ZN\Lang;
use ZN\Base;

class Render implements RenderInterface
{
    /**
     * Keeps css values.
     * 
     * @var array
     */
    protected $css;

    /**
     * Keeps style values.
     * 
     * @var array
     */
    protected $style;

    /**
     * Calendar type.
     * 
     * @var string
     */
    protected $type = 'classic';

    /**
     * Month name type.
     * 
     * Options[long|short]
     * 
     * @var string
     */
    protected $monthNames = 'long';

    /**
     * Day name type.
     * 
     * Options[long|short]
     * 
     * @var string
     */
    protected $dayNames = 'short';

    /**
     * Prev link name
     * 
     * @var string
     */
    protected $prev = '<<';

    /**
     * Prev next name
     * 
     * @var string
     */
    protected $next = '>>';

    /**
     * Keeps url.
     * 
     * @var string
     */
    protected $url;

    /**
     * Magic constructor
     * 
     * @param void
     * 
     * @return void
     */
    public function __construct()
    {
        $this->getConfig = $config = Config::get('ViewObjects', 'calendar');

        $this->prev         = $config['prevName'];
        $this->next         = $config['nextName'];
        $this->dayNames     = $config['dayType'];
        $this->monthNames   = $config['monthType'];
        $this->css          = $config['class'];
        $this->style        = $config['style'];
    }

    /**
     * Specifies the URL to use.
     * 
     * @param string $url
     * 
     * @return Calendar
     */
    public function url(String $url) : Render
    {
        if( ! IS::url($url) )
        {
            $url = URL::site($url);
        }

        $this->url = $url;

        return $this;
    }

    /**
     * Specifies the name to be displayed.
     * 
     * @param string $day   - options[long|short]
     * @param string $month - options[long|short]
     * 
     * @return Calendar
     */
    public function nameType(String $day, String $month) : Render
    {
        $this->dayNames   = $day;

        $this->monthNames = $month;

        return $this;
    }

    /**
     * Specifies the css values.
     * 
     * @param array $css
     * 
     * @return Calendar
     */
    public function css(Array $css) : Render
    {
        $this->css = $css;

        return $this;
    }

    /**
     * Specifies the style values.
     * 
     * @param array $style
     * 
     * @return Calendar
     */
    public function style(Array $style) : Render
    {
        $this->style = $style;

        return $this;
    }

    /**
     * Specifies the type of calendar.
     * 
     * @param string $type - options[classic|ajax]
     * 
     * @return Calendar
     */
    public function type(String $type) : Render
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Change button names.
     * 
     * @param string $prev
     * @param string $next
     * 
     * @return Calendar
     */
    public function linkNames(String $prev, String $next) : Render
    {
        $this->prev = $prev;
        $this->next = $next;

        return $this;
    }

    /**
     * Configures all settings.
     * 
     * @param array $settings
     * 
     * @return Calendar
     */
    public function settings(Array $settings) : Render
    {
        Config::set('ViewObjects', 'calendar', $settings);

        return $this;
    }

    /**
     * Complete the calendar creation process.
     * 
     * @param int $year  = NULL
     * @param int $month = NULL
     * 
     * @return string
     */
    public function create(Int $year = NULL, Int $month = NULL) : String
    {
        $today = getdate();

        if( ! isset($this->url) )
        {
            $this->url = Base::suffix(CURRENT_CFURL);
        }

        if( $month === NULL && $year === NULL )
        {
            if( ! is_numeric(URI::segment(-1)) )
            {
                $month = $today['mon'];
            }
            else
            {
                $month = URI::segment(-1);
            }

            if( ! is_numeric(URI::segment(-2)) )
            {
                $year = $today['year'];
            }
            else
            {
                $year = URI::segment(-2);
            }
        }
        else
        {
            if( ! is_numeric($month) )
            {
                $month = $today['mon'];
            }

            if( ! is_numeric($year) )
            {
                $year = $today['year'];
            }
        }

        if( isset($_SERVER['HTTP_REFERER']) )
        {
            $arrays = array_diff(explode('/', URL::prev()), explode('/', URL::current()));

            $prevMonth = end($arrays);
        }
        else
        {
            $prevMonth = $month;
        }

        $monthNamesConfig = $this->getConfig['monthNames'][Lang::get()];

        if( $this->monthNames === 'long' )
        {
            $monthNames = array_keys($monthNamesConfig);
        }
        else
        {
            $monthNames = array_values($monthNamesConfig);
        }

        $dayNamesConfig = $this->getConfig['dayNames'][Lang::get()];

        $monthName = $monthNames[$month - 1];
        $dayNames  = ( $this->dayNames === 'long' )
                   ? array_keys($dayNamesConfig)
                   : array_values($dayNamesConfig);

        $firstDay = getdate( mktime(0, 0, 0, $month, 1, $year) );
        $lastDay  = getdate( mktime(0, 0, 0, $month + 1, 0, $year));

        $tableClass    = ( ! empty($this->css['table']) )       ? ' class="'.$this->css['table'].'"' : '';
        $tableStyle    = ( ! empty($this->style['table']) )     ? ' style="'.$this->style['table'].'"' : '';
        $monthRowClass = ( ! empty($this->css['monthName']) )   ? ' class="'.$this->css['monthName'].'"' : '';
        $monthRowStyle = ( ! empty($this->style['monthName']) ) ? ' style="'.$this->style['monthName'].'"' : '';
        $dayRowClass   = ( ! empty($this->css['dayName']) )     ? ' class="'.$this->css['dayName'].'"' : '';
        $dayRowStyle   = ( ! empty($this->style['dayName']) )   ? ' style="'.$this->style['dayName'].'"' : '';
        $rowsClass     = ( ! empty($this->css['days']) )        ? ' class="'.$this->css['days'].'"' : '';
        $rowsStyle     = ( ! empty($this->style['days']) )      ? ' style="'.$this->style['days'].'"' : '';

        $url = Base::suffix($this->url);

        $pcyear   = ( $month == 1 ? $year - 1 : $year );
        $pcmonth  = ( $month - 1 == 0  ? 12  : $month - 1 );
        $ncyear   = ( $month == 12 ? $year + 1 : $year );
        $ncmonth  = ( $month + 1 == 13 ? 1 : $month + 1 );

        $prevDate = $pcyear . "/". $pcmonth;
        $nextDate = $ncyear . "/". $ncmonth;

        if( $this->type === 'ajax' )
        {
            $prevUrl  = '#cdate='.$prevDate;
            $nextUrl  = '#cdate='.$nextDate;
            $prevAttr = ' ctype="ajax" cyear="'.$pcyear.'" cmonth="'.$pcmonth.'"';
            $nextAttr = ' ctype="ajax" cyear="'.$ncyear.'" cmonth="'.$ncmonth.'"';
        }
        else
        {
            $prevUrl  = $url.$prevDate;
            $nextUrl  = $url.$nextDate;
            $prevAttr = '';
            $nextAttr = '';
        }

        $prev = $this->a($prevUrl, $prevAttr);
        $next = $this->a($nextUrl, $nextAttr, 'next');

        $str  = $this->beginTable($tableClass, $tableStyle);
        $str .= $this->beginHead();
        $str .= $this->begintr().$this->th("{$prev} {$monthName} - {$year} {$next}", $monthRowClass, $monthRowStyle).$this->endtr();
        $str .= $this->begintr();
        ;

        foreach( $dayNames as $day )
        {
            $str .= $this->td($day, $dayRowClass, $dayRowStyle);;
        }

        $str .= $this->endtr();
        $str .= $this->endHead();
        $str .= $this->beginBody();
        $str .= $this->begintr();

        if( $firstDay['wday'] == 0 )
        {
            $firstDay['wday'] = 7;
        }

        for( $i = 1; $i < $firstDay['wday']; $i++ )
        {
            $str .= $this->td('&nbsp;', $rowsClass, $rowsStyle);
        }

        $activeDay = 0;

        for( $i = $firstDay['wday']; $i<=7; $i++ )
        {
            $activeDay++;

            if( $activeDay == $today['mday'] && $year == $today['year'] && $month == $today['mon'])
            {
                $class = $this->classAttr('current'); $style = $this->styleAttr('current');
            }
            else
            {
                $class = $this->classAttr('days'); $style = $this->styleAttr('days');
            }

            $str .= $this->td($activeDay, $class, $style);
        }

        $str .= $this->endtr();

        $weekCount = floor(($lastDay ['mday'] - $activeDay) / 7);

        for( $i = 0; $i < $weekCount; $i++ )
        {
            $str .= $this->begintr();


            for( $j = 0; $j < 7; $j++ )
            {
                $activeDay++;

                if( $activeDay == $today['mday'] && $year == $today['year'] && $month == $today['mon'])
                {
                    $class = $this->classAttr('current'); $style = $this->styleAttr('current');
                }
                else
                {
                    $class = $this->classAttr('days'); $style = $this->styleAttr('days');
                }
    
                $str .= $this->td($activeDay, $class, $style);
            }

            $str .= $this->endtr();
        }


        if( $activeDay < $lastDay['mday'] )
        {
            $str .= $this->begintr();

            for( $i = 0; $i < 7; $i++ )
            {
                $activeDay++;

                if( $activeDay == $today['mday'] )
                {
                    $class = $this->classAttr('current'); $style = $this->styleAttr('current');
                }
                else
                {
                    $class = $this->classAttr('days'); $style = $this->styleAttr('days');
                }

                if( $activeDay <= $lastDay ['mday'] )
                {
                    $active = $activeDay;
                }
                else
                {
                    $active = '&nbsp;';
                }

                $str .= $this->td($active, $style, $class);
            }
            $str .= $this->endtr();
        }

        $str .= $this->endBody();
        $str .= $this->endTable();

        $this->_defaultVariables();

        return $str;
    }   

    /**
     * Protected Begin Body
     */
    protected function beginBody()
    {
        return '<tbody>'.EOL;
    }

    /**
     * Protected End Body
     */
    protected function endBody()
    {
        return '</tbody>'.EOL;
    }

    /**
     * Protected Begin Head
     */
    protected function beginHead()
    {
        return '<thead>'.EOL;
    }

    /**
     * Protected End Head
     */
    protected function endHead()
    {
        return '</thead>'.EOL;
    }

    /**
     * Protected Begin Table
     */
    protected function beginTable($class, $style)
    {
        return "<table{$class}{$style}>".EOL;
    }

    /**
     * Protected End Table
     */
    protected function endTable()
    {
       return "</table>";
    }

    /**
     * Protected A
     */
    protected function a($url, $attr, $type = 'prev')
    {
        $buttonClass = ( ! empty($this->css['links']) )   ? ' class="'.$this->css['links'].'"' : '';
        $buttonStyle = ( ! empty($this->style['links']) ) ? ' style="'.$this->style['links'].'"' : '';

        return "<a href='". $url ."'{$buttonClass}{$buttonStyle}{$attr}>".$this->$type."</a>";
    }

    /**
     * Protected Th
     */
    protected function th($content, $class, $style)
    {
        return "\t\t<th{$class}{$style} colspan=\"7\">{$content}</th>".EOL;
    }

    /**
     * Protected Begin Tr
     */
    protected function begintr()
    {
        return "\t<tr>".EOL;
    }

    /**
     * Protected End Tr
     */
    protected function endtr()
    {
        return "\t</tr>".EOL;
    }

    /**
     * Protected Td
     */
    protected function td($content, $class = NULL, $style = NULL)
    {
        return "\t\t<td{$class}{$style}>$content</td>" . EOL;
    }

    /**
     * Protected Class Attr
     */
    protected function classAttr($type)
    {
        return ( ! empty($this->css[$type]) ) ? ' class="'.$this->css[$type].'"' : '';
    }

    /**
     * Protected Style Attr
     */
    protected function styleAttr($type)
    {
        return ( ! empty($this->style[$type]) ) ? ' style="'.$this->style[$type].'"' : '';
    }

    /**
     * Default variables.
     * 
     * @param void
     * 
     * @return void
     */
    protected function _defaultVariables()
    {
        $this->css          = NULL;
        $this->type         = 'classic';
        $this->style        = NULL;
        $this->monthNames   = NULL;
        $this->dayNames     = NULL;
        $this->url          = NULL;
        $this->prev         = '<<';
        $this->next         = '>>';
    }
}
