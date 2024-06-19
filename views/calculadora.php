<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora PHP V2.0</title>
    <link rel="stylesheet" href="../styles/styles.css">
</head>
<body>




    <div class="calculator">

        <h2>Francisco Eduardo Pérez Sántiz</h2>
        <h2>9o A</h2>


        <h1>Calculadora</h1>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <input type="number" name="valor1" placeholder="Valor 1" required>
            <input type="number" name="valor2" placeholder="Valor 2" required>
            <button type="submit" name="operacion" value="sumar" id="sumar">Sumar</button>
            <button type="submit" name="operacion" value="restar" id="restar">Restar</button>
            <button type="submit" name="operacion" value="multiplicar" id="multiplicar">Multiplicar</button>
        </form>

        <?php


        // Inicialización de variables
        $resultado = $error = "";

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $valor1 = $_POST["valor1"];
            $valor2 = $_POST["valor2"];
            $operacion = $_POST["operacion"];

            // Validación y sanitización
            if (filter_var($valor1, FILTER_VALIDATE_FLOAT) === false || filter_var($valor2, FILTER_VALIDATE_FLOAT) === false) {
                $error = "Por favor, ingrese valores numéricos válidos.";
                log_error("Error de validación: valores no numéricos ingresados.");
            } else {
                // Realizar la operación
                if ($operacion == "sumar") {
                    $resultado = $valor1 + $valor2;
                    log_operacion("Suma: $valor1 + $valor2 = $resultado");
                } elseif ($operacion == "restar") {
                    $resultado = $valor1 - $valor2;
                    log_operacion("Resta: $valor1 - $valor2 = $resultado");
                } elseif($operacion == "multiplicar"){
                    $resultado = $valor1 * $valor2;
                    log_operacion("Multiplicación: $valor1 * $valor2 = $resultado");
                }
            }
        }

        // Funciones de logging
        function log_error($mensaje) {
            $log = fopen("../logs/logs.txt", "a");
            fwrite($log, date("Y-m-d H:i:s") . " - ERROR: $mensaje" . PHP_EOL);
            fclose($log);
        }

        function log_operacion($mensaje) {
            $log = fopen("../logs/logs.txt", "a");
            fwrite($log, date("Y-m-d H:i:s") . " - OPERACIÓN: $mensaje" . PHP_EOL);
            fclose($log);
        }
        ?>

        <!-- Mostrar resultados o errores -->
        <?php if ($error): ?>
            <div class="error"><?php echo $error; ?></div>
        <?php elseif ($resultado !== ""): ?>
            <div class="result">Resultado: <?php echo $resultado; ?></div>
        <?php endif; ?>
    </div>
</body>
</html>
