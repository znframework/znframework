@Import::view('sections/header'):

{[ if( CURRENT_CONTROLLER !== 'home' ) Import::view('sections/parallax'); ]}

@$view:

@Import::view('sections/footer'):