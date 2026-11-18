
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Menambahkan kolom foto pada tabel members.
     */
    public function up(): void
    {
        Schema::table('members', function (Blueprint $table) {
            // Menambahkan kolom foto setelah no_hp
            $table->string('foto')->nullable()->after('no_hp');
        });
    }

    /**
     * Menghapus kolom foto jika migration di-rollback.
     */
    public function down(): void
    {
        Schema::table('members', function (Blueprint $table) {
            $table->dropColumn('foto');
        });
    }
};
