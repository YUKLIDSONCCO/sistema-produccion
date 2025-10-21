<?php
class InventarioController
{
    // Acción principal del inventario (vista general)
    public function index()
    {
        require_once 'views/jefeplanta/modulos-jefeplanta/inventario/bpa1';
    }

    // Acción específica para el formato BPA-1
    public function bpa1()
    {
        require_once 'views/jefeplanta/modulos-jefeplanta/inventario/bpa1';
    }

    // Acción para guardar los datos del formulario BPA-1
    public function guardarBpa1()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            echo "
            <div style='text-align:center; font-family:Poppins; margin-top:60px;'>
                <h2 style='color:green;'>✅ Formato BPA N°01 registrado correctamente</h2>
                <a href='index.php?controller=Inventario&action=bpa1' 
                   style='display:inline-block; margin-top:20px; padding:10px 20px; background:#1e88e5; color:#fff; text-decoration:none; border-radius:5px;'>
                   ⬅ Volver al Formato BPA-1
                </a>
            </div>";
        } else {
            echo "<p style='text-align:center; color:red;'>Error: No se recibieron datos del formulario.</p>";
        }
    }
}
