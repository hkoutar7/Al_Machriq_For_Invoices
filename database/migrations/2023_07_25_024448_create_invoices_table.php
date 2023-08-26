<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();

            $table->string("invoice_number");
            $table->date("invoice_date");
            $table->date("due_date");
            $table->string("product",50);
            $table->decimal('amount_collection',8,2)->nullable()->unsigned();
            $table->decimal('amount_commission',8,2)->unsigned();
            $table->decimal("discount",8,2);
            $table->string("rate_vat",50);
            $table->decimal("value_vat",8,2);
            $table->decimal("total",8,2);
            $table->text("note")->nullable();
            $table->enum("value_status",[0,1,2]);
            $table->date('payment_date')->nullable();

            $table->foreignId('section_id')->constrained('sections')->cascadeOnDelete();
            $table->foreignId("user_id")->constrained("users")->cascadeOnDelete();
            $table->softDeletes();
            $table->timestamps();

        });

    }

    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
