<?php

namespace Tests\Feature;

use Illuminate\Http\Request;
use Larapress\CRUD\Services\CRUD\ICRUDService;
use Larapress\CRUD\Tests\PackageTestApplication;
use Larapress\ECommerce\CRUD\ProductCRUDProvider;
use Larapress\ECommerce\Models\ProductType;

class ProductTypeTest extends PackageTestApplication
{
    public function testQuantiedProductTypeCreation()
    {
        $this->artisan('lp:quantied:create-pt');

        $this->assertDatabaseHas('product_types', [
            'name' => config('larapress.quantied.product_typename')
        ]);
    }

    public function testQuantiedProductCreation()
    {
        $this->artisan('lp:quantied:create-pt');

        $quantiedPtId = ProductType::select('id')->where('name', config('larapress.quantied.product_typename'))->first()->id;

        $args = [
            'name' => 'sample quantied obj',
            'priority' => 1,
            'group' => null,
            'flags' => 0,
            'types' => [
                [
                    'id' => $quantiedPtId,
                ]
            ],
            'data' => [
                'title' => 'sample quantied obj',
            ],
        ];

        $this->beRootUser();
        /** @var ICRUDService */
        $service = app(ICRUDService::class);
        $service->useProvider(new ProductCRUDProvider());
        $product = $service->store(new Request($args));
        $this->assertNotNull($product);
    }

    public function testQuantiedProductPurchaseStockCount()
    {
        $this->artisan('lp:quantied:create-pt');

        $quantiedPtId = ProductType::select('id')->where('name', config('larapress.quantied.product_typename'))->first()->id;

        $args = [
            'name' => 'sample quantied obj',
            'priority' => 1,
            'group' => null,
            'flags' => 0,
            'types' => [
                [
                    'id' => $quantiedPtId,
                ]
            ],
            'data' => [
                'title' => 'sample quantied obj',
                'pricing' => [
                    [
                        'priority' => 1,
                        'currency' => config('larapress.ecommerce.banking.currency.id'),
                        'amount' => 100000
                    ],
                ],
            ],
        ];

        $this->beRootUser();
        /** @var ICRUDService */
        $service = app(ICRUDService::class);
        $service->useProvider(new ProductCRUDProvider());
        $product = $service->store(new Request($args));
    }
}
