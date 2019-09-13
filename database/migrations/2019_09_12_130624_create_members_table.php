<?php

use App\Models\Member;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('firstname', 100);
            $table->string('lastname', 100);
            $table->date('birthdate');
            $table->string('report', 100);
            $table->integer('country_id')->unsigned()->index();
            $table->string('phone', 50);
            $table->string('email', 100)->unique();
            $table->string('company', 100)->nullable();
            $table->string('position', 100)->nullable();
            $table->text('about')->nullable();
            $table->string('original_file_name')->nullable();
            $table->string('hash_file_name')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('country_id')
                ->references('id')->on('countries')
                ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('members');
        //Deleting members photos
        $storage = Storage::disk('images');
        $files = $storage->files(Member::IMAGES_FOLDER);
        $storage->delete($files);
    }
}
