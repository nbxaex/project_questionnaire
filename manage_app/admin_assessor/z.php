<?php
$rand_integers = rand(0, 9999999);
$picture = 'assessor_' . $rand_integers . '_' . date('Ymd') . date("His") . '_181x174.jpg';
echo $picture;
