### Submodule Installation 
```
git submodule add https://github.com/nemundo/db.git lib/db
```


```
$lib = new Library($autoload);
$lib->source = __DIR__ . '/lib/db/src/';
$lib->namespace = 'Nemundo\\Db';
```

###Submodule Deinstallation
```
git submodule deinit lib/db
git rm lib/db
```