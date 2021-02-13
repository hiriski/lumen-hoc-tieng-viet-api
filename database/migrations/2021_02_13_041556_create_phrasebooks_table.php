<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePhrasebooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('phrasebooks', function (Blueprint $table) {
            $table->id();
            $table->string('bahasa_indonesia')
                ->comment('Bahasa Indonesia');
            $table->string('tieng_viet')
                ->comment('Tiếng Việt');
            $table->string('english')->nullable()
                ->comment('(Optional) English US');
            $table->text('notes')->nullable();
            $table->unsignedBigInteger('created_by')
                ->comment('Creator of this phrase');
            $table->unsignedBigInteger('updated_by')->nullable()
                ->comment('User who renew of this phrase');
            $table->unsignedInteger('category_id');

            $table->softDeletes();
            $table->timestamps();
            
            $table->foreign('created_by')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('phrasebooks');
    }
}
