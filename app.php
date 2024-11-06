<?php

$output = [];
$return_var = null;
exec('php -d extension=mysqli vendor/bin/phpunit --testdox --color=always tests', $output, $return_var);

$output_str = implode("\n", $output);
echo $output_str . "\n";

if ($return_var === 0) {

    echo "\nTodos los tests pasaron. Abriendo la vista...\n";
    $url = 'http://localhost/Online-Doctor-Appointment-System/';
    shell_exec("start $url");

} else {
    echo "\nAlgunos tests fallaron. Revisa los resultados.\n";
}
