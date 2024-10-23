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
        Schema::create('forms_help', function (Blueprint $table) {
            $table->id();
            $table->foreignId('form_id')->constrained('system_forms');
            $table->foreignId('icon_id')->nullable()->constrained('icons');
            $table->string('form_field_id'); // The ID of the field the help is related to
            $table->text('form_help_text');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('forms_help');
    }
};
