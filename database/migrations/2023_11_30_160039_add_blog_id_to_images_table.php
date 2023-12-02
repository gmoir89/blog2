<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // database/migrations/2023_11_30_000000_add_blog_id_to_images_table.php

public function up()
{
    Schema::table('images', function (Blueprint $table) {
        $table->foreignId('blog_id')->constrained(); // Add this line
    });
}

public function down()
{
    Schema::table('images', function (Blueprint $table) {
        $table->dropForeign(['blog_id']);
        $table->dropColumn('blog_id'); // Add this line if you want to rollback
    });
}

};
