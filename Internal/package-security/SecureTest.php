<?php namespace ZN\Security;

use Secure;

class SecureTest extends \PHPUnit\Framework\TestCase
{
    public function testData()
    {
        $this->assertEquals
        (
            '&amp;#60;&amp;#63;php echo &quot;This is&quot;; &amp;#63;&amp;#62; &lt;b&gt;example code!&lt;/b&gt;', 
            Secure::data('<?php echo "This is"; ?> <b>example code!</b>')
                ->phpTagEncode()
                ->htmlEncode()
                ->get()
        );
    }
}