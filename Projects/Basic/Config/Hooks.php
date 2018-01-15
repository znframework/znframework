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
    // Hook::project('example');
    //
    //--------------------------------------------------------------------------------------------------
   
    'project' => function(String $name)
    {
        return $name;
    }
];