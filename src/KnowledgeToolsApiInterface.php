<?php

declare(strict_types=1);

/**
 * This file is part of MongoDB AI.
 *
 * (c) Datana GmbH <info@datana.rocks>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Datana\Datapool\Api;

/**
 * @author Oskar Stark <oskar.stark@googlemail.de>
 */
interface KnowledgeToolsApiInterface
{
    /**
     * @return array{oid: int, instance: string, hash: string, value: mixed}
     */
    public function getFieldvalueByInstanceAndOid(string $instance, int $oid, string $fieldhash): array;

    /**
     * @return array{aktenzeichen: string, hash: string, value: mixed}
     */
    public function getFieldvalueByAktenzeichen(string $aktenzeichen, string $fieldhash): array;
}
