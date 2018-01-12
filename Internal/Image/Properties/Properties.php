<?php namespace ZN\Image;
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
    public static $colors =
    [
        // Transparent
        'transparent'       => '0|0|0|127',

        // Red Types
        'lightsalmon'       => '255|160|122',
        'salmon'            => '250|128|114',
        'darksalmon'        => '233|150|122',
        'lightcoral'        => '240|128|128',
        'indianred'         => '205|92|92',
        'crimson'           => '220|20|60',
        'firebrick'         => '178|34|34',
        'red'               => '255|0|0',
        'darkred'           => '139|0|0',
        'maroon'            => '128|0|0',
        'tomato'            => '255|99|71',
        'orangered'         => '255|69|0',
        'palevioletred'     => '219|112|147',

        // Blue Types
        'aliceblue'         => '240|248|255',
        'lavender'          => '230|230|250',
        'powderblue'        => '176|224|230',
        'lightblue'         => '173|216|230',
        'lightskyblue'      => '135|206|250',
        'skyblue'           => '135|206|235',
        'deepskyblue'       => '0|191|255',
        'lightsteelblue'    => '176|196|222',
        'dodgerblue'        => '30|144|255',
        'cornflowerblue'    => '100|149|237',
        'steelblue'         => '70|130|180',
        'cadetblue'         => '95|158|160',
        'mediumslateblue'   => '123|104|238',
        'slateblue'         => '106|90|205',
        'darkslateblue'     => '72|61|139',
        'royalblue'         => '65|105|225',
        'blue'              => '0|0|255',
        'mediumblue'        => '0|0|205',
        'darkblue'          => '0|0|139',
        'navy'              => '0|0|128',
        'midnightblue'      => '25|25|112',
        'blueviolet'        => '138|43|226',
        'indigo'            => '75|0|130',

        // Light Cyan Types
        'lightcyan'         => '224|255|255',
        'cyan'              => '0|255|255',
        'aqua'              => '0|255|255',
        'aquamarine'        => '127|255|212',
        'mediumaquamarine'  => '102|205|170',
        'paleturquoise'     => '175|238|238',
        'turquoise'         => '64|224|208',
        'mediumturquoise'   => '72|209|204',
        'darkturquoise'     => '0|206|209',
        'darkcyan'          => '0|139|139',
        'teal'              => '0|128|128',

        // Green Types
        'lawngreen'         => '124|252|0',
        'chartreuse'        => '127|255|0',
        'limegreen'         => '50|205|50',
        'lime'              => '0|255|0',
        'forestgreen'       => '34|139|34',
        'green'             => '0|128|0',
        'darkgreen'         => '0|100|0',
        'greenyellow'       => '173|255|47',
        'springgreen'       => '0|255|127',
        'mediumspringgreen' => '0|250|154',
        'lightgreen'        => '144|238|144',
        'palegreen'         => '152|251|152',
        'darkseagreen'      => '143|188|143',
        'mediumseagreen'    => '60|179|113',
        'lightseagreen'     => '32|178|170',
        'seagreen'          => '46|139|87',
        'olive'             => '128|128|0',
        'darkolivegreen'    => '85|107|47',
        'olivedrab'         => '107|142|35',

        // Grey Types
        'gainsboro'         => '220|220|220',
        'lightgray'         => '211|211|211',
        'lightgrey'         => '211|211|211',
        'silver'            => '192|192|192',
        'darkgray'          => '169|169|169',
        'darkgrey'          => '169|169|169',
        'gray'              => '128|128|128',
        'grey'              => '128|128|128',
        'dimgray'           => '105|105|105',
        'dimgrey'           => '105|105|105',
        'lightslategray'    => '119|136|153',
        'lightslategrey'    => '119|136|153',
        'slategray'         => '112|128|144',
        'slategrey'         => '112|128|144',
        'darkslategray'     => '47|79|79',
        'darkslategrey'     => '47|79|79',
        'black'             => '0|0|0',

        // Yellow Types
        'lightyellow'       => '255|255|224',
        'lightyellow1'      => '255|255|204',
        'lightyellow2'      => '255|255|153',
        'lightyellow3'      => '255|255|102',
        'lightyellow4'      => '255|255|51',
        'yellow'            => '255|255|0',
        'darkyellow'        => '204|204|0',
        'darkyellow1'       => '153|153|0',
        'darkyellow2'       => '128|128|0',
        'darkyellow3'       => '102|102|0',
        'darkyellow4'       => '51|51|0',
        'lemonchiffon'      => '255|250|205',
        'lightgoldenrodyellow' => '250|250|210',
        'papayawhip'        => '255|239|213',
        'moccasin'          => '255|228|181',
        'peachpuff'         => '255|218|185',
        'palegoldenrod'     => '238|232|170',
        'khaki'             => '240|230|140',
        'darkkhaki'         => '189|183|107',
        'yellowgreen'       => '154|205|50',

        // Pink Types
        'pink'              => '255|192|203',
        'lightpink'         => '255|182|193',
        'hotpink'           => '255|105|180',
        'deeppink'          => '255|20|147',

        // Purple  Types
        'thistle'           => '216|191|216',
        'plum'              => '221|160|221',
        'violet'            => '238|130|238',
        'orchid'            => '218|112|214',
        'fuchsia'           => '255|0|255',
        'magenta'           => '255|0|255',
        'mediumorchid'      => '186|85|211',
        'mediumpurple'      => '147|112|219',
        'darkviolet'        => '148|0|211',
        'darkorchid'        => '153|50|204',
        'darkmagenta'       => '139|0|139',
        'purple'            => '128|0|128',

        // Orange Types
        'coral'             => '255|127|80',
        'gold'              => '255|215|0',
        'orange'            => '255|165|0',
        'darkorange'        => '255|140|0',

        // Brown Types
        'brown'             => '165|42|42',

        // White Types
        'white'             => '255|255|255',
        'snow'              => '255|250|250',
        'honeydew'          => '240|255|240',
        'mintcream'         => '245|255|250',
        'azure'             => '240|255|255',
        'ghostwhite'        => '248|248|255',
        'whitesmoke'        => '245|245|245',
        'seashell'          => '255|245|238',
        'beige'             => '245|245|220',
        'oldlace'           => '253|245|230',
        'floralwhite'       => '255|250|240',
        'ivory'             => '255|255|240',
        'antiquewhite'      => '250|235|215',
        'linen'             => '250|240|230'
    ];
}
