name: PHP Composer

on:
  push:
    branches: [ master ]
  pull_request:
    branches: [ master ]

jobs:
  build:

    runs-on: ubuntu-latest

    steps:
    - uses: actions/checkout@v2

    - name: Validate composer.json and composer.lock
      run: composer validate --strict

    - name: Cache Composer packages
      id: composer-cache
      uses: actions/cache@v2
      with:
        path: vendor
        key: ${{ runner.os }}-php-${{ hashFiles('**/composer.lock') }}
        restore-keys: |
          ${{ runner.os }}-php-

    - name: Install dependencies
      run: composer install --prefer-dist --no-progress

    # Add a test script to composer.json, for instance: "test": "vendor/bin/phpunit"
    # Docs: https://getcomposer.org/doc/articles/scripts.md

    # - name: Run test suite
    #   run: composer run-script test
