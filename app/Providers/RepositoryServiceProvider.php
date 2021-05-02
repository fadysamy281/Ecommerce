<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Repositories\Contracts\BaseRepositoryInterface;
use App\Repositories\BaseRepository;

use App\Repositories\Contracts\CategoryInterface;
use App\Repositories\CategoryRepository;

use App\Repositories\Contracts\AttributeInterface;
use App\Repositories\AttributeRepository;

use App\Repositories\Contracts\BrandInterface;
use App\Repositories\BrandRepository;

use App\Repositories\Contracts\ProductInterface;
use App\Repositories\ProductRepository;

use App\Repositories\Contracts\OrderInterface;
use App\Repositories\OrderRepository;

class RepositoryServiceProvider extends ServiceProvider
{

    protected $repositories =array(

        BaseRepositoryInterface::class  =>  BaseRepository::class,
        CategoryInterface::class        =>  CategoryRepository::class,
        AttributeInterface::class       =>  AttributeRepository::class,
        BrandInterface::class           =>  BrandRepository::class,
        ProductInterface::class         =>  ProductRepository::class,
        OrderInterface::class           =>  OrderRepository::class,

    );


    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        foreach ($this->repositories as $interface => $repository)
        {
            $this->app->bind($interface, $repository);
        }
    }
}
