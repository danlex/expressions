<?php

abstract class GA_GAAbstract
{
	abstract protected function initPopulation();
	abstract protected function selection();
	abstract protected function mutate($memberZ);
	abstract protected function crossover($memberX, $memberY); 
}
