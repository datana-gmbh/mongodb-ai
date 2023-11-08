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

namespace Datana\MongoDB\AI\OpenAI;

use Datana\MongoDB\AI\MongoDBAIClientInterface;
use MongoDB\Client as MongoDB;
use OpenAI;
use OskarStark\Value\TrimmedNonEmptyString;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;
use Webmozart\Assert\Assert;

/**
 * @author Oskar Stark <oskarstark@googlemail.com>
 */
final readonly class OpenAIClientFactory
{
    public static function create(string $apiKey): OpenAI\Client
    {
        return OpenAI::client($apiKey);
    }
}
