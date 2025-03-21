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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('endereco')->nullable();
            $table->string('telefone', 20)->nullable();
            $table->date('data_nascimento');
            $table->string('cpf', 14)->unique();
            $table->decimal('saldo', 10, 2)->default(0.00);
            $table->string('imagem')->nullable();
            $table->text('password');
            $table->rememberToken();
            $table->timestamps();
            $table->string('role')->default('user');
        });

        
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });


        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void{
        Schema::dropIfExists('admin');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
        Schema::table('admin', function (Blueprint $table) {
            $table->dropColumn('role');
        });
}
};