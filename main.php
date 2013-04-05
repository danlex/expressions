<?php
error_reporting (E_ALL);
include 'Config/load.php';

//Sort example:
$array = array(4, 2, 2, 1, 3, 7, 3, 9, 5);
echo ("\nBefore sort:\n");
print_r($array);
$sortInstance = Sort_QuickSort::getInstance();
$array = $sortInstance->sort($array);
echo ("\nAfter sort:\n");
print_r($array);

die();

//Sort example:
$array = array(4, 2, 2, 1, 3, 7, 3, 9, 5);
echo ("\nBefore sort:\n");
print_r($array);
$sortInstance = Sort_BinaryTree::getInstance();
$array = $sortInstance->sort($array);
echo ("\nAfter sort:\n");
print_r($array);

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
