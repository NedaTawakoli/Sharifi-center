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
        Schema::create('job1s', function (Blueprint $table) {
            $table->id();
            $table->foreignId("company_id")->constrained("companies")->onDelete("cascade")->onUpdate("cascade");
            $table->text("title");
            $table->decimal("salary");
            $table->string("location")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job1s');
    }
};
