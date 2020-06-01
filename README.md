## Installation

```php
composer require reasno/fastmongo
```

MongoDB extension is ***NOT*** required.

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
        // if there is a command you cannot find, use runCommand or runCommandCursor.
        $client->my_database->runCommand(['ping' => 1]);
        return $client->my_database->runCommandCursor(['listCollections' => 1]); 
    }
}
```

