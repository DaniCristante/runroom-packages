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

namespace Tests\Runroom\CookiesBundle\Unit;

use PHPUnit\Framework\TestCase;
use Prophecy\Argument;
use Runroom\CookiesBundle\Entity\CookiesPage;
use Runroom\CookiesBundle\Form\Type\CookiesFormType;
use Runroom\CookiesBundle\Repository\CookiesPageRepository;
use Runroom\CookiesBundle\Service\CookiesPageService;
use Runroom\CookiesBundle\ViewModel\CookiesPageViewModel;
use Runroom\FormHandlerBundle\FormHandler;

class CookiesPageServiceTest extends TestCase
{
    /** @var array */
    protected const COOKIES = [];

    /** @var \Prophecy\Prophecy\ObjectProphecy */
    protected $repository;

    /** @var \Prophecy\Prophecy\ObjectProphecy */
    protected $handler;

    /** @var CookiesPageService */
    protected $service;

    protected function setUp(): void
    {
        $this->repository = $this->prophesize(CookiesPageRepository::class);
        $this->handler = $this->prophesize(FormHandler::class);

        $this->service = new CookiesPageService(
            $this->repository->reveal(),
            $this->handler->reveal(),
            self::COOKIES
        );
    }

    /**
     * @test
     */
    public function itGetsViewModel(): void
    {
        $cookiesPage = $this->prophesize(CookiesPage::class);
        $this->repository->find()->shouldBeCalled()->willReturn($cookiesPage->reveal());

        $this->handler
            ->handleForm(CookiesFormType::class, Argument::type(CookiesPageViewModel::class))
            ->shouldBeCalled()
            ->willReturnArgument(1);

        $viewModel = $this->service->getViewModel();

        $this->assertInstanceOf(CookiesPageViewModel::class, $viewModel);
        $this->assertSame($viewModel->getCookiesPage(), $cookiesPage->reveal());
    }
}
