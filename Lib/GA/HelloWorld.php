<?php

/**
 * Genetic Algorithm Hello Word
 *
 * $1$
 * $Alexandru Dan <dan_lex@yahoo.com>$
 * $2012-07-22$
 *
 * @category   : Math Algorithms
 * @package    : Genetic Algorithm
 * @subpackage : Hello World
 * @copyright  : Copyright (C) 2013, Alexandru Dan
 * @author     : Alexandru Dan <dan_lex@yahoo.com>
 * @version    : $1$
 */
class GA_HelloWorld extends GA_GAAbstract {

	protected $population = NULL;
	protected $populationSize = 100;
	protected $populationIncrement = 50;
	protected $target = 'Hello World!';
	protected $generations = 0;
	protected $maxGenerations = 1000;
	

	protected function initPopulation(){
		for($i = 0; $i < $this->populationSize; $i ++){
			$randomGene = $this->randomStr(strlen($this->target));
			$this->population[$i] = new GA_HelloWorldMember($randomGene);
		}
		$this->generations = 0;
	}
	
	protected function selection(){
		for($i = 0; $i < $this->populationSize; $i ++){
            $this->population[$i]->computeFitness($this->target);
        }

		usort($this->population, array("GA_HelloWorld", "compaireFitness"));

		$populationIncremenBuffer = array();
		for ($i = 0; $i < $this->populationIncrement; $i++){
			$this->population[count($this->population) - 1 - $i] = $this->crossover($this->population[$i], $this->population[$i+1]);
			$this->mutate($this->population[count($this->population) - 1 - $i]);
		}
		
		for($i = 0; $i < 1; $i++){
			echo ($this->generations.'|'.$this->population[$i]->getFitness().'|'.$this->population[$i]->getGene().PHP_EOL);
		}
	}

	static function compaireFitness($a, $b)
    {
        if ($a->getFitness() == $b->getFitness()) {
            return 0;
        }
        return ($a->getFitness() > $b->getFitness()) ? +1 : -1;
    }

	protected function mutate($memberZ){
		$geneZ = $memberZ->getGene();
		$randomIndex = rand(0, strlen($this->target)-1);
		$literalZ = $geneZ[$randomIndex];
		$ordLiteralZIncrement = ord($literalZ) + rand(-1, 1);
		if (!($ordLiteralZIncrement >= 32 && $ordLiteralZIncrement <= 126)){
			$ordLiteralZIncrement = rand(32, 126);
		}
		$geneZ[$randomIndex] = chr($ordLiteralZIncrement);
		$memberZ->setGene($geneZ);
	}

	protected function crossover($memberX, $memberY){
		$geneX = $memberX->getGene();
		$geneY = $memberY->getGene();
		$geneZ = '';

		$randomIndex = rand(0, strlen($this->target)-1);
		for($i = 0; $i < $randomIndex; $i ++){
			$geneZ .= $geneX[$i];
		}

		for($i = $randomIndex; $i < strlen($this->target); $i ++){
            $geneZ .= $geneY[$i];
        }

		$memberZ = new GA_HelloWorldMember($geneZ);
		return $memberZ;
	}

	protected function termination(){
		$this->generations ++;
		if ($this->generations > $this->maxGenerations){
			return true;
		}
		if($this->population[0]->getFitness() === 0){
			return true;
		}
		return false;
	}

	public function main(){
		$this->initPopulation();
		$this->nextGeneration();
	}

	protected function nextGeneration(){	
		$this->selection();
		if($this->termination()){
			return;
		}
		$this->nextGeneration();
	}

	function randomStr($length = 8) {
		$values = array_merge(range(32, 126));
		$max = count($values) - 1;
 		$str = '';
		for ($i = 0; $i < $length; $i++) {
			$str .= chr($values[mt_rand(0, $max)]);
  		}
  		return $str;
	}
}
