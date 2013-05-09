<?php

abstract class GA_GAAbstract
{
	abstract protected function initPopulation();
	abstract protected function selection();
	abstract protected function fitness();
	abstract protected function mutate();
	abstract protected function crossover(); 
}
