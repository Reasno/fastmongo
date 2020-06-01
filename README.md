`reasno/fastmongo` is the a coroutine-based mongodb client for Hyperf.

## Installation

```php
composer require reasno/fastmongo
```

MongoDB extension is ***NOT*** required.

## Configuration

Just set the environmental variable MONGODB_URI. (Defaults to `mongodb://127.0.0.1:27017`)

## API List

```php
<?php
namespace App\Controller;

use Hyperf\GoTask\MongoClient\MongoClient;

class IndexController
{
    public function index(MongoClient $client)
    {
        $col = $client->my_database->my_col;
        $col->insertOne(['gender' => 'male', 'age' => 18]);
        $col->insertMany([['gender' => 'male', 'age' => 20], ['gender' => 'female', 'age' => 18]]);
        $col->countDocuments();
        $col->findOne(['gender' => 'male']);
        $col->find(['gender' => 'male'], ['skip' => 1, 'limit' => 1]);
        $col->updateOne(['gender' => 'male'], ['$inc' => ['age' => 1]]);
        $col->updateMany(['gender' => 'male'], ['$inc' => ['age' => 1]]);
        $col->replaceOne(['gender' => 'female'], ['gender' => 'female', 'age' => 15]);
        $col->aggregate([
              ['$match' => ['gender' => 'male']],
              ['$group' => ['_id' => '$gender', 'total' => ['$sum' => '$age']]],
        ]);
        $col->deleteOne(['gender' => 'male']);
        $col->deleteMany(['age' => 15]);
        $col->drop();
        // if there is a command not yet supported, use runCommand or runCommandCursor.
        $client->my_database->runCommand(['ping' => 1]);
        return $client->my_database->runCommandCursor(['listCollections' => 1]); 
    }
}
```

## Background

This package makes use of `hyperf/gotask` to achieve coroutine.

In `hyperf/gotask` v2.1.0 a new mongodb package is added. Normally GoTask requires you to do some coding in Go. However this approach demands some proficiency in Golang, which can be prohibitive. `reasno/fastmongo` is a prebuilt version of the newly added mongodb package. It will manage the Go binary for you so you don't have to.

This package only exposes a very simple yet optimized configuration interface. Should more customization be needed, checkout out the original `hyperf/gotask`. 

> Please do not turn on `hyperf/gotask` and this package at the same time.

## Future scope
* More mongodb command can be added. Please feel free to create issues or submit your PR to `hyperf/gotask`.


