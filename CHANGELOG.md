## 5.9.0 [2018-09-01]

### Dedicated
Elon Musk

### Added
* Added CURRENT_THEME_URL constant.[[docs](https://docs.znframework.com/onyuz-tasarimi/temel-tema-entegrasyonu#CURRENT_THEME_URL)]
* Added internal Docker Environment.[[docs](https://docs.znframework.com/baslarken/kurulum-talimatlari#docker-environment)]
* Added LocalValetDriver driver.
* Added AjaxBuilder library.[[docs](https://docs.znframework.com/onyuz-tasarimi/ajax-isleme#ajax-builder)]
* Added JQueryBuilder library.[[docs](https://docs.znframework.com/onyuz-tasarimi/sablon-sihirbazi#jquery-builder)]

### Changed
* Authentication and Authorization configurations were merged under the name Auth.

### Modified
* None

### Fixed
* Fixed Cache\Redis driver.[[edit](https://github.com/znframework/package-cache/commit/950bb4fe8627ba9b38c2d918a211a8c70f8b35da)]

### Removed
* The case sensitivity of the controllers has been removed.
* Removed Redis:socketType config.[[edit](https://github.com/znframework/default-project/commit/5ace8287a77de3d23f2b6432b22059fa72f862d3)]