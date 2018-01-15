<?php namespace Project\Controllers;

class Initialize extends Controller
{
    public function main(String $params = NULL)
    {   
        Theme::active('default');

        View::menus
            ([
                ''         => 'Home',
                'pricing'  => 'Pricing',
                'about'    => 'About',
                'products' => 'Products',
                'faq'      => 'FAQ',
                'contact'  => 'Contact'
            ])
            ->socials
            ([
                '#1' => 'Twitter',
                '#2' => 'Facebook',
                '#3' => 'Instagram',
                '#4' => 'YouTube'
            ]);

        Masterpage::headPage('sections/head')->bodyPage('sections/body')->title(ucfirst(CURRENT_CONTROLLER));
    }
}
