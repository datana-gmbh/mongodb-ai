<?php

declare(strict_types=1);

/**
 * This file is part of datana-gmbh/mongodb-ai package.
 *
 * (c) Datana GmbH <info@datana.rocks>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Datana\MongoDB\AI;

use MongoDB\Client as MongoDB;
use OskarStark\Value\TrimmedNonEmptyString;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;

/**
 * @author Oskar Stark <oskarstark@googlemail.com>
 */
final readonly class MongoDBAIClient implements MongoDBAIClientInterface
{
    public function __construct(
        private readonly MongoDB $client,
        private readonly string $database,
        private readonly string $collection,
        private LoggerInterface $logger = new NullLogger()
    ) {
    }

    public function AIggregate(string $prompt): array
    {
        $prompt = TrimmedNonEmptyString::fromString($prompt, '$prompt must be a non empty string.');

        $database = $this->client->selectDatabase($this->database);
        $collection = $database->selectCollection($this->collection);

        

        return $collection->aggregate()
    }
}
