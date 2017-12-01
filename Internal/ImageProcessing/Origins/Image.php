<?php namespace ZN\ImageProcessing;

use Mime, stdClass;
use ZN\Services\URL;
use ZN\FileSystem\File;
use ZN\FileSystem\Folder;
use ZN\ImageProcessing\Exception\ImageNotFoundException;
use ZN\ImageProcessing\Exception\InvalidImageFileException;

class Image implements ImageInterface
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
    // Dir Name
    //--------------------------------------------------------------------------------------------------------
    //
    // @var string
    //
    //--------------------------------------------------------------------------------------------------------
    protected $dirName = 'thumbs';
    
    //--------------------------------------------------------------------------------------------------------
    // File
    //--------------------------------------------------------------------------------------------------------
    //
    // @var string
    //
    //--------------------------------------------------------------------------------------------------------
    private $file;

    //--------------------------------------------------------------------------------------------------------
    // Thumb Path
    //--------------------------------------------------------------------------------------------------------
    //
    // @var string
    //
    //--------------------------------------------------------------------------------------------------------
    protected $thumbPath;

    //--------------------------------------------------------------------------------------------------------
    // Get Prosize
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $path
    // @param int    $width
    // @param int    $height
    //
    //--------------------------------------------------------------------------------------------------------
    public function getProsize(String $path, Int $width = 0, Int $height = 0) : stdClass
    {
        if( ! is_file($path) )
        {
            throw new ImageNotFoundException('[Image::getProsize(\''.$path.'\')] -> Image file is not found!');
        }

        $g = getimagesize($path);
        $x = $g[0]; $y = $g[1];

        if( $width > 0 )
        {
            if( $width <= $x )
            {
                $o = $x / $width;

                $x = $width;

                $y = $y / $o;
            }
            else
            {
                $o = $width / $x;

                $x = $width;

                $y = $y * $o;
            }
        }

        if( $height > 0 )
        {
            if( $height <= $y )
            {
                $o = $y / $height;

                $y = $height;

                $x = $x / $o;
            }
            else
            {
                $o = $height / $y;

                $y = $height;

                $x = $x * $o;
            }
        }

        $array["width"] = round($x); $array["height"] = round($y);

        return (object) $array;
    }

    //--------------------------------------------------------------------------------------------------------
    // Thumb
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $fpath
    // @param array  $set
    //
    //--------------------------------------------------------------------------------------------------------
    public function thumb(String $fpath, Array $set) : String
    {
        $filePath = trim($fpath);
        $baseUrl  = URL::base();

        if( strstr($filePath, $baseUrl) )
        {
            $filePath = str_replace($baseUrl, '', $filePath);
        }

        if( ! file_exists($filePath) )
        {
            throw new ImageNotFoundException('ImageProcessing', 'image:notFoundError', $filePath);
        }

        if( ! $this->isImageFile($filePath) )
        {
            throw new InvalidImageFileException('ImageProcessing', 'image:notImageFileError', $filePath);
        }

        list($currentWidth, $currentHeight) = getimagesize($filePath);

        $width    = $set["width"]    ?? $currentWidth;
        $height   = $set["height"]   ?? $currentHeight;
        $rewidth  = $set["rewidth"]  ?? 0;
        $reheight = $set["reheight"] ?? 0;
        $x        = $set["x"]        ?? 0;
        $y        = $set["y"]        ?? 0;
        $quality  = $set["quality"]  ?? 0;

        if( ! empty($set["proheight"]) )
        {
            if( $set["proheight"] < $currentHeight )
            {
                $height = $set["proheight"];
                $width  = round(($currentWidth * $height) / $currentHeight);
            }
        }

        if( ! empty($set["prowidth"]) )
        {
            if( $set["prowidth"] < $currentWidth )
            {
                $width  = $set["prowidth"];
                $height = round(($currentHeight * $width) / $currentWidth);
            }
        }

        $rWidth = $width; $rHeight = $height;

        if( ! empty($rewidth) )
        {
            $width = $rewidth;
        }

        if( ! empty($reheight) )
        {
            $height = $reheight;
        }

        $prefix = "-".$x."x".$y."px-".$width."x".$height."size";

        $this->newPath($filePath);

        if( ! is_dir($this->thumbPath) )
        {
            mkdir($this->thumbPath);
        }

        $newFile = File\Extension::remove($this->file).$prefix.File\Extension::get($this->file, true);

        if( file_exists($this->thumbPath.$newFile) )
        {
            return URL::base($this->thumbPath.$newFile);
        }

        $rFile   = $this->fromFileType($filePath);

        $nFile   = imagecreatetruecolor($width, $height);

        if( ! empty($set['prowidth']) || ! empty($set['proheight']) )
        {
            $rWidth = $currentWidth; $rHeight = $currentHeight;
        }

        if( File\Extension::get($filePath) === 'png' )
        {
            imagealphablending($nFile, false);
            imagesavealpha($nFile, true);
            $transparent = imagecolorallocatealpha($nFile, 255, 255, 255, 127);
            imagefilledrectangle($nFile, 0, 0, $width, $height, $transparent);
        }

        imagecopyresampled($nFile, $rFile,  0, 0, $x, $y, $width, $height, $rWidth, $rHeight);

        $this->createFileType($nFile ,$this->thumbPath.$newFile, $quality);

        imagedestroy($rFile); imagedestroy($nFile);

        return URL::base($this->thumbPath.$newFile);
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected New Path
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $filePath
    //
    //--------------------------------------------------------------------------------------------------------
    protected function newPath($filePath)
    {
        $fileEx          = explode("/", $filePath);
        $this->file      = $fileEx[count($fileEx) - 1];
        $this->thumbPath = substr($filePath,0,strlen($filePath) - strlen($this->file)).$this->dirName;
        $this->thumbPath = suffix($this->thumbPath);
        $this->thumbPath = str_replace(URL::base(), "", $this->thumbPath);
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected From File Type
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $paths
    //
    //--------------------------------------------------------------------------------------------------------
    protected function fromFileType($paths)
    {
        switch( File\Extension::get($this->file) )
        {
            case 'jpg' :
            case 'jpeg': return imagecreatefromjpeg($paths);
            case 'png' : return imagecreatefrompng ($paths);
            case 'gif' : return imagecreatefromgif ($paths);
            default    : return false;
        }
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected Is Image File
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $file
    //
    //--------------------------------------------------------------------------------------------------------
    protected function isImageFile($file)
    {
        $mimes = ['image/jpg', 'image/jpeg', 'image/png', 'image/gif'];

        if( in_array(Mime::type($file), $mimes) )
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    //--------------------------------------------------------------------------------------------------------
    // Protected Create File Type
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $files
    // @param string $paths
    // @param int    $quality
    //
    //--------------------------------------------------------------------------------------------------------
    protected function createFileType($files, $paths, $quality = 0)
    {
        switch( File\Extension::get($this->file) )
        {
            case 'jpg' :
            case 'jpeg': return imagejpeg($files, $paths, $quality ?: 80);
            case 'png' : return imagepng ($files, $paths, $quality ?: 8 );
            case 'gif' : return imagegif ($files, $paths                );
            default    : return false;
        }
    }
}
