<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('grades', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('students')->cascadeOnDelete();
            $table->foreignId('subject_id')->constrained('subjects')->cascadeOnDelete();
            $table->foreignId('exam_id')->constrained('exams')->cascadeOnDelete();
            $table->decimal('marks', 5, 2);
            $table->string('grade')->nullable();
            $table->timestamps();

            $table->unique(['student_id', 'subject_id', 'exam_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('grades');
    }
};
