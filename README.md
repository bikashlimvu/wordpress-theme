# Introduction
This repository contains the code base for a custom WordPress theme

## Requirements
### System
- Apache/Nginx
- PHP 5.3+ (5.6 recommended)
- MySQL 5.6+

### Build
- [Composer](https://getcomposer.org/)
- [WP Cli](http://wp-cli.org/)

### Developer
- Sass compiler
- PHP Code sniffer
- PHP Mess detector

## Setup
1. Install the application using composer:
```
composer self-update
composer install
```
2. Add .htaccess/nginx configs
3. Add environment based wp-config
    * local-config.php for local environment
    * production-config.php for production environment
4. Get wp-content/uploads
5. Update the URLs in the database using WP Cli (test on dry-run first):
```
wp search-replace 'http://old-domain.com' 'http://new-domain.com'
```

**Note:** Secret keys can be generated on [WordPress](https://api.wordpress.org/secret-key/1.1/salt/).

## Managing WordPress, plugins and themes
WordPress and theme/plugin packages available through [wpackagist](https://wpackagist.org/) can be updated using composer.

To update a specific package:
```
composer update vendor/package:version
```

To update all packages (if using a flexible version range):
```
composer update
```

### Installing plugins/themes
When installing themes or plugins first check it is available on wpackagist.

If so use composer to add the package to the project. 

```
composer require vendor/package:version
```

If not then add an exception in gitignore so that it can be added to VCS. Same applies for custom plugins and themes.
```
!/html/wp-content/theme/theme-name
!/html/wp-content/plugins/plugin-name
```

## Development
Ensure code is developed to WordPress [best practices](https://make.wordpress.org/core/handbook/best-practices/).

### Theme development
- Use Sass to compile css:
    - **Sass source:** ```html/wp-content/themes/theme-name/assets/scss```
    - **Css destination:** ```html/wp-content/themes/theme-name/assets/css```
- Advanced Custom Fields (ACF) to be exported to JSON:  ```html/wp-content/themes/theme-name/assets/acf-json```

### Plugin development
- Set code style/standards to WordPress
- Enable WordPress PHPCS inspections
- Enable WordPress PHPMD inspections

