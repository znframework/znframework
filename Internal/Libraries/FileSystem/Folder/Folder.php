<?php namespace ZN\FileSystem;

use ZN\FileSystem\Exception\FolderNotFoundException;

class InternalFolder extends FileSystemCommon implements FolderInterface
{
    //--------------------------------------------------------------------------------------------------------
    //
    // Author     : Ozan UYKUN <ozanbote@gmail.com>
    // Site       : www.znframework.com
    // License    : The MIT License
    // Telif Hakkı: Copyright (c) 2012-2016, znframework.com
    //
    //--------------------------------------------------------------------------------------------------------

    //--------------------------------------------------------------------------------------------------------
    // Exists
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $file
    //
    // @param bool
    //
    //--------------------------------------------------------------------------------------------------------
    public function exists(String $file) : Bool
    {
        return FolderFactory::class('FolderInfo')->exists($file);
    }

    //--------------------------------------------------------------------------------------------------------
    // create()
    //--------------------------------------------------------------------------------------------------------
    //
    // Dizin oluşturmak için kullanılır.
    //
    //--------------------------------------------------------------------------------------------------------
    public function create(String $file, Int $permission = 0755, Bool $recursive = true) : Bool
    {
        return FolderFactory::class('FolderForge')->create($file, $permission, $recursive);
    }

    //--------------------------------------------------------------------------------------------------------
    // rename()
    //--------------------------------------------------------------------------------------------------------
    //
    // Dosya veya dizinin adını değiştirmek için kullanılır.
    //
    //--------------------------------------------------------------------------------------------------------
    public function rename(String $oldName, String $newName) : Bool
    {
        return FolderFactory::class('FolderForge')->rename($oldName, $newName);
    }

    //--------------------------------------------------------------------------------------------------------
    // deleteEmpty()
    //--------------------------------------------------------------------------------------------------------
    //
    // Boş bir dizini silmek için kullanılır.
    //
    //--------------------------------------------------------------------------------------------------------
    public function deleteEmpty(String $folder) : Bool
    {
        return FolderFactory::class('FolderForge')->deleteEmpty($folder);
    }

    //--------------------------------------------------------------------------------------------------------
    // delete()
    //--------------------------------------------------------------------------------------------------------
    //
    // Bir dizini içindekilerle birlikte silmek için kullanılır.
    //
    //--------------------------------------------------------------------------------------------------------
    public function delete(String $name) : Bool
    {
        return FolderFactory::class('FolderForge')->delete($name);
    }

    //--------------------------------------------------------------------------------------------------------
    // fileInfo()
    //--------------------------------------------------------------------------------------------------------
    //
    // Bir dosya veya dizine ait dosyalar ve dizinler hakkında çeşitli bilgiler almak için kullanılır.
    //
    //--------------------------------------------------------------------------------------------------------
    public function fileInfo(String $dir, String $extension = NULL) : Array
    {
        return FolderFactory::class('FolderInfo')->fileInfo($dir, $extension);
    }

    //--------------------------------------------------------------------------------------------------------
    // Copy()
    //--------------------------------------------------------------------------------------------------------
    //
    // Bir dizini belirtilen başka bir konuma kopyalamak için kullanılır. Bu işlem kopyalanacak dizine
    // ait diğer alt dizin ve dosyaları da kapsamaktadır.
    //
    //--------------------------------------------------------------------------------------------------------
    public function copy(String $source, String $target) : Bool
    {
        return FolderFactory::class('FolderForge')->copy($source, $target);
    }

    //--------------------------------------------------------------------------------------------------------
    // change()
    //--------------------------------------------------------------------------------------------------------
    //
    // PHP'nin aktif çalışma dizinini değiştirmek için kullanılır.
    //
    //--------------------------------------------------------------------------------------------------------
    public function change(String $name) : Bool
    {
        return FolderFactory::class('FolderForge')->change($name);
    }

    //--------------------------------------------------------------------------------------------------------
    // basePath()
    //--------------------------------------------------------------------------------------------------------
    //
    // @param void
    //
    // @return string
    //
    //--------------------------------------------------------------------------------------------------------
    public function basePath() : String
    {
        return getcwd();
    }

    //--------------------------------------------------------------------------------------------------------
    // disk()
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $dir
    // @param string $type = 'free'
    //
    // @return Float
    //
    //--------------------------------------------------------------------------------------------------------
    public function disk(String $dir, String $type = 'free') : Float
    {
        return FolderFactory::class('FolderInfo')->disk($dir, $type);
    }

    //--------------------------------------------------------------------------------------------------------
    // totalSpace()
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $dir
    //
    // @return Float
    //
    //--------------------------------------------------------------------------------------------------------
    public function totalSpace(String $dir) : Float
    {
        return $this->disk($dir, 'total');
    }

    //--------------------------------------------------------------------------------------------------------
    // freeSpace()
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $dir
    //
    // @return Float
    //
    //--------------------------------------------------------------------------------------------------------
    public function freeSpace(String $dir) : Float
    {
        return $this->disk($dir, 'free');
    }

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
    public function files(String $path, $extension = NULL, Bool $pathType = false) : Array
    {
        return FolderFactory::class('FolderList')->files($path, $extension, $pathType);
    }

    //--------------------------------------------------------------------------------------------------------
    // allFiles()
    //--------------------------------------------------------------------------------------------------------
    //
    // Bir dizine ait tüm alt dizin ve dosyaların listesini almak için kullanılır. İç içe dizinlerde de
    // yer alan dosyaların listelenmesini isterseniz 2. parametreyi true ayarlayabilirsiniz.
    //
    //--------------------------------------------------------------------------------------------------------
    public function allFiles(String $pattern = '*', Bool $allFiles = false) : Array
    {
        return FolderFactory::class('FolderList')->allFiles($pattern, $allFiles);
    }
}
