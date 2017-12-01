<?php namespace ZN\ViewObjects;

use Config, CLController;
use ZN\Services\URL;
use ZN\Services\URI;
use ZN\IndividualStructures\IS;
use ZN\IndividualStructures\Lang;

class Calendar extends CLController implements CalendarInterface
{
    //--------------------------------------------------------------------------------------------------------
    //
    // Author     : Ozan UYKUN <ozanbote@gmail.com>
    // Site       : www.znframework.com
    // License    : The MIT License
    // Copyright  : (c) 2012-2016, znframework.com
    //
    //--------------------------------------------------------------------------------------------------------

    const config = 'ViewObjects:calendar';

    //--------------------------------------------------------------------------------------------------------
    // Css
    //--------------------------------------------------------------------------------------------------------
    //
    // Css sınıf bilgisi
    //
    // @var  array
    //
    //--------------------------------------------------------------------------------------------------------
    protected $css;

    //--------------------------------------------------------------------------------------------------------
    // Style
    //--------------------------------------------------------------------------------------------------------
    //
    // Stil sınıf bilgisi
    //
    // @var  array
    //
    //--------------------------------------------------------------------------------------------------------
    protected $style;

    //--------------------------------------------------------------------------------------------------------
    // type
    //--------------------------------------------------------------------------------------------------------
    //
    // Tip sınıf bilgisi
    //
    // @var  string
    //
    //--------------------------------------------------------------------------------------------------------
    protected $type = 'classic';

    //--------------------------------------------------------------------------------------------------------
    // Month Names
    //--------------------------------------------------------------------------------------------------------
    //
    // Ay isimleri bilgisi
    //
    // @var  string
    //
    //--------------------------------------------------------------------------------------------------------
    protected $monthNames = 'long';

    //--------------------------------------------------------------------------------------------------------
    // Day Names
    //--------------------------------------------------------------------------------------------------------
    //
    // Gün isimleri bilgisi
    //
    // @var  string
    //
    //--------------------------------------------------------------------------------------------------------
    protected $dayNames = 'short';

    //--------------------------------------------------------------------------------------------------------
    // Prev
    //--------------------------------------------------------------------------------------------------------
    //
    // Önceki link bilgisi
    //
    // @var  string
    //
    //--------------------------------------------------------------------------------------------------------
    protected $prev = '<<';

    //--------------------------------------------------------------------------------------------------------
    // Next
    //--------------------------------------------------------------------------------------------------------
    //
    // Sonraki link bilgisi
    //
    // @var  string
    //
    //--------------------------------------------------------------------------------------------------------
    protected $next = '>>';

    //--------------------------------------------------------------------------------------------------------
    // Url
    //--------------------------------------------------------------------------------------------------------
    //
    // Bağlantı sağlanacak url bilgisi
    //
    // @var  string
    //
    //--------------------------------------------------------------------------------------------------------
    protected $url;

    //--------------------------------------------------------------------------------------------------------
    // Construct
    //--------------------------------------------------------------------------------------------------------
    //
    // @param  void
    // @return bool
    //
    //--------------------------------------------------------------------------------------------------------
    public function __construct()
    {
        parent::__construct();

        $config = VIEWOBJECTS_CALENDAR_CONFIG;

        $this->prev         = $config['prevName'];
        $this->next         = $config['nextName'];
        $this->dayNames     = $config['dayType'];
        $this->monthNames   = $config['monthType'];
        $this->css          = $config['class'];
        $this->style        = $config['style'];
    }

    //--------------------------------------------------------------------------------------------------------
    // Url
    //--------------------------------------------------------------------------------------------------------
    //
    // Takvimin bağlantı kurucağı url adresi.
    //
    // @param  string $url
    // @return this
    //
    //--------------------------------------------------------------------------------------------------------
    public function url(String $url) : Calendar
    {
        if( ! IS::url($url) )
        {
            $url = URL::site($url);
        }

        $this->url = $url;

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Name Type
    //--------------------------------------------------------------------------------------------------------
    //
    // Ay ve günler için normal isimlerini mi yoksa kısaltılmış isimlerin mi
    // kullanılacağını belirlemek için kullanılır.
    //
    // @param  string $day
    // @param  string $month
    // @return this
    //
    //--------------------------------------------------------------------------------------------------------
    public function nameType(String $day, String $month) : Calendar
    {
        $this->dayNames   = $day;

        $this->monthNames = $month;

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Css
    //--------------------------------------------------------------------------------------------------------
    //
    // Takvime css sınıfları uygulamak için kullanılır.
    //
    // @param  array $css
    // @return this
    //
    //--------------------------------------------------------------------------------------------------------
    public function css(Array $css) : Calendar
    {
        $this->css = $css;

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Style
    //--------------------------------------------------------------------------------------------------------
    //
    // Takvime stiller uygulamak için kullanılır.
    //
    // @param  array $style
    // @return this
    //
    //--------------------------------------------------------------------------------------------------------
    public function style(Array $style) : Calendar
    {
        $this->style = $style;

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Type
    //--------------------------------------------------------------------------------------------------------
    //
    // Takvimin kullanım türünü belirlemek içindir.
    //
    // @param  string $type
    // @return this
    //
    //--------------------------------------------------------------------------------------------------------
    public function type(String $type) : Calendar
    {
        $this->type = $type;

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Link Names
    //--------------------------------------------------------------------------------------------------------
    //
    // Takvimde yer alan iler ve geri butonu linklerinin isimlerini
    // değiştirmek için kulanılır.
    //
    // @param  string $prev
    // @param  string $next
    // @return this
    //
    //--------------------------------------------------------------------------------------------------------
    public function linkNames(String $prev, String $next) : Calendar
    {
        $this->prev = $prev;
        $this->next = $next;

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Settings
    //--------------------------------------------------------------------------------------------------------
    //
    // Takvim ayalarını yapılandırmak için kullanılır.
    //
    // @param  array $settings
    // @return object
    //
    //--------------------------------------------------------------------------------------------------------
    public function settings(Array $settings) : Calendar
    {
        Config::set('ViewObjects', 'calendar', $settings);

        return $this;
    }

    //--------------------------------------------------------------------------------------------------------
    // Create
    //--------------------------------------------------------------------------------------------------------
    //
    // Takvimin oluşturulması için kullanılan son yöntemdir.
    //
    // @param  numeric $year
    // @param  numeric $month
    // @return string
    //
    //--------------------------------------------------------------------------------------------------------
    public function create(Int $year = NULL, Int $month = NULL) : String
    {
        $today = getdate();

        if( ! isset($this->url) )
        {
            $this->url = suffix(CURRENT_CFURL);
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

        $monthNamesConfig = VIEWOBJECTS_CALENDAR_CONFIG['monthNames'][Lang::get()];

        if( $this->monthNames === 'long' )
        {
            $monthNames = array_keys($monthNamesConfig);
        }
        else
        {
            $monthNames = array_values($monthNamesConfig);
        }

        $dayNamesConfig = VIEWOBJECTS_CALENDAR_CONFIG['dayNames'][Lang::get()];

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
        $buttonClass   = ( ! empty($this->css['links']) )       ? ' class="'.$this->css['links'].'"' : '';
        $buttonStyle   = ( ! empty($this->style['links']) )     ? ' style="'.$this->style['links'].'"' : '';

        $eol  = EOL;

        $url = suffix($this->url);

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

        $prev = "<a href='". $prevUrl ."' {$buttonClass}{$buttonStyle}{$prevAttr}>$this->prev</a>";
        $next = "<a href='". $nextUrl ."' {$buttonClass}{$buttonStyle}{$nextAttr}>$this->next</a>";

        $str  = "<table{$tableClass}{$tableStyle}>".$eol;
        $str .= "\t<tr>".$eol."\t\t<th{$monthRowClass}{$monthRowStyle} colspan=\"7\">{$prev} {$monthName} - {$year} {$next}</th></tr>".$eol;
        $str .= "\t<tr>".$eol;

        foreach( $dayNames as $day )
        {
            $str .= "\t\t<td{$dayRowClass}{$dayRowStyle}>$day</td>".$eol;
        }

        $str .= "\t<tr>".$eol;

        if( $firstDay['wday'] == 0 )
        {
            $firstDay['wday'] = 7;
        }

        for( $i=1; $i<$firstDay['wday']; $i++ )
        {
            $str .= "\t\t<td{$rowsClass}{$rowsStyle}>&nbsp;</td>".$eol;
        }

        $activeDay = 0;

        for( $i = $firstDay['wday']; $i<=7; $i++ )
        {
            $activeDay++;

            if
            (
                $activeDay == $today['mday'] &&
                $year == $today['year']      &&
                $month == $today['mon']
            )
            {
                $class = ( ! empty($this->css['current']) ) ? ' class="'.$this->css['current'].'"' : '';

                $style = ( ! empty($this->style['current']) ) ? ' style="'.$this->style['current'].'"' : '';
            }
            else
            {
                $class = ( ! empty($this->css['days']) ) ? ' class="'.$this->css['days'].'"' : '';

                $style = ( ! empty($this->style['days']) ) ? ' style="'.$this->style['days'].'"' : '';
            }

            $str .= "\t\t<td{$class}{$style}>$activeDay</td>".$eol;
        }

        $str .= "\t</tr>".$eol;

        $weekCount = floor(($lastDay ['mday'] - $activeDay) / 7);

        for( $i = 0; $i < $weekCount; $i++ )
        {
            $str .= "\t<tr>";

            for( $j = 0; $j < 7; $j++ )
            {
                $activeDay++;

                if
                (
                    $activeDay == $today['mday'] &&
                    $year == $today['year']      &&
                    $month == $today['mon']
                )
                {
                    $class = ( ! empty($this->css['current']) ) ? ' class="'.$this->css['current'].'"' : '';

                    $style = ( ! empty($this->style['current']) ) ? ' style="'.$this->style['current'].'"' : '';
                }
                else
                {
                    $class = ( ! empty($this->css['days']) ) ? ' class="'.$this->css['days'].'"' : '';

                    $style = ( ! empty($this->style['days']) ) ? ' style="'.$this->style['days'].'"' : '';
                }

                $str .= "\t\t<td{$class}{$style}>$activeDay</td>".$eol;
            }

            $str .= "\t</tr>".$eol;
        }


        if( $activeDay < $lastDay['mday'] )
        {
            $str .= "\t<tr>".$eol;

            for( $i = 0; $i < 7; $i++ )
            {
                $activeDay++;

                if( $activeDay == $today['mday'] )
                {
                    $class = ( ! empty($this->css['current']) ) ? ' class="'.$this->css['current'].'"' : '';

                    $style = ( ! empty($this->style['current']) ) ? ' style="'.$this->style['current'].'"' : '';
                }
                else
                {
                    $class = ( ! empty($this->css['days']) ) ? ' class="'.$this->css['days'].'"' : '';

                    $style = ( ! empty($this->style['days']) ) ? ' style="'.$this->style['days'].'"' : '';
                }

                if( $activeDay <= $lastDay ['mday'] )
                {
                    $str .= "\t\t<td{$class}{$style}>$activeDay</td>".$eol;
                }
                else
                {
                    $str .= "\t\t<td{$class}{$style}>&nbsp;</td>".$eol;
                }
            }
            $str .= "\t</tr>".$eol;
        }

        $str .= "</table>";

        $this->_defaultVariables();

        return $str;
    }

    //--------------------------------------------------------------------------------------------------------
    // Create
    //--------------------------------------------------------------------------------------------------------
    //
    // Takvim değikenleri sıfılanıyor.
    //
    // @param  void
    // @return void
    //
    //--------------------------------------------------------------------------------------------------------
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
