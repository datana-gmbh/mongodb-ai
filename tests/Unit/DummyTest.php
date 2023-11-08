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

namespace Datana\MongoDB\AI\Tests\Unit;

use Ergebnis\Test\Util\Helper;
use PHPUnit\Framework\TestCase;

final class DummyTest extends TestCase
{
    use Helper;

    /**
     * @test
     */
    public function true(): void
    {
        self::assertTrue(true);
    }
}
