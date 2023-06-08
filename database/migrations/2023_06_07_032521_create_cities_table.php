<?php

use App\Models\City;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cities', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('department_id');
            $table
                ->foreign('department_id')
                ->references('id')
                ->on('departments')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->timestamps();
        });

         $nodesData = [
            [
                'name' => 'Leticia',
                'department_id' => 1,
            ],
            [
                'name' => 'Medellín',
                'department_id' => 2,
            ],
            [
                'name' => 'Rionegro',
                'department_id' => 2,
            ],
            [
                'name' => 'Apartadó',
                'department_id' => 2,
            ],
            [
                'name' => 'Turbo',
                'department_id' => 2,
            ],
            [
                'name' => 'Caucasia',
                'department_id' => 2,
            ],
            [
                'name' => 'Arauca',
                'department_id' => 3,
            ],
            [
                'name' => 'Barranquilla',
                'department_id' => 4,
            ],
            [
                'name' => 'Sabanalarga',
                'department_id' => 4,
            ],
            [
                'name' => 'Bogotá',
                'department_id' => 5,
            ],
            [
                'name' => 'Cartagena',
                'department_id' => 6,
            ],
            [
                'name' => 'Magangué',
                'department_id' => 6,
            ],
            [
                'name' => 'El Carmen de Bolivar',
                'department_id' => 6,
            ],
            [
                'name' => 'Tunja',
                'department_id' => 7,
            ],
            [
                'name' => 'Duitama',
                'department_id' => 7,
            ],
            [
                'name' => 'Sogamoso',
                'department_id' => 7,
            ],
            [
                'name' => 'Manizales',
                'department_id' => 8,
            ],
            [
                'name' => 'Florencia',
                'department_id' => 9,
            ],
            [
                'name' => 'Yopal',
                'department_id' => 10,
            ],
            [
                'name' => 'Popayán',
                'department_id' => 11,
            ],
            [
                'name' => 'Santander de Quilichao',
                'department_id' => 11,
            ],
            [
                'name' => 'Valledupar',
                'department_id' => 12,
            ],
            [
                'name' => 'Aguachica',
                'department_id' => 12,
            ],
            [
                'name' => 'Quibdó',
                'department_id' => 13,
            ],
            [
                'name' => 'Montería',
                'department_id' => 14,
            ],
            [
                'name' => 'Lorica',
                'department_id' => 14,
            ],
            [
                'name' => 'Montelíbano',
                'department_id' => 14,
            ],
            [
                'name' => 'Girardot',
                'department_id' => 15,
            ],
            [
                'name' => 'Fusagasugá',
                'department_id' => 15,
            ],
            [
                'name' => 'Zipaquirá',
                'department_id' => 15,
            ],
            [
                'name' => 'Facatativá',
                'department_id' => 15,
            ],
            [
                'name' => 'Inírida',
                'department_id' => 16,
            ],
            [
                'name' => 'San José del Guaviare',
                'department_id' => 17,
            ],
            [
                'name' => 'Neiva',
                'department_id' => 18,
            ],
            [
                'name' => 'Pitalito',
                'department_id' => 18,
            ],
            [
                'name' => 'Riohacha',
                'department_id' => 19,
            ],
            [
                'name' => 'Maicao',
                'department_id' => 19,
            ],
            [
                'name' => 'Santa Marta',
                'department_id' => 20,
            ],
            [
                'name' => 'Ciénaga',
                'department_id' => 20,
            ],
            [
                'name' => 'Villavicencio',
                'department_id' => 21,
            ],
            [
                'name' => 'Pasto',
                'department_id' => 22,
            ],
            [
                'name' => 'Ipiales',
                'department_id' => 22,
            ],
            [
                'name' => 'Tumaco',
                'department_id' => 22,
            ],
            [
                'name' => 'Cúcuta',
                'department_id' => 23,
            ],
            [
                'name' => 'Ocaña',
                'department_id' => 23,
            ],
            [
                'name' => 'Pamplona',
                'department_id' => 23,
            ],
            [
                'name' => 'Mocoa',
                'department_id' => 24,
            ],
            [
                'name' => 'Puerto Asís',
                'department_id' => 24,
            ],
            [
                'name' => 'Armenia',
                'department_id' => 25,
            ],
            [
                'name' => 'Pereira',
                'department_id' => 26,
            ],
            [
                'name' => 'San Andrés Isla',
                'department_id' => 27,
            ],
            [
                'name' => 'Bucaramanga',
                'department_id' => 28,
            ],
            [
                'name' => 'Barrancabermeja',
                'department_id' => 28,
            ],
            [
                'name' => 'San Gil',
                'department_id' => 28,
            ],
            [
                'name' => 'Sincelejo',
                'department_id' => 29,
            ],
            [
                'name' => 'Ibagué',
                'department_id' => 30,
            ],
            [
                'name' => 'El Espinal',
                'department_id' => 30,
            ],
            [
                'name' => 'Cali',
                'department_id' => 31,
            ],
            [
                'name' => 'Tuluá',
                'department_id' => 31,
            ],
            [
                'name' => 'Palmira',
                'department_id' => 31,
            ],
            [
                'name' => 'Buenaventura',
                'department_id' => 31,
            ],
            [
                'name' => 'Cartago',
                'department_id' => 31,
            ],
            [
                'name' => 'Buga',
                'department_id' => 31,
            ],
            [
                'name' => 'Mitú',
                'department_id' => 32,
            ],
            [
                'name' => 'Puerto Carreño',
                'department_id' => 33,
            ],
        ];
        City::insert($nodesData);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cities');
    }
};
