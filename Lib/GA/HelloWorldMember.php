<?php

class GA_HelloWorldMember {
	protected $fitness = NULL;
	protected $gene = NULL;

	public function __construct($gene, $fitness = NULL){
		$this->setGene($gene);
		if (!is_null($fitness)){
			$this->setFitness($fitness);
		}
	}

	public function setGene($value){
		$this->gene = $value;
	}

	public function getGene(){
		return $this->gene;
	}

	public function setFitness($value){
		$this->fitness = $value;
	}

	public function getFitness(){
		return $this->fitness;
	}

	public function computeFitness($target){
		$this->fitness = 0;
		for($i = 0; $i < strlen($target); $i ++){
			$this->fitness += pow(ord($target[$i]) - ord($this->gene[$i]), 2);
		}
		return $this;
	}
}
