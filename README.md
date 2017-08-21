# TecPool - Gridcoin pool by TechEC

## Installation

1. Use the provided `bin/crypt_prog` binary to generate code signing keys:

```bash
bin/crypt_prog -genkey 1024 keys/private keys/public
```

2. Copy the file `config/app.default.php` to `config/app.php` and setup the `'Datasources'` (database
configuration) and any other configuration option.

3. Execute `bin/cake migrations migrate` to populate the database. You can also run this command if you
upgrade the pool code and it will automatically apply the changes to your existing database.

4. Either configure your machine's webserver to point document root to `webroot`, or start up the
built-in webserver with:

```bash
bin/cake server -p 8765
```

Then visit `http://localhost:8765` to see the pool webpage.

5. Register a new account. The first account to register will automatically become the pool
administrator.

6. Add projects that are whitelisted.
