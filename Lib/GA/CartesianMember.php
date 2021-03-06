<?php

/**
 * Cartesian Member Genetic Algorithm
 *
 * $1$
 * $Alexandru Dan <dan_lex@yahoo.com>$
 * $2013-05-17$
 *
 * @category   : Math Algorithms
 * @package    : Genetic Algorithm
 * @subpackage : Cartesian
 * @copyright  : Copyright (C) 2013, Alexandru Dan
 * @author     : Alexandru Dan <dan_lex@yahoo.com>
 * @version    : $1$
 */
class GA_CartesianMember
{
    protected $input = NULL;
    protected $output = NULL;

    protected $fitness = NULL;
    protected $gene = NULL;
    protected $geneCount = NULL;
    protected $mutateCount = 90;

	protected $nodeCount = 16;
    protected $inputCount = 3;
    protected $inputSamplesCount = 10;
    protected $outputCount = 1;

    protected $operatorCount = 10;

    public function __construct()
    {
    }

    public function setGene($value)
    {
        $this->gene = $value;
        $this->geneCount = count($value);

        return $this;
    }

    public function getGene()
    {
        return $this->gene;
    }

    public function setGeneCount($value)
    {
        $this->geneCount = $value;

        return $this;
    }

    public function getGeneCount()
    {
        return $this->geneCount;
    }

    public function getMutateCount()
    {
        return $this->mutateCount;
    }

    public function setInput($value)
    {
        $this->input = $value;

        return $this;
    }

    public function getInput()
    {
        return $this->input;
    }

    public function setOutput($value)
    {
        $this->output = $value;

        return $this;
    }

    public function getOutput()
    {
        return $this->output;
    }

	public function getNodeCount()
	{
		return $this->nodeCount;
	}

    public function getInputCount()
    {
        return $this->inputCount;
    }

    public function getInputSamplesCount()
    {
        return $this->inputSamplesCount;
    }

    public function getOutputCount()
    {
        return $this->outputCount;
    }

    public function getOperatorCount()
    {
        return $this->operatorCount;
    }

    /**
    * Generate random cartesian gene
    * array(
    * 	2 => array(0, 0, 0),
    *   3 => array(0, 0, 2),
    *   4 => array(3, 2, 1),
    *   5 => array(0, 4, 8)
    * );
    */
    public function setRandomGene($geneConfig = null)
    {
        $randomGene = array();
        $crtMapCount = $this->getOperatorCount();
        $startIndex = $this->getInputCount();
        for ($i = 0; $i < $this->getNodeCount(); $i ++) {
        	$randomIndex = $startIndex + $i;
            /** first input */
            $randomGene[$randomIndex][0] = rand(0, $randomIndex - 1);
            /** second input */
            $randomGene[$randomIndex][1] = rand(0, $randomIndex - 1);
            /** operator */
            $randomGene[$randomIndex][2] = rand(0, $crtMapCount - 1);
        }
        $this->setGene($randomGene);

        return $this;
    }
    /**
    * $input = array(
    *				array(12, 11),
    *				array(17, 23)
    *		   )
    */
    public function setRandomInput()
    {
        $input = array();
        for ($i = 0; $i < $this->getInputSamplesCount(); $i++) {
			for ($j = 0; $j < $this->getInputCount(); $j ++)
            $input[$i][$j] = rand(0, 100);
        }
        $this->setInput($input);

        return $this;
    }

    public function setFitness($value)
    {
        $this->fitness = $value;

        return $this;
    }

    public function getFitness()
    {
        return $this->fitness;
    }

    public function computeFitness($population = NULL)
    {
        $fitness = 0;
        foreach ($this->getInput() as $input) {
            $min = $input[0];
            for ($i = 0; $i < $this->getInputCount(); $i ++) {
                if ($min > $input[$i]) {
                    $min = $input[$i];
                }
            }
            $this->computeOutput($input);
            $fitness += pow($this->getOutput() - $min, 2);
        }

        $this->setFitness($fitness);

        return $this;
    }

    public function mutate()
    {
        for ($i = 0; $i < $this->getMutateCount(); $i ++) {
            $crtMapCount = $this->getOperatorCount();
            $startIndex = $this->getInputCount();
            $randomIndex = $startIndex + rand(0, $this->getGeneCount()-1);
            /** first input */
            $this->gene[$randomIndex][0] = rand(0, $randomIndex - 1);
            /** second input */
            $this->gene[$randomIndex][1] = rand(0, $randomIndex - 1);
            /** operator */
            $this->gene[$randomIndex][2] = rand(0, $crtMapCount - 1);
        }

        return $this;
    }

    public function crossover($memberY)
    {
        $geneX = $this->getGene();
        $geneY = $memberY->getGene();
        $geneZ = array();
        $startIndex = $this->getInputCount();
        $randomIndex = $startIndex + rand(0, $this->getGeneCount() - 1);
        for ($i = $startIndex; $i < $randomIndex; $i ++) {
            $geneZ[$i] = $geneX[$i];
        }

        for ($i = $randomIndex; $i < $startIndex + $this->getGeneCount(); $i ++) {
            $geneZ[$i] = $geneY[$i];
        }
        $memberZ = new GA_CartesianMember();
        $memberZ->setGene($geneZ);
        $memberZ->setInput($this->getInput());
        return $memberZ;
    }

    public function computeOutput($input = NULL, $debug = false)
    {
        foreach ($this->getGene() as $index => $node) {
            $functionName = 'crt'.$node[2];
            $input[$index] = $this->$functionName($input[$node[0]], $input[$node[1]]);
            if ($debug) {
                echo ($index . '|' .$this->operatorMap($node[2]) . '($input['.$node[0].'], $input['.$node[1].']) = '.$input[$index].PHP_EOL);
            }
        }
        $this->setOutput($input[count($input) - 1]);

        return $this;
    }

    public function operatorMap($index)
    {
        $operatorMap = array(0=>'+', 1=>'-', 2=>'*', 3=>'/', 4=>'>', 5=>'<', 6=>'abs(a-b)', 7=>'mean', 8=>'1', 9=>'-1', 10=>0);
        if (isset($operatorMap[$index])) {
            return $operatorMap[$index];
        } else {
            throw new Exception('Wrong CRT');
        }
    }

    /**
    * Sum binar operator
    * @var int $a
    * @var int $b
    */
    protected function crt0($a, $b)
    {
        return $a + $b;
    }

    /**
    * Minus binar operator
    */
    protected function crt1($a, $b)
    {
        return $a - $b;
    }

    protected function crt2($a, $b)
    {
        return $a * $b;
    }

    protected function crt3($a, $b)
    {
        return ($b != 0) ? $a / $b:$a;
    }

    protected function crt4($a, $b)
    {
        return ($a == $b)?0:($a > $b)?1:-1;
    }

    protected function crt5($a, $b)
    {
        return ($a == $b)?0:($a < $b)?1:-1;
    }

    /**
    * abs(a-b) function
    */
    protected function crt6($a, $b)
    {
        return ($a-$b > 0) ? $a- $b : $b - $a;
    }

    /**
    * mean function
    */
    protected function crt7($a, $b)
    {
        return ($a + $b) / 2;
    }

    protected function crt8($a, $b)
    {
        return 1;
    }

    protected function crt9($a, $b)
    {
        return -1;
    }

    protected function crt10($a, $b)
    {
        return 0;
    }

    /**
    * if function
    */
    protected function crt20($a, $b, $c)
    {
        return $a?$b:$c;
    }
}
