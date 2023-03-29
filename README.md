# feriados
Aplicación para obtener los días feriados (Bancarios) por año y/o mes

Métodos y enlaces para obtener la información de los feriados:

Obtener todos los días bancarios de todos los meses de todos los años registrados en el sistema

10.150.11.96:9012/controller/getFeriado.php?año=all

Salida en formato json:

{"2022":{"enero":["1","10","17"],"febrero":["28"],"marzo":[1,19],"abril":[14,15,19],"mayo":[1,30],"junio":[13,20,24],"julio":[4,5,24],"agosto":[15],"septiembre":[11],"octubre":[12,24],"noviembre":[1,21],"diciembre":[24,25,31]},"2023":{"enero":[1,9,14],"febrero":[20,21],"marzo":[19],"abril":["6","7","19"],"mayo":[1,22],"junio":[12,19,24],"julio":[3,5,24],"agosto":[11],"septiembre":[11],"octubre":[12,30],"noviembre":[6,18],"diciembre":[24,25,31]}}

Obtener los días bancarios de un año en específico:

10.150.11.96:9012/controller/getFeriado.php?año=2023

Salida en formato json:

{"2023":{"enero":[1,9,14],"febrero":[20,21],"marzo":[19],"abril":["6","7","19"],"mayo":[1,22],"junio":[12,19,24],"julio":[3,5,24],"agosto":[11],"septiembre":[11],"octubre":[12,30],"noviembre":[6,18],"diciembre":[24,25,31]}}

Obtener los días bancarios del mes de un año en particular:

10.150.11.96:9012/controller/getFeriado.php?año=2023&mes=08

Salida en formato json:

{"2023":{"agosto":[3,5,24]}}



