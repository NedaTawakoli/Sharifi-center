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
        Schema::create('job__details1s', function (Blueprint $table) {
            $table->id();

            $table->date("start_date");
            $table->date("end_date");
            $table->text("description");
            $table->foreignId("job_id")->constrained("jobs")->onDelete("cascade")->onUpdate("cascade");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job__details1s');
    }
};
