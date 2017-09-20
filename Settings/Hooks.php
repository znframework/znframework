<?php return
[
    //--------------------------------------------------------------------------------------------------
    // Hooks
    //--------------------------------------------------------------------------------------------------
    //
    // Bu dosyaya ekleyeceğiniz fonksiyonlarınızı Hook sınıfı ile kullanabilirsiniz. Anahtar ismi olarak
    // kullanılan ifadeler Hook sınıfında yöntem adı olarak kullanılır.
    //
    // Example
    //
    // Hook::general('example');
    //
    //--------------------------------------------------------------------------------------------------
   
    'general' => function(String $name)
    {
        return $name;
    }
];