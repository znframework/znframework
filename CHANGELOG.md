## 5.6.0(Unreleased) [2018-11-10]

### Dedicated
Mustafa Kemal Atatürk ∞

### Added
* Added json encoder for DB::insert/update() methods.[[docs](https://docs.znframework.com/veritabani-kullanimi/veritabani-kutuphanesi-bolum-1#json-encoder)]
* Added first & next methods for Storage libraries.[[docs](https://docs.znframework.com/veri-saklama-kutuphaneleri/oturum-kutuphanesi#first)]
* Added new config for Captcha.[[docs](https://docs.znframework.com/onyuz-tasarimi/guvenlik-kodu-kutuphanesi#type)]
* Added new config for Auth.[[docs](https://docs.znframework.com/kullanici-islemleri/tekil-kullanici-kutuphanesi)]

### Changed
* The $content parameters of html elements have been fixed to be nullable.[[change](https://github.com/znframework/package-hypertext/commit/9bd5e77a67c8dcea214152c3d4f406ef7ab90d16#diff-2f6e90f2f3c8cb55e95f5074c61bad54)]

### Modified
* Added persistent connection to MySQLi driver.[[modify](https://github.com/znframework/fullpack-edition/commit/c030c862d45a42468e8c67482e168fe308e09116#diff-14571437557d199f1b506e0e716cba5e)]
* Added persistent connection to PDO:MySQL driver.[[modify](https://github.com/znframework/fullpack-edition/commit/c030c862d45a42468e8c67482e168fe308e09116#diff-e1a04cef6337825ea7b6499022f8e708)]
* Added new parameter to Validation::check() method.[[modify](https://github.com/znframework/fullpack-edition/commit/886f2ca04f4154e0d46ff68f759396e9aebe1e27#diff-475109a1d4fa5a65d8ad8c980bee0cf7)]

### Fixed
* Fixed Import::view() method.[[fix](https://github.com/znframework/fullpack-edition/commit/03120c2bf2034e8efb83039ff90eee5d1239447c)]
* Fixed CallableTalkingQueries::callResultMethodsTalkingQuery() method.[[fix](https://github.com/znframework/fullpack-edition/commit/9e75d36e28fb5370d1ae52fc6ab1702df03dd88a)]
* Fixed ZN\Inclusion\Something::use() method.[[fix](https://github.com/znframework/fullpack-edition/commit/c06cdde166ced7e430de51e19c9de9c760dbc5cf)]
* Fixed Validation match methods.[[fix](https://github.com/znframework/fullpack-edition/commit/029771556a7899c1cc106ec2eeaf02cf60e7196a)]
* Fixed ExceptionTable template content.[[fix](https://github.com/znframework/fullpack-edition/commit/c030c862d45a42468e8c67482e168fe308e09116#diff-9c864f07860b914d0051198d494fe6ce)]
* Fixed ZN\Ability\Exclusion::__construct() method.[[fix](https://github.com/znframework/fullpack-edition/commit/c030c862d45a42468e8c67482e168fe308e09116#diff-f12178313608df993a2c258193c36a1b)]
* Fixed ZN\Database\GrandModel::__costruct() method.[[fix](https://github.com/znframework/fullpack-edition/commit/c030c862d45a42468e8c67482e168fe308e09116#diff-18c1edfe753eb31197a4cb091e89dde5)]
* Fixed protected ZN\Hypertext::on() method.[[fix](https://github.com/znframework/package-hypertext/commit/d43c7ec84b20527555646da84aecb72aec444b74#diff-d74b2b1ef707375f669f392101d6bb9d)]
* Fixed protected ZN\Generator::write() method.[[fix](https://github.com/znframework/package-generator/commit/9d0431a1b61ffb74a326bdc2695fe775e4e7612f)]
* The src properties of the html media elements have been fixed.[[fix](https://github.com/znframework/package-hypertext/commit/bface259b2e810344c0406b4b7181dc25350ee8b)]
* Fixed protected ZN\Exceptions::getTemplateWizardErrorData() method.[[fix](https://github.com/znframework/package-zerocore/commit/8ab86f7c8fd282268742d2a43f9f49dd8bae0616)]

### Removed
* None