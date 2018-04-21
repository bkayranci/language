### Install <code>turkalp/language</code> package
```bash
composer require turkalp/language
```

#### Create table
```bash
php artisan migrate
```

#### Publish seeder
```bash
php artisan vendor:publish --tag=seeds
```

#### Seed
```bash
php artisan db:seed --class=LanguageSeeder
```

#### Create migration many to many
```bash
php artisan language:make [MODEL_NAME] [TABLE_NAME]
```

