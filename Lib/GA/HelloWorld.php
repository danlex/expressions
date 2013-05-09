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
	protected $populationSize = 128;
	protected $target = 'Hello World!';
	

	protected function initPopulation(){
		for($i = 0; $i < $this->populationSize; $i ++){
			$this->population[$i] = new GA_HellorWorldMemeber($this->randomStr(strlen($this->target)));
		}
	}
	
	protected function selection(){
		for($i = 0; $i < $this->populationSize; $i ++){
            $this->population[$i]->setFitness($this->fitness($this->population[$i]));
        }

		usort($a, array("GA_HelloWorld", "compaireFitness"));
	}

	static function compaireFitness($a, $b)
    {
        f ($a->getFitness() == $b->getFitness()) {
            return 0;
        }
        return ($a->getFitness() > $b->getFitness()) ? +1 : -1;
    }

	protected function fitness($member){
		return levenshtein($this->target, $member->getGene());
	}

	protected function mutate(){

	}

	protected function crossover(){

	}

	protected function termination(){
		return true;
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
		$this->crossover();
		$this->nextGeneration();
	}

	function randomStr($length = 8) {
		$values = array_merge(range(32, 126));
		$max = count($values) - 1;
 		$str = chr(mt_rand(97, 122));
		for ($i = 1; $i < $length; $i++) {
			$str .= chr($values[mt_rand(0, $max)]);
  		}
  		return $str;
	}
}
