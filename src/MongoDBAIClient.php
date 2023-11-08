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
            $prompts[] = TrimmedNonEmptyString::fromString($prompt, '$prompt must be a non empty string.')->toString();
        } else {
            Assert::notEmpty($prompt, '$prompt must be a an array of non empty strings.');
            $prompts = $prompt;
        }

        $database = $this->mongodb->selectDatabase($this->database);
        $collection = $database->selectCollection($this->collection);

        $systemPrompts = [
            'Create a MongoDB aggregation pipeline and answer only with the pipeline itself, no explanations.',
            'It must be in a PHP array!',
            'No starting variable, just the pipeline itself.',
            'No ending ;'
        ];

        $messages = [];

        foreach ($systemPrompts as $systemPrompt) {
            $messages[] = ['role' => 'system', 'content' => $systemPrompt];
        }

        foreach ($prompts as $prompt) {
            $messages[] = ['role' => 'user', 'content' => $prompt];
        }

        if ([] !== $examples) {
            $messages[] = [
                'role' => 'system',
                'content' => 'Here are some examples of the documents in the collection:',
            ];
            foreach ($examples as $example) {
                $messages[] = ['role' => 'user', 'content' => $example];
            }
        }

        $parameters = [
            'model' => 'gpt-4-1106-preview',
            'messages' => $messages,
        ];

        $this->logger->debug('OpenAI: Create chat', $parameters);

        $response = $this->openAI->chat()->create($parameters);

        dd($response->choices[0]->message->content);

        return $collection->aggregate($pipeline, $options);
    }
}
