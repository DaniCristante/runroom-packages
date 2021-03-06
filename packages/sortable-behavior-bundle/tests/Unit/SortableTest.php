<?php

declare(strict_types=1);

/*
 * This file is part of the Runroom package.
 *
 * (c) Runroom <runroom@runroom.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Runroom\SortableBehaviorBundle\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Runroom\SortableBehaviorBundle\Tests\Fixtures\SortableEntity;

class SortableTest extends TestCase
{
    protected const POSITION = 42;

    /**
     * @test
     */
    public function itSetsAndGetsPosition()
    {
        $sortable = new SortableEntity();

        $sortable = $sortable->setPosition(self::POSITION);

        $this->assertSame(self::POSITION, $sortable->getPosition());
    }
}
