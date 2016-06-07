<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOrderColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders',function($table){
            $table->enum('status', [
                'В обработке',
                'Принят',
                'Приготовлен',
                'В пути',
                'Доставлен',
                'Не обработан (отклонен)'
            ]);
            $table->enum('payed',[
                'Ожидает оплаты',
                'Оплачен'
            ]);
            $table->enum('payment_method',[
                'Наличными при получении',
                'Онлайн оплата visa/mastercard'
            ]);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders',function($table){
            $table->dropColumn('status');
            $table->dropColumn('payed');
            $table->dropColumn('payment_method');
        });
    }
}
