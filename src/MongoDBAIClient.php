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
use OpenAI\Client as OpenAI;
use OskarStark\Value\TrimmedNonEmptyString;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;
use Webmozart\Assert\Assert;

/**
 * @author Oskar Stark <oskarstark@googlemail.com>
 */
final readonly class MongoDBAIClient implements MongoDBAIClientInterface
{
    public function __construct(
        private MongoDB $mongodb,
        private string $database,
        private string $collection,
        private OpenAI $openAI,
        private LoggerInterface $logger = new NullLogger(),
    ) {
    }

    /**
     * {@inheritDoc}
     */
    public function AIggregate(array|string $prompt, array $examples = [], array $options = []): \Traversable
    {
        $prompts = [];

        if (\is_string($prompt)) {
            $prompt = TrimmedNonEmptyString::fromString($prompt, '$prompt must be a non empty string.');
        } else {
            Assert::notEmpty($prompt, '$prompt must be a an array of non empty strings.');
            $prompts = $prompt;
        }

        $database = $this->mongodb->selectDatabase($this->database);
        $collection = $database->selectCollection($this->collection);

        $messages = [
            ['role' => 'system', 'content' => 'You are a helpful assistant.'],
        ];

        foreach ($prompts as $prompt) {
            $messages[] = ['role' => 'user', 'content' => $prompt];
        }

        $parameters = [
            'model' => 'gpt-4-1106-preview',
            'messages' => $messages,
        ];

        $this->logger->debug('OpenAI: Create chat', $parameters);

        $response = $this->openAI->chat()->create($parameters);

        dd($response->choices());

        return $collection->aggregate($pipeline, $options);
    }
}
