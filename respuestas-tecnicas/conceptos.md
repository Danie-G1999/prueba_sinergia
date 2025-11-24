## A. ¿Qué es una variable?

Una variable es básicamente una "cajita" donde guardamos información dentro de un programa.  
Esa cajita tiene un nombre para poder identificarla, y dentro puede tener diferentes tipos de datos: números, texto, booleanos, objetos, etc.

En programación la usamos cuando necesitamos almacenar un valor que probablemente va a cambiar mientras el programa se ejecuta. Por ejemplo, un contador, el nombre del usuario o el total de un carrito.

```javascript
let nombre = "Carlos";
let edad = 25;
```


## B. ¿Qué es un ciclo?

Un ciclo (o bucle) es una forma de decirle al programa:
"Repite esto varias veces hasta que se cumpla cierta condición."

### Ciclo For
Sirve cuando ya sabemos cuántas veces queremos repetir algo

```javascript
for (let i = 0; i < 3; i++) {
    console.log("Hola");
}
```


### Ciclo while
Sirve cuando queremos repetir algo hasta que deje de cumplirse una condición.

```javascript
let x = 0;
while (x < 3) {
    console.log("Hola");
    x++;
}
```

## C. ¿Qué es un condicional?

Un condicional es simplemente una forma de tomar decisiones dentro del código.

Es como decir:
"Si pasa esto, haz esto otro; si no, entonces haz una alternativa."

```javascript
let temperatura = 30;

if (temperatura > 25) {
    console.log("Hace calor");
} else {
    console.log("Hace frío");
}
```

## D. En el caso de un estudiante, cuando mencionamos su nombre, edad, sexo, dirección y teléfono, estamos mencionando:

Los atributos de una clase


## E. ¿Qué es la Programación Orientada a Objetos (POO)?

La Programación Orientada a Objetos (POO) es un paradigma que organiza el código usando **objetos**, los cuales representan cosas del mundo real o conceptos del sistema.  
Cada objeto combina **atributos** (datos) y **métodos** (comportamiento).

## F. ¿Qué son patrones de diseño y para qué se pueden utilizar?

Los **patrones de diseño** son soluciones ya probadas y documentadas que resuelven problemas comunes en el desarrollo  
No son código listo para copiar y pegar, sino **guías o modelos** que ayudan a organizar mejor la arquitectura del desarrollo actual

## G. ¿Cuál operador condicional de PHP evalúa que los valores son iguales **y del mismo tipo de datos**?

La respuesta correcta es:

### **`===`**

## H. Desde un punto de vista booleano, cada valor de cero o string vacío en PHP se considera:

False

## I. De la siguiente estructura escriba el resultado final de la variable $c:

```php
$a = 1;
$b = 9;
for ( $i = $a; $i &lt;= $b; $i = $i+1){
$c = $a + $i;
}
echo $c;
```

El resultado final es 10

## J. De la siguiente estructura escriba el resultado final de la variable $c:

```php
$b = 1;
$c = 0;
while $b &lt; 11 {
$c = $c + 1;
$b = $b + 1;
}
echo $c;
```

La respuesta final es 10

## K. De la siguiente estructura escriba el resultado final de la variable $print:

```php
$a = 5;
$b = 6;
$x = 8;
$c = 20;
$print = "";

if ($a <= $b and $b >= $c) {
    if ($x <= $c and $c >= 10) {
        $print = "Feliz Navidad";
    }
} else {
    if ($c > $x or $x <= $b) {
        $print = "Feliz Año";
    }
}

echo $print;
```