# l anguage: es

Feature: : Suma de dos número
  Yo quiero sumar dos sifras
  para verficar si se sumar

Scenario Outline: Sumar dos numeros
  Given que tengo el objeto sumador
  When ingreso los numero <x> y <y>
  Then el resultado debe ser <suma>

  Examples:
    | x  | y | suma |
    | 1  | 3 |  4   |
    | -5 | -2|  -7  |
    | -5 | 10|  5   |
