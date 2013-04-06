##Expressions

<pre>
$str = '(10 + 20) + (1 + 3 * 2 / (1+1))';
$strPostfix = $evaluator->getConvertor()->strInfixToStrPostfix($str);
echo($evaluator->evaluateStrPostfix($strPostfix));
$expressionTree = $evaluator->getConvertor()->strInfixToExpressionTree($str);
echo ($evaluator->evaluateExpressionTree($expressionTree));
</pre>

##QuickSort
<pre>
$unsortedArray = array(4, 2, 2, 1, 3, 7, 3, 9, 5);
$sortInstance = Sort_QuickSort::getInstance();
$sortArray = $sortInstance->sort($unsortedArray);
</pre>

##Tests
To run one test
<pre>
$ cd Tests
$ phpunit --configuration phpunit.xml Unit/Lib/Sort/QuickSortTest
</pre>

or to run the Sort test suit

<pre>
$ cd Tests
$ phpunit --configuration phpunit-sort-suite.xml
</pre>
