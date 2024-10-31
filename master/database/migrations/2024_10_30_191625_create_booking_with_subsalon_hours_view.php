<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement("
            CREATE VIEW booking_with_subsalon_hours AS
            SELECT
                bookings.id AS booking_id,
                bookings.date,
                bookings.time,
                sub_salons.name AS sub_salon_name,
                sub_salons.opening_hours_start,
                sub_salons.opening_hours_end
            FROM
                bookings
            JOIN
                booking_services ON bookings.id = booking_services.booking_id
            JOIN
                services ON booking_services.service_id = services.id
            JOIN
                categories ON services.categories_id = categories.id
            JOIN
                sub_salons ON categories.sub_salons_id = sub_salons.id;
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS booking_with_subsalon_hours");
    }
};
