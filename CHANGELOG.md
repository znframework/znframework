# VERSION NOTES
Below is the change information according to the versions.

## 5.7.4 [2018-05-26]

### Added 
* Added Payment Package.[[package-payment](https://github.com/znframework/package-payment)]
* Added <code>DB::whereFullText($column, String $value = '', String $type = NULL, String $logical = NULL) : DB</code> method.[[97bbb9f](https://github.com/znframework/fullpack-edition/commit/51c44d547de63d4d737edf9d16ce4e00847687e2#diff-97bbb9f7fd3e79242c6f906216e67b7f)]
* Added <code>DBForge::startAutoIncrement(String $table, Int $start = 0) : Bool</code> method.[[40bc98b](https://github.com/znframework/fullpack-edition/commit/51c44d547de63d4d737edf9d16ce4e00847687e2#diff-40bc98ba319d703e82a198e0ca13d732)]
* Added <code>DBForge::addAutoIncrement(String $table, String $column = 'id', Int $start = NULL) : Bool</code> method.
* Added <code>DBForge::addPrimaryKey(String $table = NULL, String $columns, String $constraint = NULL) : Bool</code> method.
* Added <code>DBForge::addForeignKey(String $table = NULL, String $columns, String $reftable, String $refcolumn, String $constraint = NULL) : Bool</code> method.
* Added <code>DBForge::dropPrimaryKey(String $table = NULL, String $constraint = NULL) : Bool</code> method.
* Added <code>DBForge::dropForeignKey(String $table = NULL, String $constraint = NULL) : Bool</code> method.
* Added <code>DBForge::createIndex(String $indexName, String $table, String $columns) : Bool</code> method.
* Added <code>DBForge::createUniqueIndex(String $indexName, String $table, String $columns) : Bool</code> method.
* Added <code>DBForge::createFulltextIndex(String $indexName, String $table, String $columns) : Bool</code> method.
* Added <code>DBForge::createSpatialIndex(String $indexName, String $table, String $columns) : Bool</code> method.
* Added <code>DBForge::dropIndex(String $indexName, String $table = NULL) : Bool</code> method.
* A feature has been added that allows the controller's subviews to be called shorter.[[fd9c772](https://github.com/znframework/fullpack-edition/commit/51c44d547de63d4d737edf9d16ce4e00847687e2#diff-fd9c7728c03004a3a36bcaa77ce9686a)]

### Fixed
* Fixed Inclusion\Project\ViewTrait trait.[[7ef67f0](https://github.com/znframework/fullpack-edition/commit/51c44d547de63d4d737edf9d16ce4e00847687e2#diff-7ef67f06054d73e433a50d8cdbfd4c17)]
* The error that occurs depending on the usage during auto-view loading is fixed.[[37b896b](https://github.com/znframework/fullpack-edition/commit/51c44d547de63d4d737edf9d16ce4e00847687e2#diff-37b896b104a8b83c09d37f57eca88858)]

## 5.7.3 [2018-05-19]

### Added
* The butcher now also shapes the action feature. [[8fa306c](https://github.com/znframework/fullpack-edition/commit/8fa306cb15e5ed5444bc6e8566946493925d7006)]
* Added multi-theme integration feature to Bucher class.[[e517df8](https://github.com/znframework/fullpack-edition/commit/e517df8c73a8d555fcf3242f882c81a3c84d7082)]
* Added usage of <code>DBTool::listTables()</code> and <code>DBTool::listDatabases()</code> for SQLServer driver.

### Changed
* The <code>DBForge::extras()</code> method has been modified according to the driver type.[[e7f8571](https://github.com/znframework/fullpack-edition/commit/e7f8571da970171273c4ffd99d0b9af56f375def)]

### Fixed
* The request must be made to a valid controller.[[fb50024](https://github.com/znframework/fullpack-edition/commit/fb5002422cab29048cb969c93fbcd8ee40ff08ad)]
* The parameter sending error has been fixed.[[8b3c7fd](https://github.com/znframework/fullpack-edition/commit/8b3c7fd52b2d663b4cb28d1a140f50940e657225#diff-7ba93bada7f16511bd3d5ef8520b7d3b)]
* The SQLServer driver abstract class expansion error has been fixed.[[46ba191](https://github.com/znframework/fullpack-edition/commit/46ba19151c5673a6cfd0aabf345e9349cc13fdac)]
* An error in the Restoration class has been fixed.[[38289b0](https://github.com/znframework/fullpack-edition/commit/38289b0dfb4005edac05c35361f24bbe271014e5)]

## 5.7.2 [2018-05-12]

### Added
* Added Butchery console commands.[[e8f76e2](https://github.com/znframework/fullpack-edition/commit/e8f76e255dfd98f3f00c0468e4c76eca05a6290f)]
* Added Butchery system.[[795930d](https://github.com/znframework/fullpack-edition/commit/795930df60c24c4469da9695e48ad36807407424)]
* Added Butchery directory into External directory.[[00b3929](https://github.com/znframework/fullpack-edition/commit/00b3929c2a14537e2744f77e5d5f5f600aad568d)]
* Added trigger support for postgres driver.[[3785dfb](https://github.com/znframework/fullpack-edition/commit/3785dfb7524872bee6ec1e3313c4335c83ed4b38)]
* Added new methods for Restful library.[[ff05a73](https://github.com/znframework/fullpack-edition/commit/ff05a738aa965a4f886c50fd1399b89bf4abe5a5)]
* Added new method for XML library.[[d24ee66](https://github.com/znframework/fullpack-edition/commit/d24ee664aa31520e2d92173dda35f46598a1c077)]
* Added new methods for CDN library.[[24c0158](https://github.com/znframework/fullpack-edition/commit/24c0158b660cb68028c20abc916c1bd759b355a2)]
* Added new aliases.[[8714b78](https://github.com/znframework/fullpack-edition/commit/8714b78a0132dc77af9528af2182a71e35923746)]

### Changed
* Updated DefaultProject.zip file.[[0a96065](https://github.com/znframework/fullpack-edition/commit/0a9606551b7cfb45030801cf01a07b83674e871f)]
* Updated directory index.[[#19](https://github.com/znframework/fullpack-edition/commit/0084dcab376bd9f0c6adc1b8d7e78c8b308ac5df)]

### Fixed
* Fixed External Email Templates.[[a9e32aa](https://github.com/znframework/fullpack-edition/commit/a9e32aae832595307108ee2bac0f705725442cfb)]
* Fixed validation required control.[[d4f7608](https://github.com/znframework/fullpack-edition/commit/d4f760814c3091d9eb135481d42ae801f3f9479e)]
* Fixed <code>User::logout()</code> method.[[0481ab4](https://github.com/znframework/fullpack-edition/commit/0481ab4a996d01b86863b645e0d9b901615d774b)]

## 5.7.1 [2018-05-05]

### Changed
* Changed Starting config "ajax code continue" key value.[[#10](https://github.com/znframework/fullpack-edition/commit/34bdad8faa18b9eee5ade61ccf9146a2cee7fa91)]
* The location of the class map file changed.[[#12](https://github.com/znframework/fullpack-edition/commit/e5848150ac80199e1a85b60ceca27e3e9428b539)]
* Changed pagination ajax return value.[[#18](https://github.com/znframework/fullpack-edition/commit/63435b98c524553a5bd1d3cea66560c3b42901bc)]

### Fixed
* Fixed talking queries.[[a41ae69](https://github.com/znframework/fullpack-edition/commit/a41ae690b6f1d56a324fb1bf80753f89d27f921f)]
* Fixed Buffering library namespace.[[#9](https://github.com/znframework/fullpack-edition/commit/ba6b5e4f4966ba20f539a82e39b47b1d7ecb0d06)]

### Removed
* Removed controls from the Autoloader class that could pose a problem.[[#16](https://github.com/znframework/fullpack-edition/commit/eb1690433a61f2881e99e8d4bb794cfc07aa965d)]

## 5.7.0 [2018-05-01]

### Dedicated
Vecihi Hürkuş

### Added
* Added login control to template wizard.[[92af28d](https://github.com/znframework/package-zerocore/commit/92af28d00af39d3d5d04821d9affb9ec9193ec4d)]
* Added new short methods to template wizard.[[1ff51d8](https://github.com/znframework/package-zerocore/commit/1ff51d852d07e9f36cc31912599432401ef298c1)]
* Added Credit Card rules.[[46ee5ff](https://github.com/znframework/package-validation/commit/46ee5ff6a124ddc30e54c255d1960101fd38c7e0)]
* In case of using 3rd section, it is accepted as a condition.[[2e2f35a](https://github.com/znframework/package-database/commit/2e2f35ae529ebb6eb2e60383e5dc33aa634d2751)]
* Added new where clauses.[[91614d9](https://github.com/znframework/package-database/commit/91614d9ae12090cbb5a2b5a33197d60a747103cc)]
* Added new parameter for redirect select data.[[f58740a](https://github.com/znframework/package-response/commit/f58740a937871a5b1b6d989d72b067bda69a762a)]

### Changed
* Changed default opening page.[[f15c2a0](https://github.com/znframework/znframework/commit/f15c2a0f52e92baa18231c4ee02bdef1f34ebd03)]
* The parameters of the Permission class have been expanded.[[451f74d](https://github.com/znframework/package-authorization/commit/451f74db3a52b86e223ff4c42029e2e01366e441)]

### Fixed
* Updated ExceptionTable.php file.[[9262539](https://github.com/znframework/znframework/commit/92625398f7abfff019bb5099819b9e42d27ac57f)]
* Updated Filesystem deleteFolderEmpty method.[[45a47da](https://github.com/znframework/package-zerocore/commit/45a47da4b1143435fcc0c4bb1dc184cc765002be)]
* Updated GrandModel.[[078b195](https://github.com/znframework/package-database/commit/078b195f5d15d8aa2a97d2f703ab21aac910e231)]
* Fixed <code>Request::method()</code> method.[[d114f19](https://github.com/znframework/package-request/commit/d114f193506be16ec0f75efa96bcb2d16f00bb19)]

### Removed
* The use of the subdirectory controller has been removed.[[8024ffa](https://github.com/znframework/package-zerocore/commit/8024ffa252d83a3012eff2b02faea0174e8070dd)]
* Removed <code>Validation::oldPassword()</code> method.

## 5.6.4 [2018-04-30]

### Added
* The messages() method was added to the validation class.[[b7070af](https://github.com/znframework/package-validation/commit/b7070af18496b91b08ed56069824f46cd57a6455)]
* New keys have been added to the ViewObjects language file, depending on the new validation library.[[7883f67](https://github.com/znframework/znframework/commit/7883f67734ef00befdeae89651cc2babc64ca422)]

## 5.6.3 [2018-04-22]

### Added
* Added EventHandler library.[[EventHandler](https://github.com/znframework/package-event-handler)]
* New where clauses have been added to the DB class.[[91614d9](https://github.com/znframework/packagedatabase/commit/91614d9ae12090cbb5a2b5a33197d60a747103cc)]

### Changed
* Several update methods have been added for version compatibility.[[#27](https://github.com/znframework/package-zerocore/pull/27)]

### Fixed
* Fixed syntax error in composer auto load in core.[[#28](https://github.com/znframework/package-zerocore/pull/28)]

## 5.6.2 [2018-04-16]

### Added
* A new method has been added to the Database class.[[#4](https://github.com/znframework/package-database/pull/4)]
* New usage has been added to the template wizard.[[#5](https://github.com/znframework/package-zerocore/pull/25)]

### Changed
* The internal structure of the User library has been redesigned.[[#3](https://github.com/znframework/package-authentication/pull/3)]

### Fixed
* The syntax error in the DBGrid class has been fixed.[[#3](https://github.com/znframework/package-database/pull/3)]
* Fixed an error that could lead to an undesired output when using GrandModel.[[e13d8ef](https://github.com/znframework/package-database/commit/e13d8ef4b97eaf465f5204b6509fddf070e4821f)]

## 5.6.1 [2018-04-08]

### Changed
* Changed Strings::divide() method.[[2fae331](https://github.com/znframework/package-datatypes/commit/2fae331705075769cea87dc2ce579f3cab462953)]
* Changed Method Library output.[[c1ce8ac](https://github.com/znframework/package-request/commit/c1ce8ac12cde70ecf9fcebb5a0a453f97b7f8f65)]

## 5.6.0 [2018-03-30]

### Dedicated
Rasmus Lerdorf

### Added
* Added virtual controller.[[3b5da7f](https://github.com/znframework/znframework/commit/3b5da7fa7a3abc6c1b3fb68f2e73ab826a5de0b4)]
* Added output setting for pagination.[[#126](https://github.com/znframework/znframework/pull/126)]
* Added <code>Config/Authentication.php</code> file.[[#121](https://github.com/znframework/znframework/pull/121)]
* Added <code>Config/Authorization.php</code> file.
* Added routing config.

### Changed
* <code>Upload::convertName()</code> method has now been updated so that it can be retrieved as a parameter at any value.[[#2](https://github.com/znframework/package-filesystem/pull/2)]
* Updated <code>Theme::active()</code> method.[[#11](https://github.com/znframework/package-zerocore/pull/11)]
* Pagination settings changed.[[a90670a](https://github.com/znframework/znframework/commit/a90670a164208dcaf09f1a95ed6ade9fe4af2b8a)]
* Updated <code>Settings/Autoloader.php</code> file.[[76eb2ea](https://github.com/znframework/znframework/commit/76eb2eab2c79d3119f07796a1706ca733776bb0a)]
* Updated <code>Config/Routing.php</code> file.[[319aa46](https://github.com/znframework/znframework/commit/319aa46e9fb82df93b3dac7c0d4512150deb1c54#diff-be805907d6ecc2026b475a710f4df522)]
* Updated starting:constructors config.[[319aa46](https://github.com/znframework/znframework/commit/319aa46e9fb82df93b3dac7c0d4512150deb1c54#diff-6df47e8aa95e707f7db19d574d9ea18a)]
* Changed zerocore file.[[6ef452e](https://github.com/znframework/znframework/commit/6ef452e82f94788a399b7118eb54fe3e834bfc81#diff-bb47b646b30f0cb62354961f00369c3c)]

### Fixed
* Fixed output of exception table.[[#125](https://github.com/znframework/znframework/pull/125)]
* Fixed Upload library. [[#3](https://github.com/znframework/package-filesystem/pull/3)]

### Removed
* The <code>invalidParameterErrorType</code> setting has been removed.[[#127](https://github.com/znframework/znframework/pull/127)]
* The FTP configuration has been moved to the <code>Config/Services.php</code> file.[[03eaa05](https://github.com/znframework/znframework/commit/03eaa0592892a698406752275b33a1988cc4fd81)]

## 5.5.0 [2018-01-01]

### Dedicated
Nikola Tesla
