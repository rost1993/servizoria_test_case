<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('currencys', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('code')->nullable();
            $table->timestamps();
        });

        Schema::create('rates', function (Blueprint $table) {
            $table->id();
            $table->integer('currency_id')->nullable();
            $table->date('date')->nullable();
            $table->float('rate', 10, 4);
            $table->timestamps();
        });

        // Добавляем соответствующие права на "Подсистему Прачечная"
        DB::table('currencys')->insert([
            [ 'name' => 'Доллар США', 'code' => 'USD' ],
            [ 'name' => 'Евро', 'code' => 'EUR' ],
            [ 'name' => 'Российский рубль', 'code' => 'RUB' ],
            [ 'name' => 'Китайский юань', 'code' => 'CNY' ],
            [ 'name' => 'Индийская рупия', 'code' => 'INR' ],
        ]);

        DB::table('rates')->insert([
            ['currency_id' => 1, 'date' => '2023-05-13', 'rate' => 77.2041],
            ['currency_id' => 1, 'date' => '2023-05-12', 'rate' => 75.8846],
            ['currency_id' => 1, 'date' => '2023-05-11', 'rate' => 76.6929],
            ['currency_id' => 1, 'date' => '2023-05-06', 'rate' => 76.8207],
            ['currency_id' => 1, 'date' => '2023-05-05', 'rate' => 78.6139],
            ['currency_id' => 1, 'date' => '2023-05-04', 'rate' => 79.3071],
            ['currency_id' => 1, 'date' => '2023-05-03', 'rate' => 79.9609],

            ['currency_id' => 2, 'date' => '2023-05-13', 'rate' => 84.2500],
            ['currency_id' => 2, 'date' => '2023-05-12', 'rate' => 82.8877],
            ['currency_id' => 2, 'date' => '2023-05-11', 'rate' => 84.1498],
            ['currency_id' => 2, 'date' => '2023-05-06', 'rate' => 84.9073],
            ['currency_id' => 2, 'date' => '2023-05-05', 'rate' => 86.9986],
            ['currency_id' => 2, 'date' => '2023-05-04', 'rate' => 87.5750],
            ['currency_id' => 2, 'date' => '2023-05-03', 'rate' => 87.6556],

            ['currency_id' => 4, 'date' => '2023-05-13', 'rate' => 11.0844],
            ['currency_id' => 4, 'date' => '2023-05-12', 'rate' => 10.9119],
            ['currency_id' => 4, 'date' => '2023-05-11', 'rate' => 11.0390],
            ['currency_id' => 4, 'date' => '2023-05-06', 'rate' => 11.1158],
            ['currency_id' => 4, 'date' => '2023-05-05', 'rate' => 11.3488],
            ['currency_id' => 4, 'date' => '2023-05-04', 'rate' => 11.4456],
            ['currency_id' => 4, 'date' => '2023-05-03', 'rate' => 11.4884],

            ['currency_id' => 5, 'date' => '2023-05-13', 'rate' => 0.9446],
            ['currency_id' => 5, 'date' => '2023-05-12', 'rate' => 0.9284],
            ['currency_id' => 5, 'date' => '2023-05-11', 'rate' => 0.9369],
            ['currency_id' => 5, 'date' => '2023-05-06', 'rate' => 0.9393],
            ['currency_id' => 5, 'date' => '2023-05-05', 'rate' => 0.9628],
            ['currency_id' => 5, 'date' => '2023-05-04', 'rate' => 0.9682],
            ['currency_id' => 5, 'date' => '2023-05-03', 'rate' => 0.9763],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('currencys');
        Schema::dropIfExists('rates');
    }
};
