<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('bank_accounts', function (Blueprint $table) {
            $table->id();
            $table->string('bank_name'); // Tên ngân hàng
            $table->string('account_number'); // Số tài khoản
            $table->string('account_holder'); // Chủ tài khoản
            $table->timestamps();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('bank_accounts');
    }
};
