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
        Schema::create('tb_otp', function (Blueprint $table) {
            $table->id('id_otp');
            $table->foreignId('warga_id')->constrained('tb_wargas', 'id_warga')->onDelete('cascade');
            $table->string('kode_otp', 6);
            $table->dateTime('expired_at');
            $table->boolean('is_used')->default(false); // Menandai apakah OTP sudah dipakai
            $table->enum('jenis_otp', ['register', 'login', 'reset_password']);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tb_otp');
    }
};
