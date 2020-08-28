<?php

use Illuminate\Database\Seeder;

class MenusTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 
        DB::insert('INSERT INTO menus ' . 
        ' (id, type, orderlist, label, link, description, icon,  active, created_at, updated_at)
        VALUES 
        (1, 1, 1, "Usuario", "Usuario", "Ficha de Usuario", "perm_identity", "1", NULL, NULL),
        (5, 1, 2, "Opciones", "Menu", "", "list", "1", NULL, NULL),
        (15, 1, 3, "Permisos", "Profile", "Ficha de Permisos a Usuario", "chrome_reader_mode", "1", NULL, NULL),
        (27, 1, 4, "Pruebas", "Pruebas", "Plantilla para Pruebas", "", "1", NULL, NULL),
        (26, 1, 5, "Template", "Template", "Plantilla para Pruebas", "", "1", NULL, NULL),
        (43, 1, 6, "Testprint", "Testprnt", "Pruebas de impresión", "print", "1", NULL, NULL),
        (2, 2, 1, "Clientes", "Cliente", "Ficha de Clientes", "assignment_ind", "1", NULL, NULL),
        (3, 2, 3, "Pacientes", "Patients", "Ficha de Pacientes", "assignment_ind", "1", NULL, NULL),
        (24, 2, 9, "Medicos", "Doctors", "Ficha de Medicos", "person", "1", NULL, NULL),
        (28, 2, 10, "Compania", "Compania", "Ficha de Compañia", "settings_applications", "1", NULL, NULL),
        (30, 2, 11, "Catalogo", "Catalog", "Catalog Form", "", "1", NULL, NULL),
        (31, 2, 12, "Operadores", "Operator", "Ficha de Operadores", "perm_identity", "1", NULL, NULL),
        (32, 2, 13, "Gastos", "Expense", "Ficha de Gastos", "widgets", "1", NULL, NULL),
        (33, 2, 14, "Proveedores", "Provider", "Ficha de Proveedores", "assistant", "1", NULL, NULL),
        (35, 2, 15, "Referencia pag", "PayRefer", "Referencias de Pagos", "", "1", NULL, NULL),
        (38, 2, 16, "Punto de Carga", "Loadpnt", "Ficha punto de Carga", "album", "1", NULL, NULL),
        (29, 3, 1, "Remision", "Shipment", "Remision", "description", "1", NULL, NULL),
        (14, 3, 4, "Factura", "Invoice", "Factura", "assignment", "1", NULL, NULL),
        (34, 3, 5, "Meet", "Meet", "Ficha de Citas", "", "1", NULL, NULL),
        (37, 3, 6, "Combustible", "Loadfuel", "Registro Consumo Combustible", "ev_station", "1", NULL, NULL),
        (39, 3, 7, "Comisiones", "Commiss", "Tabla de comisiones", "playlist_add_check", "1", NULL, NULL),
        (40, 3, 8, "Prestamos", "Loans", "Registro de prestamos", "move_to_inbox", "1", NULL, NULL),
        (42, 3, 9, "Pago d Cargas", "Shiplodp", "Registro de pago acargas", "opacity", "1", NULL, NULL),
        (7, 4, 1, "Facturas", "Invoicej", "Consulta Facturas", "blur_linear", "1", NULL, NULL),
        (17, 4, 3, "Calendario", "Calendar", "Consulta de eventos", "", "1", NULL, NULL)
        ');
    }
}
