# VERSION NOTES
Below is the change information according to the versions.

## 5.6.3 [2018-04-30]

### Added
* Added EventHandler library.[[EventHandler](https://github.com/znframework/package-event-handler)]
* New where clauses have been added to the DB class.[[91614d9](https://github.com/znframework/package-database/commit/91614d9ae12090cbb5a2b5a33197d60a747103cc)]

### Changed
* Several update methods have been added for version compatibility.[[#27](https://github.com/znframework/package-zerocore/pull/27)]

### Fixed
* Fixed syntax error in composer auto load in core.[[#28](https://github.com/znframework/package-zerocore/pull/28)]


## 5.6.2 [2018-04-20]

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

## 5.6 [2018-03-30]

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