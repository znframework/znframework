<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>{{$title}}</title>
        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
        <style>
            html, body{height: 100%;}
            body{margin: 0;padding: 0;width: 100%;display: table;font-weight: lighter;font-family: 'Lato', sans-serif;}
            #container{text-align: center;display: table-cell;vertical-align: middle;}
            #content{text-align: center;display: inline-block;}
            #title{font-size: 96px;color:#BFC4C8;}
            #sub-title{font-size: 44.4px;color:#BFC4C8;}
        </style>
    </head>

    <body>
    	<div id="container">
            <div id="content">
                <div id="title">{{$title}}</div>
                <div id="sub-title">{{$subtitle}}</div>
            </div>
        </div>
    </body>

</html>
