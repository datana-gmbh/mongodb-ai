# mongodb-ai

| Branch    | PHP                                         | Code Coverage                                        |
|-----------|---------------------------------------------|------------------------------------------------------|
| `master`  | [![PHP][build-status-master-php]][actions]  | [![Code Coverage][coverage-status-master]][codecov]  |

## Usage

### Installation

```bash
composer require datana-gmbh/mongodb-ai
```

### Setup

```php
use Datana\Datapool\Api\MongoDBAI;

$client = new MongoDBAI(
    baseUri: 'https://api.datapool...',
    username: 'my-username',
    password: '******',
    timeout: 10 // optional
);

// you can now request any endpoint which needs authentication
$client->request('GET', '/api/something', $options);
```

[build-status-master-php]: https://github.com/datana-gmbh/mongodb-ai/workflows/PHP/badge.svg?branch=master
[coverage-status-master]: https://codecov.io/gh/datana-gmbh/mongodb-ai/branch/master/graph/badge.svg

[actions]: https://github.com/datana-gmbh/mongodb-ai/actions
[codecov]: https://codecov.io/gh/datana-gmbh/mongodb-ai
