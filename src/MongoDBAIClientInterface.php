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
    /**
     * @param array|string $prompt   the prompt(s) to generate a MongoDB aggregation pipeline from
     * @param array        $examples the examples of documents to give the model more context
     * @param array        $options  the options for the aggregation pipeline
     */
    public function AIggregate(array|string $prompt, array $examples = [], array $options = []): \Traversable;
}
