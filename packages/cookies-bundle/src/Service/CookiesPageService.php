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

namespace Runroom\CookiesBundle\Service;

use Runroom\BaseBundle\Service\FormHandler;
use Runroom\CookiesBundle\Form\Type\CookiesFormType;
use Runroom\CookiesBundle\Repository\CookiesPageRepository;
use Runroom\CookiesBundle\ViewModel\CookiesPageViewModel;

class CookiesPageService
{
    protected $repository;
    protected $handler;
    protected $cookies;

    public function __construct(CookiesPageRepository $repository, FormHandler $handler, array $cookies)
    {
        $this->repository = $repository;
        $this->handler = $handler;
        $this->cookies = $cookies;
    }

    public function getViewModel(): CookiesPageViewModel
    {
        $viewModel = new CookiesPageViewModel();
        $viewModel
            ->setCookiesPage($this->repository->find())
            ->setCookies($this->cookies);

        return $this->handler->handleForm(CookiesFormType::class, $viewModel);
    }
}