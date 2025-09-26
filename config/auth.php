<?php
// Configuración de autenticación
return [
    // Tiempo de sesión en segundos (ejemplo: 1 hora)
    'session_lifetime' => 3600,

    // Roles permitidos en el sistema
    'roles' => [
        'admin',
        'jefeplanta',
        'supervisor',
        'colaborador'
    ]
];
