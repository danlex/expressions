<?php
error_reporting (E_ALL);
include 'Config/load.php';


$ga = new GA_HelloWorld();
$ga->main();

die();
//Histogram sort example
$unsortedArray = array(4, 2, 2, 1, 3, 7, 3, 9, 5);
$sortInstance = Sort_Histogram::getInstance();
$sortedArray = $sortInstance->sort($unsortedArray);
print_r($sortedArray);
die();
//Expression example:
$evaluator = Expression_Evaluator::getInstance();
$str = '(10 + 20) + (1 + 3 * 2 / (1+1))';
$strPostfix = $evaluator->getConvertor()->strInfixToStrPostfix($str);
echo ("\n".$str."\n");
echo ("\n".$strPostfix."\n");
echo($evaluator->evaluateStrPostfix($strPostfix));
echo(' === ');
eval('$x = '.$str.';');
echo ($x);
$expressionTree = $evaluator->getConvertor()->strInfixToExpressionTree($str);
echo(' === ');
echo ($evaluator->evaluateExpressionTree($expressionTree));
echo ("\n");
