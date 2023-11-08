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

/**
 * @author Oskar Stark <oskarstark@googlemail.com>
 */
interface MongoDBAIClientInterface
{
    public function AIggregate(string $database, string $collection, string $prompt): array;
}
