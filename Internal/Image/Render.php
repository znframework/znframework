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

use stdClass;
use ZN\Base;
use ZN\Request;
use ZN\Singleton;
use ZN\Filesystem;
use ZN\Image\Exception\ImageNotFoundException;
use ZN\Image\Exception\InvalidImageFileException;

class Render implements RenderInterface
{
    /**
     * Thumbs directory name
     * 
     * @var string
     */
    protected $dirName = 'thumbs';
    
    /**
     * Keeps file path
     * 
     * @var string
     */
    private $file;

    /**
     * Thumb file path
     * 
     * @var string
     */
    protected $thumbPath;

    /**
     * Get prosize
     * 
     * @param string $path
     * @param int    $width = 0
     * @param int    $height = 0
     * 
     * @return object
     */
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
                $o = $x / $width; $x = $width; $y = $y / $o;
            }
            else
            {
                $o = $width / $x; $x = $width; $y = $y * $o;
            }
        }

        if( $height > 0 )
        {
            if( $height <= $y )
            {
                $o = $y / $height; $y = $height; $x = $x / $o;
            }
            else
            {
                $o = $height / $y; $y = $height; $x = $x * $o;
            }
        }

        $array["width"] = round($x); $array["height"] = round($y);

        return (object) $array;
    }

    /**
     * Thumb
     * 
     * @param string $fpath
     * @param array  $set
     * 
     * @return string
     */
    public function thumb(String $fpath, Array $set) : String
    {
        $filePath = trim($fpath);
        $baseUrl  = Request::getBaseURL();

        if( strstr($filePath, $baseUrl) )
        {
            $filePath = str_replace($baseUrl, '', $filePath);
        }

        if( ! file_exists($filePath) )
        {
            throw new ImageNotFoundException(NULL, $filePath);
        }

        if( ! $this->isImageFile($filePath) )
        {
            throw new InvalidImageFileException(NULL, $filePath);
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

        if( ! empty($rewidth ) ) $width  = $rewidth;
        if( ! empty($reheight) ) $height = $reheight;

        $prefix = "-".$x."x".$y."px-".$width."x".$height."size";

        $this->newPath($filePath);

        if( ! is_dir($this->thumbPath) )
        {
            mkdir($this->thumbPath);
        }

        $newFile = Filesystem::removeExtension($this->file).$prefix.Filesystem::getExtension($this->file, true);

        if( file_exists($this->thumbPath.$newFile) )
        {
            return Request::getBaseURL($this->thumbPath.$newFile);
        }

        $rFile   = $this->fromFileType($filePath);
        $nFile   = imagecreatetruecolor($width, $height);

        if( ! empty($set['prowidth']) || ! empty($set['proheight']) )
        {
            $rWidth = $currentWidth; $rHeight = $currentHeight;
        }

        if( Filesystem::getExtension($filePath) === 'png' )
        {
            imagealphablending($nFile, false);
            imagesavealpha($nFile, true);
            $transparent = imagecolorallocatealpha($nFile, 255, 255, 255, 127);
            imagefilledrectangle($nFile, 0, 0, $width, $height, $transparent);
        }

        imagecopyresampled($nFile, $rFile,  0, 0, $x, $y, $width, $height, $rWidth, $rHeight);

        $this->createFileType($nFile ,$this->thumbPath.$newFile, $quality);

        imagedestroy($rFile); imagedestroy($nFile);

        return Request::getBaseURL($this->thumbPath.$newFile);
    }

    /**
     * Protected New Path
     */
    protected function newPath($filePath)
    {
        $fileEx          = explode("/", $filePath);
        $this->file      = $fileEx[count($fileEx) - 1];
        $this->thumbPath = substr($filePath,0,strlen($filePath) - strlen($this->file)).$this->dirName;
        $this->thumbPath = Base::suffix($this->thumbPath);
        $this->thumbPath = str_replace(Request::getBaseURL(), "", $this->thumbPath);
    }

    /**
     * Protected From File Type
     */
    protected function fromFileType($paths)
    {
        switch( Filesystem::getExtension($this->file) )
        {
            case 'jpg' :
            case 'jpeg': return imagecreatefromjpeg($paths);
            case 'png' : return imagecreatefrompng ($paths);
            case 'gif' : return imagecreatefromgif ($paths);
            default    : return false;
        }
    }

    /**
     * Protected Is Image File
     */
    protected function isImageFile($file)
    {
        $mimes = ['image/jpg', 'image/jpeg', 'image/png', 'image/gif'];

        if( in_array(Singleton::class('ZN\Helpers\Mime')->type($file), $mimes) )
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    /**
     * Protected Create File Type
     */
    protected function createFileType($files, $paths, $quality = 0)
    {
        switch( Filesystem::getExtension($this->file) )
        {
            case 'jpg' :
            case 'jpeg': return imagejpeg($files, $paths, $quality ?: 80);
            case 'png' : 
                if( $quality > 10 )
                {
                    $quality = (int) ($quality / 10);
                }
                return imagepng($files, $paths, $quality ?: 8 );
            case 'gif' : return imagegif($files, $paths);
            default    : return false;
        }
    }
}
