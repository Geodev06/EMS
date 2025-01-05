<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('param_organizations', function (Blueprint $table) {
            $table->id();
            $table->string('org_code');
            $table->string('parent_org')->nullable(true);
            $table->string('name');
            $table->timestamps();
        });

        DB::unprepared("
            INSERT INTO `event_management`.`param_organizations` (`org_code`, `parent_org`, `name`,`created_at`) VALUES ('CCS', NULL, 'College of Compputer Studies', now());
            INSERT INTO `event_management`.`param_organizations` (`org_code`, `parent_org`, `name`,`created_at`) VALUES ('BSCS', 'CCS','Bachelor of Science in Computer Science', now());
            INSERT INTO `event_management`.`param_organizations` (`org_code`, `parent_org`, `name`,`created_at`) VALUES ('BSINFO', 'CCS','Bachelor of Science in Information Technology', now());

            INSERT INTO `event_management`.`param_organizations` (`org_code`, `parent_org`, `name`,`created_at`) VALUES ('BSCS1A', 'BSCS','Computer Science - 1A', now());
            INSERT INTO `event_management`.`param_organizations` (`org_code`, `parent_org`, `name`,`created_at`) VALUES ('BSCS1B', 'BSCS','Computer Science - 1B', now());
            INSERT INTO `event_management`.`param_organizations` (`org_code`, `parent_org`, `name`,`created_at`) VALUES ('BSCS2A', 'BSCS','Computer Science - 2A', now());
            INSERT INTO `event_management`.`param_organizations` (`org_code`, `parent_org`, `name`,`created_at`) VALUES ('BSCS2B', 'BSCS','Computer Science - 2B', now());
            INSERT INTO `event_management`.`param_organizations` (`org_code`, `parent_org`, `name`,`created_at`) VALUES ('BSCS3A', 'BSCS','Computer Science - 3A', now());
            INSERT INTO `event_management`.`param_organizations` (`org_code`, `parent_org`, `name`,`created_at`) VALUES ('BSCS3B', 'BSCS','Computer Science - 3B', now());
            INSERT INTO `event_management`.`param_organizations` (`org_code`, `parent_org`, `name`,`created_at`) VALUES ('BSCS4A', 'BSCS','Computer Science - 4A', now());
            INSERT INTO `event_management`.`param_organizations` (`org_code`, `parent_org`, `name`,`created_at`) VALUES ('BSCS4B', 'BSCS','Computer Science - 4B', now());

            INSERT INTO `event_management`.`param_organizations` (`org_code`, `parent_org`, `name`,`created_at`) VALUES ('BSINFO1A', 'BSINFO','Information Technology - 1A', now());
            INSERT INTO `event_management`.`param_organizations` (`org_code`, `parent_org`, `name`,`created_at`) VALUES ('BSINFO1B', 'BSINFO','Information Technology - 1B', now());
            INSERT INTO `event_management`.`param_organizations` (`org_code`, `parent_org`, `name`,`created_at`) VALUES ('BSINFO1C', 'BSINFO','Information Technology - 1C', now());
            INSERT INTO `event_management`.`param_organizations` (`org_code`, `parent_org`, `name`,`created_at`) VALUES ('BSINFO1D', 'BSINFO','Information Technology - 1D', now());
            INSERT INTO `event_management`.`param_organizations` (`org_code`, `parent_org`, `name`,`created_at`) VALUES ('BSINFO1E', 'BSINFO','Information Technology - 1E', now());
            INSERT INTO `event_management`.`param_organizations` (`org_code`, `parent_org`, `name`,`created_at`) VALUES ('BSINFO1F', 'BSINFO','Information Technology - 1F', now());

            INSERT INTO `event_management`.`param_organizations` (`org_code`, `parent_org`, `name`,`created_at`) VALUES ('BSINFO2A', 'BSINFO','Information Technology - 2A', now());
            INSERT INTO `event_management`.`param_organizations` (`org_code`, `parent_org`, `name`,`created_at`) VALUES ('BSINFO2B', 'BSINFO','Information Technology - 2B', now());
            INSERT INTO `event_management`.`param_organizations` (`org_code`, `parent_org`, `name`,`created_at`) VALUES ('BSINFO2C', 'BSINFO','Information Technology - 2C', now());
            INSERT INTO `event_management`.`param_organizations` (`org_code`, `parent_org`, `name`,`created_at`) VALUES ('BSINFO2D', 'BSINFO','Information Technology - 2D', now());
            INSERT INTO `event_management`.`param_organizations` (`org_code`, `parent_org`, `name`,`created_at`) VALUES ('BSINFO2E', 'BSINFO','Information Technology - 2E', now());
            INSERT INTO `event_management`.`param_organizations` (`org_code`, `parent_org`, `name`,`created_at`) VALUES ('BSINFO2F', 'BSINFO','Information Technology - 2F', now());

            INSERT INTO `event_management`.`param_organizations` (`org_code`, `parent_org`, `name`,`created_at`) VALUES ('BSINFO3A', 'BSINFO','Information Technology - 3A', now());
            INSERT INTO `event_management`.`param_organizations` (`org_code`, `parent_org`, `name`,`created_at`) VALUES ('BSINFO3B', 'BSINFO','Information Technology - 3B', now());
            INSERT INTO `event_management`.`param_organizations` (`org_code`, `parent_org`, `name`,`created_at`) VALUES ('BSINFO3C', 'BSINFO','Information Technology - 3C', now());
            INSERT INTO `event_management`.`param_organizations` (`org_code`, `parent_org`, `name`,`created_at`) VALUES ('BSINFO3D', 'BSINFO','Information Technology - 3D', now());
            INSERT INTO `event_management`.`param_organizations` (`org_code`, `parent_org`, `name`,`created_at`) VALUES ('BSINFO3E', 'BSINFO','Information Technology - 3E', now());
            INSERT INTO `event_management`.`param_organizations` (`org_code`, `parent_org`, `name`,`created_at`) VALUES ('BSINFO3F', 'BSINFO','Information Technology - 3F', now());

            INSERT INTO `event_management`.`param_organizations` (`org_code`, `parent_org`, `name`,`created_at`) VALUES ('BSINFO4A', 'BSINFO','Information Technology - 4A', now());
            INSERT INTO `event_management`.`param_organizations` (`org_code`, `parent_org`, `name`,`created_at`) VALUES ('BSINFO4B', 'BSINFO','Information Technology - 4B', now());
            INSERT INTO `event_management`.`param_organizations` (`org_code`, `parent_org`, `name`,`created_at`) VALUES ('BSINFO4C', 'BSINFO','Information Technology - 4C', now());
            INSERT INTO `event_management`.`param_organizations` (`org_code`, `parent_org`, `name`,`created_at`) VALUES ('BSINFO4D', 'BSINFO','Information Technology - 4D', now());
            INSERT INTO `event_management`.`param_organizations` (`org_code`, `parent_org`, `name`,`created_at`) VALUES ('BSINFO4E', 'BSINFO','Information Technology - 4E', now());
            INSERT INTO `event_management`.`param_organizations` (`org_code`, `parent_org`, `name`,`created_at`) VALUES ('BSINFO4F', 'BSINFO','Information Technology - 4F', now());

        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('param_organizations');
    }
};
