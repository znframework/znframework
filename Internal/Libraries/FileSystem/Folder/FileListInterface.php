<?php namespace ZN\FileSystem\Folder;

interface FileListInterface
{
    //--------------------------------------------------------------------------------------------------------
    //
    // Author     : Ozan UYKUN <ozanbote@gmail.com>
    // Site       : www.znframework.com
    // License    : The MIT License
    // Copyright  : (c) 2012-2016, znframework.com
    //
    //--------------------------------------------------------------------------------------------------------

    //--------------------------------------------------------------------------------------------------------
    // files()
    //--------------------------------------------------------------------------------------------------------
    //
    // Bir dizin içindeki dosya ve dizin listesini almak için kullanılır. Eğer listelenecek dosyalar
    // arasında belli uzantılı dosyaların listelenmesi istenilirse 2. parametreye dosya uzantısı
    // verilebilir. Sadece dizinlerin listelenmesi istenirse 'dir' parametresini kullanmanız gerekir.
    // Birden fazla uzantı belirmek isterseniz 2. parametreyi ['dir', 'php'] gibi belirtebilirsiniz.
    //
    //--------------------------------------------------------------------------------------------------------
    public function files(String $path, $extension = NULL, Bool $pathType = false) : Array;
    
    //--------------------------------------------------------------------------------------------------------
    // allFiles()
    //--------------------------------------------------------------------------------------------------------
    //
    // Bir dizine ait tüm alt dizin ve dosyaların listesini almak için kullanılır. İç içe dizinlerde de
    // yer alan dosyaların listelenmesini isterseniz 2. parametreyi true ayarlayabilirsiniz.
    //
    //--------------------------------------------------------------------------------------------------------
    public function allFiles(String $pattern = '*', Bool $allFiles = false) : Array;
}
