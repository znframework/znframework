<?php namespace ZN\ImageProcessing\Image;

use Folder;
use ZN\EncodingSupport\ImageProcessing\Image\Exception\ImageNotFoundException;
use ZN\EncodingSupport\ImageProcessing\Image\Exception\InvalidImageFileException;

class RenderImage implements RenderImageInterface
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
    // Do
    //--------------------------------------------------------------------------------------------------------
    //
    // @param string $fpath
    // @param array  $set
    //
    //--------------------------------------------------------------------------------------------------------
    public function do(String $fpath, Array $set) : String
    {
        $filePath = trim($fpath);

        if( strstr($filePath, baseUrl()) )
        {
            $filePath = str_replace(baseUrl(), '', $filePath);
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

        if( isset($set["proheight"]) )
        {
            if( $set["proheight"] < $currentHeight )
            {
                $height = $set["proheight"];
                $width  = round(($currentWidth * $height) / $currentHeight);
            }
        }

        if( isset($set["prowidth"]) )
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

        if( ! Folder::exists($this->thumbPath) )
        {
            Folder::create($this->thumbPath);
        }

        $newFile = removeExtension($this->file).$prefix.extension($this->file, true);

        if( file_exists($this->thumbPath.$newFile) )
        {
            return baseUrl($this->thumbPath.$newFile);
        }

        $rFile   = $this->fromFileType($filePath);

        $nFile   = imagecreatetruecolor($width, $height);

        if( isset($set["prowidth"]) || isset($set["proheight"]) )
        {
            $rWidth = $currentWidth; $rHeight = $currentHeight;
        }

        if( extension($filePath) === "png" )
        {
            imagealphablending($nFile, false);
            imagesavealpha($nFile,true);
            $transparent = imagecolorallocatealpha($nFile, 255, 255, 255, 127);
            imagefilledrectangle($nFile, 0, 0, $width, $height, $transparent);
        }

        imagecopyresampled($nFile, $rFile,  0, 0, $x, $y, $width, $height, $rWidth, $rHeight);

        $this->createFileType($nFile ,$this->thumbPath.$newFile, $quality);

        imagedestroy($rFile); imagedestroy($nFile);

        return baseUrl($this->thumbPath.$newFile);
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
        $fileEx = explode("/", $filePath);

        $this->file = $fileEx[count($fileEx) - 1];

        $this->thumbPath = substr($filePath,0,strlen($filePath) - strlen($this->file)).$this->dirName;

        $this->thumbPath = suffix($this->thumbPath);

        $this->thumbPath = str_replace(baseUrl(), "", $this->thumbPath);
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
        // UZANTI JPG
        if( extension($this->file) === 'jpg' )
        {
            return imagecreatefromjpeg($paths);
        }
        // UZANTI JPEG
        elseif( extension($this->file) === 'jpeg' )
        {
            return imagecreatefromjpeg($paths);
        }
        // UZANTI PNG
        elseif( extension($this->file) === 'png' )
        {
            return imagecreatefrompng($paths);
        }
        // UZANTI GIF
        elseif( extension($this->file) === 'gif' )
        {
            return imagecreatefromgif($paths);
        }
        else
        {
            return false;
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
        $extensions = ['jpg', 'jpeg', 'png', 'gif'];

        if( in_array(extension($file), $extensions))
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
        // JPG İÇİN KALİTE AYARI
        if( extension($this->file) === 'jpg' )
        {
            if( $quality === 0 )
            {
                $quality = 80;
            }

            return imagejpeg($files, $paths, $quality);
        }
        // JPEG İÇİN KALİTE AYARI
        elseif( extension($this->file) === 'jpeg' )
        {
            if( $quality === 0 )
            {
                $quality = 80;
            }

            return imagejpeg($files, $paths, $quality);
        }
        // PNG İÇİN KALİTE AYARI
        elseif( extension($this->file) === 'png' )
        {
            if( $quality === 0 )
            {
                $quality = 8;
            }

            return imagepng($files, $paths, $quality);
        }
        // GIF İÇİN KALİTE AYARI
        elseif( extension($this->file) === 'gif' )
        {
            return imagegif($files, $paths);
        }
        else
        {
            return false;
        }
    }
}
