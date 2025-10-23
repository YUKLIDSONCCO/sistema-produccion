<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CORAQUA BPA 10 - Muestreo</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f9f9f9;
      margin: 0;
      padding: 0;
    }

    .container {
      background: #fff;
      max-width: 1200px;
      margin: 30px auto;
      padding: 20px 30px;
      border: 1px solid #ccc;
      border-radius: 8px;
    }

    header {
      display: flex;
      justify-content: space-between;
      align-items: flex-start;
      flex-wrap: wrap;
      margin-bottom: 20px;
    }

    header .logo img {
      width: 80px;
    }

    header .info {
      text-align: center;
      flex: 1;
    }

    header .info h2 {
      margin: 0;
      font-size: 16px;
    }

    header .info h3 {
      margin: 5px 0 0;
      font-size: 14px;
    }

    header .details {
      font-size: 13px;
      border: 1px solid #ccc;
      padding: 8px 12px;
      border-radius: 4px;
      background: #f4f4f4;
    }

    .meta {
      display: flex;
      flex-wrap: wrap;
      justify-content: space-between;
      font-size: 14px;
      margin-bottom: 15px;
    }

    .meta div {
      flex: 1 1 45%;
      margin-bottom: 8px;
    }

    .table-container {
      overflow-x: auto;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      min-width: 800px;
    }

    th, td {
      border: 1px solid #555;
      text-align: center;
      padding: 6px;
      font-size: 13px;
    }

    th {
      background: #e6e6e6;
    }

    input[type="text"], input[type="number"], input[type="date"], input[type="time"] {
      width: 100%;
      box-sizing: border-box;
      padding: 4px;
      border: 1px solid #aaa;
      border-radius: 3px;
    }

    button {
      margin-top: 15px;
      padding: 8px 16px;
      background: #007bff;
      border: none;
      color: white;
      border-radius: 4px;
      cursor: pointer;
    }

    button:hover {
      background: #0056b3;
    }
  </style>
</head>
<body>
  <div class="container">
    <header>
      <div class="logo">
        <img src="/ruta/a/logo_coraqua.png" alt="Logo Coraqua">
      </div>

      <div class="info">
        <h2>FORMATO N°10</h2>
        <h3>MUESTREO</h3>
      </div>

      <div class="details">
        <p><strong>CÓDIGO:</strong> CORAQUA BPA 10</p>
        <p><strong>VERSIÓN:</strong> 2.0</p>
        <p><strong>FECHA:</strong> 03/08/2020</p>
      </div>
    </header>

    <div class="meta">
      <div><strong>Encargado:</strong> <input type="text" name="encargado"></div>
      <div><strong>Sede:</strong> <input type="text" name="sede"></div>
      <div><strong>Fecha:</strong> <input type="date" name="fecha"></div>
      <div><strong>Hora:</strong> <input type="time" name="hora"></div>
    </div>

    <div class="table-container">
      <table>
        <thead>
          <tr>
            <th>UP:</th>
            <th>Peso</th>
            <th>UP:</th>
            <th>Peso</th>
            <th>UP:</th>
            <th>Peso</th>
            <th>UP:</th>
            <th>Peso</th>
            <th>Long.</th>
          </tr>
        </thead>
        <tbody>
          <!-- Ejemplo de 10 filas -->
          <tr>
            <td>1</td><td><input type="number" name="p1_1"></td>
            <td>1</td><td><input type="number" name="p2_1"></td>
            <td>1</td><td><input type="number" name="p3_1"></td>
            <td>1</td><td><input type="number" name="p4_1"></td>
            <td><input type="number" name="l1"></td>
          </tr>
          <tr>
            <td>2</td><td><input type="number" name="p1_2"></td>
            <td>2</td><td><input type="number" name="p2_2"></td>
            <td>2</td><td><input type="number" name="p3_2"></td>
            <td>2</td><td><input type="number" name="p4_2"></td>
            <td><input type="number" name="l2"></td>
          </tr>
          <tr>
            <td>3</td><td><input type="number" name="p1_3"></td>
            <td>3</td><td><input type="number" name="p2_3"></td>
            <td>3</td><td><input type="number" name="p3_3"></td>
            <td>3</td><td><input type="number" name="p4_3"></td>
            <td><input type="number" name="l3"></td>
          </tr>
          <!-- Agrega más filas según sea necesario -->
        </tbody>
      </table>
    </div>

    <button type="submit">Guardar</button>
  </div>
</body>
</html>
