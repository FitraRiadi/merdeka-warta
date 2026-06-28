<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $driver = Schema::getConnection()->getDriverName();

        if ($driver === 'sqlite') {
            Schema::create('views_new', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->nullable()->constrained()->cascadeOnDelete();
                $table->string('ip_address', 45)->nullable();
                $table->morphs('viewable');
                $table->timestamps();
                $table->unique(['user_id', 'ip_address', 'viewable_type', 'viewable_id'], 'views_unique');
            });

            DB::statement('INSERT INTO views_new (id, user_id, viewable_type, viewable_id, created_at, updated_at) SELECT id, user_id, viewable_type, viewable_id, created_at, updated_at FROM views');

            Schema::drop('views');
            Schema::rename('views_new', 'views');
        } else {
            try {
                Schema::table('views', function (Blueprint $table) {
                    $table->dropForeign(['user_id']);
                });
            } catch (\Throwable $e) {
                // FK may not exist
            }

            try {
                Schema::table('views', function (Blueprint $table) {
                    $table->dropUnique('views_user_viewable_unique');
                });
            } catch (\Throwable $e) {
                // index may not exist
            }

            try {
                Schema::table('views', function (Blueprint $table) {
                    $table->string('ip_address', 45)->nullable()->after('user_id');
                });
            } catch (\Throwable $e) {
                // column may already exist
            }

            try {
                DB::statement('ALTER TABLE views MODIFY user_id BIGINT UNSIGNED NULL');
            } catch (\Throwable $e) {
                // may already be nullable
            }

            Schema::table('views', function (Blueprint $table) {
                $table->index('user_id', 'views_user_id_index');
                $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
                $table->unique(['user_id', 'ip_address', 'viewable_type', 'viewable_id'], 'views_unique');
            });
        }
    }

    public function down(): void
    {
        $driver = Schema::getConnection()->getDriverName();

        if ($driver === 'sqlite') {
            Schema::create('views_old', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->constrained()->cascadeOnDelete();
                $table->morphs('viewable');
                $table->timestamps();
                $table->unique(['user_id', 'viewable_type', 'viewable_id'], 'views_user_viewable_unique');
            });

            DB::statement('INSERT INTO views_old (id, user_id, viewable_type, viewable_id, created_at, updated_at) SELECT id, user_id, viewable_type, viewable_id, created_at, updated_at FROM views');

            Schema::drop('views');
            Schema::rename('views_old', 'views');
        } else {
            try {
                Schema::table('views', function (Blueprint $table) {
                    $table->dropForeign(['user_id']);
                });
            } catch (\Throwable $e) {
                // ignore
            }

            try {
                Schema::table('views', function (Blueprint $table) {
                    $table->dropUnique('views_unique');
                });
            } catch (\Throwable $e) {
                // ignore
            }

            try {
                Schema::table('views', function (Blueprint $table) {
                    $table->dropIndex('views_user_id_index');
                });
            } catch (\Throwable $e) {
                // ignore
            }

            DB::statement('DELETE FROM views WHERE user_id IS NULL');

            try {
                Schema::table('views', function (Blueprint $table) {
                    $table->dropColumn('ip_address');
                });
            } catch (\Throwable $e) {
                // ignore
            }

            try {
                DB::statement('ALTER TABLE views MODIFY user_id BIGINT UNSIGNED NOT NULL');
            } catch (\Throwable $e) {
                // ignore
            }

            Schema::table('views', function (Blueprint $table) {
                $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
                $table->unique(['user_id', 'viewable_type', 'viewable_id'], 'views_user_viewable_unique');
            });
        }
    }
};
