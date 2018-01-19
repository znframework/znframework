<?php namespace ZN\DateTime;
/**
 * ZN PHP Web Framework
 * 
 * "Simplicity is the ultimate sophistication." ~ Da Vinci
 * 
 * @package ZN
 * @license MIT [http://opensource.org/licenses/MIT]
 * @author  Ozan UYKUN [ozan@znframework.com]
 */

class Properties
{
    /**
     * Sets time format chars.
     * 
     * @var array
     */
    public static $setTimeFormatChars =
    [
        '{shortDayName}|{shortDay}|{SD}'                            => '%a',
        '{dayName}|{day}|{D}'                                       => '%A',
        '{dayNumber0}|{dayNum0}|{DN0}'                              => '%d',
        '{dayNumber}|{dayNum}|{DN}'                                 => '%e',
        '{yearDayNumber0}|{yearDayNum0}|{YDN}'                      => '%j',
        '{isoWeekDayNumber}|{isoWeekDayNum}|{IWDN}'                 => '%u',
        '{weekDayNumber}|{weekDayNum}|{WDN}'                        => '%w',
        '{weekNumber}|{weekNum}|{WN}'                               => '%U',
        '{startingMondayYearWeekNumber}|{smYearWeekNum}|{SMYWN}'    => '%W',
        '{shortMonthName}|{shortMonth}|{SM}'                        => '%b',
        '{monthName}|{month}|{mon}'                                 => '%B',
        '{monthNumber0}|{monNum0}|{monthNumber}|{monNum}|{MN}|{MN0}'=> '%m',
        '{century}|{cen}'                                           => '%C',
        '{shortYear}|{SY}'                                          => '%y',
        '{year}|{Y}'                                                => '%Y',
        '{hour}|{hour024}|{H024}'                                   => '%H',
        '{hour24}|{H24}'                                            => '%k',
        '{hour012}|{H012}'                                          => '%I',
        '{hour12}|{H12}'                                            => '%l',
        '{minute0}|{minute}|{min}|{min0}'                           => '%M',
        '{AMPM}|{AM}'                                               => '%p',
        '{ampm}|{am}'                                               => '%P',
        '{second}|{second0}|{sec}|{sec0}'                           => '%S',
        '{clock}'                                                   => '%X',
        '{dateTime}'                                                => '%c',
        '{date}'                                                    => '%x'
    ];

    /**
     * Sets date format chars.
     * 
     * @var array
     */
    public static $setDateFormatChars =
    [
        '{shortDayName}|{shortDay}|{SD}'                            => 'D',
        '{dayName}|{day}|{D}'                                       => 'l',
        '{dayNumber0}|{dayNum0}|{DN0}'                              => 'd',
        '{dayNumber}|{dayNum}|{DN}'                                 => 'j',
        '{totalDays}|{TD}'                                          => 't',
        '{yearDayNumber0}|{yearDayNumber}|{yearDayNum0}|{yearDayNum}|{YDN0}|{YDN}' => 'z',
        '{weekDayNumber}|{weekDayNum}|{WDN}'                        => 'N',
        '{weekDayNumber0}|{weekDayNum0}|{WDN0}'                     => 'w',
        '{weekNumber}|{weekNum}|{WN}'                               => 'W',
        '{shortMonthName}|{sortMonth}|{SM}'                         => 'M',
        '{monthName}|{month}|{mon}'                                 => 'F',
        '{monthNumber0}|{monNum0}|{MN0}'                            => 'm',
        '{monthNumber}|{monNum}|{MN}'                               => 'n',
        '{shortYear}|{SY}'                                          => 'y',
        '{year}|{Y}'                                                => 'o',
        '{currentYear}|{CY}'                                        => 'Y',
        '{yearNumber}|{yearNum}|{YN}'                               => 'L',
        '{hour}|{hour024}|{H024}'                                   => 'H',
        '{hour24}|{H24}'                                            => 'G',
        '{hour012}|{H012}'                                          => 'h',
        '{hour12}|{H12}'                                            => 'g',
        '{minute0}|{minute}|{min}|{min0}'                           => 'i',
        '{AMPM}|{AM}'                                               => 'A',
        '{ampm}|{am}'                                               => 'a',
        '{second}|{second0}|{sec}|{sec0}'                           => 's',
        '{microSecond}|{micSec}|{MS}'                               => 'u',
        '{internetConnectionTime}|{inConTime}|{ICT}'                => 'B',
        '{iso}|{ISO}'                                               => 'c',
        '{rfc}|{RFC}'                                               => 'r',
        '{unix}|{UNIX}'                                             => 'U'
    ];
}
