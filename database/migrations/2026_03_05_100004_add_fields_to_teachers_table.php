<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('teachers', function (Blueprint $table) {
            $table->string('phone')->nullable()->after('password');
            $table->text('address')->nullable()->after('phone');
            $table->string('qualification')->nullable()->after('address');
            $table->foreignId('class_id')->nullable()->after('qualification')->constrained('classes')->nullOnDelete();
            $table->foreignId('subject_id')->nullable()->after('class_id')->constrained('subjects')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('teachers', function (Blueprint $table) {
            $table->dropForeign(['class_id']);
            $table->dropForeign(['subject_id']);
            $table->dropColumn(['phone', 'address', 'qualification', 'class_id', 'subject_id']);
        });
    }
};
