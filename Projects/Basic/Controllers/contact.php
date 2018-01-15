<?php namespace Project\Controllers;

class Contact extends Controller
{
    public function main(String $params = NULL)
    {
        View::title('Contact')
            ->description('Contact Description')
            ->scripts
            ([
                'js/components/gmap.min.js',
                'https://maps.googleapis.com/maps/api/js?key=AIzaSyBsXUGTFS09pLVdsYEE9YrO2y4IAncAO2U&amp;callback=initMap'
            ]);
    }
}
