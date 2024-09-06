# Pimcore Optimize Database tables

OPTIMIZE TABLES to save sace in DB

## Features

- **Objects:**  Uses messages to optimize the DB tables

## Installation

You can install the package via composer:

```bash
composer require ntriga/pimcore-optimize-db-tables
```

Add Bundle to `bundles.php`:

```php
return [
    Ntriga\OptimizeDbTables\OptimizeDbTablesBundle::class => ['all' => true],
];
```

Add a cronjob to run the command, we do this every night:

```bash
0 2 * * * /path/to/your/pimcore/bin/console ntriga:pimcore-optimize-db-tables
```

Consume the messages
```bash
bin/console messenger:consume ntriga_optimize_db_table
```

## Further configuration
For more information about the setup, check [Setup](./docs/00_Setup.md)


## Changelog
Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Credits
- [All contributors](../../contributors)

## License
GNU General Public License version 3 (GPLv3). Please see [License File](./LICENSE.md) for more information.

