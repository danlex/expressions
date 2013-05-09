<?php

class GA_HelloWorldMember {
	protected $fitness = NULL;
	protected $gene = NULL;

	public function __constuct($gene, $fitness = NULL){
		$this->setGene($gene);
		if (!is_null($fitness){
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
		return $fitness;
	}
}
