<?php

namespace Larapress\Quantied\Commands;

use Illuminate\Console\Command;
use Larapress\ECommerce\Models\ProductType;

class QuantiedCreateProductType extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'lp:quantied:create-pt';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create Quantied product type';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        ProductType::updateOrCreate([
            'name' => config('larapress.quantied.product_typename'),
            'author_id' => 1,
        ], [
            'flags' => 0,
            'data' => [
                "form" => [
                    "schema" => [
                        "id" => "sample_form",
                        "fields" => [
                            "quantized" => [
                                "type" => "input",
                                "input" => "checkbox",
                                "label" => trans('larapress::quantied.product_type.quantized'),
                            ],
                            "max_quantity" => [
                                "type" => "input",
                                "input" => "text",
                                "label" => trans('larapress::quantied.product_type.max_quantity'),
                            ],
                            "in_stock" => [
                                "type" => "input",
                                "input" => "text",
                                "label" => trans('larapress::quantied.product_type.in_stock'),
                            ],
                            "colors" => [
                                "type" => "input",
                                "input" => "text",
                                "label" => trans('larapress::quantied.product_type.colors'),
                            ],
                            "sizes" => [
                                "type" => "input",
                                "input" => "text",
                                "label" => trans('larapress::quantied.product_type.sizes'),
                            ],
                        ],
                        "options" => [
                            "type" => "col"
                        ]
                    ],
                    "code" => [],
                    "values" => [],
                    "template" => [
                        "name" => null
                    ]
                ],
                "title" => trans('larapress::quantied.product_type.title'),
                "agent" => "pages.vuetify.1.0"
            ]
        ]);
        $this->info("Done.");

        return 0;
    }
}
