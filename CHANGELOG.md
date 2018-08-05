## 5.8.3.5 [2018-08-06]

### Fixed
* Fixed Import::view() method.[[bug](https://github.com/znframework/fullpack-edition/commit/90d4de3c2a7cdc525a6f54327ad8350a6b00b286)]
* Fixed User::activationComplete() method.[[bug]()]

## 5.8.3.3 [2018-08-04]

### Added
* Added ML::keys() method.[[docs](https://docs.znframework.com/kodlama-destek-kutuphaneleri/coklu-dil-kutuphanesi#keys)] [[new](https://github.com/znframework/fullpack-edition/commit/f2f9a9d79799653b591ef85e5f5c784fa1768528)]
* Added ML::langs() method.[[docs](https://docs.znframework.com/kodlama-destek-kutuphaneleri/coklu-dil-kutuphanesi#langs)] [[new](https://github.com/znframework/fullpack-edition/commit/f2dce84806df1f2de76c30f56614e993f7caf090)]
* Added URL::lang() method.[[docs](https://docs.znframework.com/veri-transfer-kutuphaneleri/url-islem-kutuphanesi#lang)] [[new](https://github.com/znframework/fullpack-edition/commit/f2dce84806df1f2de76c30f56614e993f7caf090#diff-96e029136636fd2b541f84aa4d9f772e)]
* Added Form::vMessage() method.[[docs](https://docs.znframework.com/onyuz-tasarimi/form-kutuphanesi#vMessage)] [[new](https://github.com/znframework/fullpack-edition/commit/c8ab7b456be1bc4025bffdce0d2cf5f47121d05e)]

### Modified
* vMethods are arranged so that multiple uses are possible.[[modify](https://github.com/znframework/fullpack-edition/commit/c8ab7b456be1bc4025bffdce0d2cf5f47121d05e)]

## 5.8.2.8 [2018-08-02]

### Added
* Added File::reglace() method.[[docs](https://docs.znframework.com/dosya-sistemi/dosya-kutuphanesi#reglace)] [[new](https://github.com/znframework/fullpack-edition/commit/b5297c9df47286c6fbe3a6fa1beb5496c267e9e1#diff-daf302a1eba31443852b1215ad813fc6)]
* Added Form::vMethod() methods.[[docs](https://docs.znframework.com/onyuz-tasarimi/form-kutuphanesi#vMethod)] [[new](https://github.com/znframework/fullpack-edition/commit/b5297c9df47286c6fbe3a6fa1beb5496c267e9e1#diff-7621d6890f75a15bdd886cbe546f85e3)]
* Added Upload::isFile() method.[[docs](https://docs.znframework.com/dosya-sistemi/yukleme-kutuphanesi#isFile)] [[new](https://github.com/znframework/fullpack-edition/commit/1ee66e4b8c60b14275319d0fb3dbe380a5a9307d#diff-734a2ea3f2e96c955fb707d8ac3fc6c2)]

### Modified
* Modified Database\Connection::__debugInfo() method.[[modify](https://github.com/znframework/fullpack-edition/commit/1ee66e4b8c60b14275319d0fb3dbe380a5a9307d#diff-54a234aa2967b5e8c97827fb4652e0c7)]

### Fixed
* Fixed User::register() method.[[bug](https://github.com/znframework/fullpack-edition/commit/1ee66e4b8c60b14275319d0fb3dbe380a5a9307d#diff-2298793abc0ea143c1750da614a8870c)]
* Fixed Form::perm() method.[[bug](https://github.com/znframework/fullpack-edition/commit/1ee66e4b8c60b14275319d0fb3dbe380a5a9307d#diff-1e859290fc5fed4d0357740a79490a0c)]

## 5.8.2.2 [2018-07-29]

### Added
* Added new regex key.[[4727b29](https://github.com/znframework/fullpack-edition/commit/4727b296524ea999c14433c1858129a1b9acd49b)]
* Added DBForge::createTempTable() method.[[b5f5542](https://github.com/znframework/fullpack-edition/commit/b5f5542158780a2caeaf31d44a1f9e96b60da12a)]
* Added migration commands to Console.[[2f62163](https://github.com/znframework/fullpack-edition/commit/2f62163d0ee86951ad2e18d6196642def487f7b1)]
* Added GenerateProjectKey command to Console.[[209fb5a](https://github.com/znframework/fullpack-edition/commit/209fb5aac2b53c613ac6e089cf45fd4a7c6f34ac)]

### Modified
* Modified Cache::insert() & Converter::time() methods.[[4276108](https://github.com/znframework/fullpack-edition/commit/42761088ceb587b5c9dfe48c4c7d9074ffd8cb6b)]

### Fixed
* Fixed Route::show404() method.[[681ac27](https://github.com/znframework/fullpack-edition/commit/681ac27f533ef2557a6f1933664936befc2078c5)]

## 5.8.1.7 [2018-07-25]

### Added
* Added Users::passwordChangeProcess() method.[[fa0964e](https://github.com/znframework/fullpack-edition/commit/a510c464a43ab7243e7cfde7b76ebea5ed2056ef#diff-fa0964ebce72d866753862c35ee344e1)]
* Added Users::passwordChangeComplete() method.[[fa0964e](https://github.com/znframework/fullpack-edition/commit/a510c464a43ab7243e7cfde7b76ebea5ed2056ef#diff-fa0964ebce72d866753862c35ee344e1)]
* Added auto match feature to parameter 1 of User::register () method.[[ca495aa](https://github.com/znframework/fullpack-edition/commit/a510c464a43ab7243e7cfde7b76ebea5ed2056ef#diff-ca495aaab2b509c61246b4a640141acb)]
* Added Users::getEncryptionPassword() method.[[2298793](https://github.com/znframework/fullpack-edition/commit/a510c464a43ab7243e7cfde7b76ebea5ed2056ef#diff-2298793abc0ea143c1750da614a8870c)]

### Changed
* The default value of the key value in Config/Project.php has been changed.[[57fb64a](https://github.com/znframework/fullpack-edition/commit/57fb64ac5943f8286ca4121d8dc0964e9a32bc09)]

## 5.8.1.2 [2018-07-21]

### Changed
* Updated Devtools/Config/ViewObjects.php file.[[bbbec95](https://github.com/znframework/fullpack-edition/commit/bbbec955357443b5da0d92752263083e4f2585dd)]

### Modified
* Modified protected Form::_unsetopen() method.[[3747462](https://github.com/znframework/fullpack-edition/commit/37474629db8175cbe742e2327512d24c5421a8a2)]
* Modified Devtools Info view content.[[afcc830](https://github.com/znframework/fullpack-edition/commit/afcc8301087a34c3fc7da8e2faa2bf283af5d7b6)]

### Fixed
* Fixed protected DBGrid::_thead() method.[[c00fbea](https://github.com/znframework/fullpack-edition/commit/c00fbea9e1af520453d4124982ecd1619855be72)]

## 5.8.0.8 [2018-07-19]

### Added
* Added <code>Form::duplicateCheck()</code> method.[[1d3a2b6](https://github.com/znframework/fullpack-edition/pull/90/commits/1d3a2b68561f33d2fb59984f443a7e5be55f5155)]

### Fixed
* Fixed protected <code>Wizard::functions()</code> method.[[67ccb82](https://github.com/znframework/fullpack-edition/pull/90/commits/67ccb82cadab5e6042640f48f16d3a982d7f267d)]

### Removed
* Removed 2. parameter from <code>Route::uri()</code> method.[[3fb8608](https://github.com/znframework/fullpack-edition/pull/90/commits/3fb8608525f77b81a6006363d7d309d09e9d0cbc)]
* Removed <code>Route\CurlFilter</code> filter.[[0740bfd](https://github.com/znframework/fullpack-edition/pull/90/commits/0740bfde33b194ee03b1d5c94dd44149a46ba037)]

## 5.8.0.4 [2018-07-17]

### Modified
* Modified protected <code>Butcher::bodyParser()</code> method.[[5590a7c](https://github.com/znframework/fullpack-edition/commit/5590a7c7fac891f073a73a92387b7da94a61fe01)]
* Added <code>Database\Connection::__debugInfo()</code> method.[[e0c4457](https://github.com/znframework/fullpack-edition/commit/e0c445709aa006e424ae9da86fcb29db9ef0d0f2)]

### Fixed
* Fixed protected <code>Email\SmtpDriver::connect()</code> method.[[#88](https://github.com/znframework/fullpack-edition/commit/d51493498fcfe0e90901fde610ca75b6ee2d8f03)]
* Fixed protected <code>Exceptions::getTemplateWizardErrorData()</code> method.[[58d9ec3](https://github.com/znframework/fullpack-edition/commit/58d9ec366139b8563d44626b1d6bfd41ec4a89ff)]

## 5.8.0 [2018-07-15]

### Dedicated
Cahit Arf

### Added
* Added Container ability.[[bda687e](https://github.com/znframework/package-zerocore/commit/bda687e61ab185da4e91674c52229ab3e0ce5523)]

### Changed
* Changed Config/Project:locale values.[[f0006cc](https://github.com/znframework/fullpack-edition/commit/f0006ccf7a5f003edc20a30b2a5a6d12eeb150f5)]

### Modified
* Modified <code>Generator\Database::generate()</code> method.[[4f5316c](https://github.com/znframework/fullpack-edition/commit/4f5316c5f9da53483d7a03e9c71fa49ef2770bd6)]
* Modified protected <code>ZN\Expcetions::getTemplateWizardErrorData()</code> method.[[34db4e8](https://github.com/znframework/fullpack-edition/commit/34db4e87f36f8f05a3a589b02bae99a3188e1a25)]

### Fixed
* Fixed protected <code>Generator\File::type()</code> method.[[#83](https://github.com/znframework/fullpack-edition/commit/ea2ddfc18510bd5862da057265e93cf4f65e199e)]
* Fixed Generator\Generate Exception class.[[4ae1306](https://github.com/znframework/fullpack-edition/commit/4ae13066450988b14ba82d007d81d591038f31d0)]
* Fixed protected ZN\Exceptions::getTemplateWizardErrorData() method.[[50ab682](https://github.com/znframework/package-zerocore/commit/50ab6822f2686f9b7b41201ffe29e58d1d4fbbf8)]