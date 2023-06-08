<?php

use App\Models\Department;
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
        Schema::create('departments', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('capital');
            $table->timestamps();
        });

        $nodesData = [
            [
                'name' => 'Amazonas',
                'capital' => 'Leticia',
            ],
            [
                'name' => 'Antioquia',
                'capital' => 'Medellín',
            ],
            [
                'name' => 'Arauca',
                'capital' => 'Arauca',
            ],
            [
                'name' => 'Atlántico',
                'capital' => 'Barranquilla',
            ],
            [
                'name' => 'Bogotá',
                'capital' => 'Bogotá',
            ],
            [
                'name' => 'Bolívar',
                'capital' => 'Cartagena de Indias',
            ],
            [
                'name' => 'Boyacá',
                'capital' => 'Tunja',
            ],
            [
                'name' => 'Caldas',
                'capital' => 'Manizales',
            ],
            [
                'name' => 'Caquetá',
                'capital' => 'Florencia',
            ],
            [
                'name' => 'Casanare',
                'capital' => 'Yopal',
            ],
            [
                'name' => 'Cauca',
                'capital' => 'Popayán',
            ],
            [
                'name' => 'Cesar',
                'capital' => 'Valledupar',
            ],
            [
                'name' => 'Chocó',
                'capital' => 'Quibdó',
            ],
            [
                'name' => 'Córdoba',
                'capital' => 'Montería',
            ],
            [
                'name' => 'Cundinamarca',
                'capital' => 'Bogotá',
            ],
            [
                'name' => 'Guainía',
                'capital' => 'Inírida',
            ],
            [
                'name' => 'Guaviare',
                'capital' => 'San José del Guaviare',
            ],
            [
                'name' => 'Huila',
                'capital' => 'Neiva',
            ],
            [
                'name' => 'La Guajira',
                'capital' => 'Riohacha',
            ],
            [
                'name' => 'Magdalena',
                'capital' => 'Santa Marta',
            ],
            [
                'name' => 'Meta',
                'capital' => 'Villavicencio',
            ],
            [
                'name' => 'Nariño',
                'capital' => 'Pasto',
            ],
            [
                'name' => 'Norte de Santander',
                'capital' => 'San José de Cúcuta',
            ],
            [
                'name' => 'Putumayo',
                'capital' => 'Mocoa',
            ],
            [
                'name' => 'Quindío',
                'capital' => 'Armenia',
            ],
            [
                'name' => 'Risaralda',
                'capital' => '	Pereira',
            ],
            [
                'name' => 'San Andrés y Providencia',
                'capital' => 'San Andrés',
            ],
            [
                'name' => 'Santander',
                'capital' => 'Bucaramanga',
            ],
            [
                'name' => 'Sucre',
                'capital' => 'Sincelejo',
            ],
            [
                'name' => 'Tolima',
                'capital' => 'Ibagué',
            ],
            [
                'name' => 'Valle del Cauca',
                'capital' => 'Cali',
            ],
            [
                'name' => 'Vaupés',
                'capital' => '	Mitú',
            ],
            [
                'name' => 'Vichada',
                'capital' => 'Puerto Carreño',
            ],
        ];
        Department::insert($nodesData);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('departments');
    }
};
