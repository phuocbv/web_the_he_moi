<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use App\Repositories\Eloquent\CategoryRepository;
use App\Repositories\Contracts\ShopRepositoryInterface;
use App\Repositories\Eloquent\ShopRepository;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Repositories\Eloquent\UserRepository;
use App\Repositories\Contracts\ProductRepositoryInterface;
use App\Repositories\Eloquent\ProductRepository;
use App\Repositories\Contracts\CollectionRepositoryInterface;
use App\Repositories\Eloquent\CollectionRepository;
use App\Repositories\Contracts\RateRepositoryInterface;
use App\Repositories\Eloquent\RateRepository;
use App\Repositories\Contracts\FollowRepositoryInterface;
use App\Repositories\Eloquent\FollowRepository;
use App\Repositories\Contracts\ReceiverRepositoryInterface;
use App\Repositories\Eloquent\ReceiverRepository;
use App\Repositories\Contracts\OrderRepositoryInterface;
use App\Repositories\Eloquent\OrderRepository;
use App\Repositories\Contracts\OrderDetailRepositoryInterface;
use App\Repositories\Eloquent\OrderDetailRepository;
use App\Repositories\Contracts\LikeRepositoryInterface;
use App\Repositories\Eloquent\LikeRepository;
use App\Repositories\Contracts\ProductCollectionRepositoryInterface;
use App\Repositories\Eloquent\ProductCollectionRepository;
use App\Repositories\Contracts\ImageRepositoryInterface;
use App\Repositories\Eloquent\ImageRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(CategoryRepositoryInterface::class, CategoryRepository::class);
        $this->app->bind(ShopRepositoryInterface::class, ShopRepository::class);
        $this->app->bind(ProductRepositoryInterface::class, ProductRepository::class);
        $this->app->bind(CollectionRepositoryInterface::class, CollectionRepository::class);
        $this->app->bind(RateRepositoryInterface::class, RateRepository::class);
        $this->app->bind(FollowRepositoryInterface::class, FollowRepository::class);
        $this->app->bind(ReceiverRepositoryInterface::class, ReceiverRepository::class);
        $this->app->bind(OrderRepositoryInterface::class, OrderRepository::class);
        $this->app->bind(OrderDetailRepositoryInterface::class, OrderDetailRepository::class);
        $this->app->bind(LikeRepositoryInterface::class, LikeRepository::class);
        $this->app->bind(ProductCollectionRepositoryInterface::class, ProductCollectionRepository::class);
        $this->app->bind(ImageRepositoryInterface::class, ImageRepository::class);
    }
}
