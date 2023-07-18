<?php
header('Content-Type: application/csv');
header('Content-Disposition: attachment; filename=multipliers_template.csv');
header('Pragma: no-cache');
readfile("docs/multipliers_template.csv");
?>