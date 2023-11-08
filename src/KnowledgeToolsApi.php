<?php

declare(strict_types=1);

/**
 * This file is part of Datapool-Api.
 *
 * (c) Datana GmbH <info@datana.rocks>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Datana\Datapool\Api;

use OskarStark\Value\TrimmedNonEmptyString;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;
use Webmozart\Assert\Assert;

final class KnowledgeToolsApi implements KnowledgeToolsApiInterface
{
    public function __construct(
        private DatapoolClient $client,
        private LoggerInterface $logger = new NullLogger(),
    ) {
    }

    public function getFieldvalueByInstanceAndOid(string $instance, int $oid, string $fieldhash): array
    {
        Assert::greaterThan($oid, 0);

        try {
            $response = $this->client->request(
                'GET',
                sprintf(
                    '/api/kt/%s/%d/fieldvalue/%s',
                    TrimmedNonEmptyString::fromString($instance)->toString(),
                    $oid,
                    TrimmedNonEmptyString::fromString($fieldhash)->toString(),
                ),
            );

            $this->logger->debug('Response', $response->toArray(false));

            return $response->toArray();
        } catch (\Throwable $e) {
            $this->logger->error($e->getMessage());

            throw $e;
        }
    }

    public function getFieldvalueByAktenzeichen(string $aktenzeichen, string $fieldhash): array
    {
        try {
            $response = $this->client->request(
                'GET',
                sprintf(
                    '/api/kt/%s/fieldvalue/%s',
                    TrimmedNonEmptyString::fromString($aktenzeichen)->toString(),
                    TrimmedNonEmptyString::fromString($fieldhash)->toString(),
                ),
            );

            $this->logger->debug('Response', $response->toArray(false));

            return $response->toArray();
        } catch (\Throwable $e) {
            $this->logger->error($e->getMessage());

            throw $e;
        }
    }
}
