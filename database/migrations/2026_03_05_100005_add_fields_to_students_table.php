<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('students', function (Blueprint $table) {
            $table->string('phone')->nullable()->after('password');
            $table->text('address')->nullable()->after('phone');
            $table->string('father_name')->nullable()->after('address');
            $table->date('date_of_birth')->nullable()->after('father_name');
            $table->enum('gender', ['male', 'female', 'other'])->nullable()->after('date_of_birth');
            $table->foreignId('class_id')->nullable()->after('gender')->constrained('classes')->nullOnDelete();
            $table->foreignId('section_id')->nullable()->after('class_id')->constrained('sections')->nullOnDelete();
            $table->string('roll_number')->nullable()->after('section_id');
            $table->date('admission_date')->nullable()->after('roll_number');
        });
    }

    public function down(): void
    {
        Schema::table('students', function (Blueprint $table) {
            $table->dropForeign(['class_id']);
            $table->dropForeign(['section_id']);
            $table->dropColumn(['phone', 'address', 'father_name', 'date_of_birth', 'gender', 'class_id', 'section_id', 'roll_number', 'admission_date']);
        });
    }
};
