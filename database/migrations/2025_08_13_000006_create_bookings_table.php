<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');                        
            $table->string('birth_place');                      
            $table->date('birth_date');                         
            $table->date('booking_date')->unique();             
            $table->string('phone');                            

            // 🔗 relasi ke services
            $table->foreignId('service_id')
                  ->constrained('services')
                  ->onDelete('cascade');

            $table->decimal('total_price', 12, 2)->nullable();  
            $table->string('payment_method')->nullable();       
            $table->enum('payment_status', ['unpaid', 'pending', 'paid'])->default('unpaid'); 
            $table->string('payment_proof')->nullable();        
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
