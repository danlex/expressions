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
class GA_HelloWorld
{
    protected $population = NULL;
    protected $populationSize = 1000;
    protected $populationIncrement = 900;
    protected $populationMaxMutate = 900;
    protected $target = 'Hello World!';
    protected $generations = 0;
    protected $maxGenerations = 1000;

    protected function initPopulation()
    {
        for ($i = 0; $i < $this->populationSize; $i ++) {
            $this->population[$i] = new GA_HelloWorldMember();
            $this->population[$i]->setRandomGene(array('length'=>strlen($this->target)));
        }
        $this->generations = 0;
    }

    protected function selection()
    {
        for ($i = 0; $i < $this->populationSize; $i ++) {
            $this->population[$i]->computeFitness($this->target);
        }

        usort($this->population, array("GA_HelloWorld", "compaireFitness"));

        $populationMutate = 0;
        for ($i = 0; $i < $this->populationIncrement; $i++) {
            $newMember = $this->population[$i]->crossover($this->population[$i+1]);
            if ($populationMutate < $this->populationMaxMutate) {
                $newMember->mutate();
                $populationMutate ++;
            }
            $this->population[count($this->population) - 1 - $i] = $newMember;
        }

        for ($i = 0; $i < 1; $i++) {
            echo ($this->generations.'|'.$this->population[$i]->getFitness().'|'.$this->population[$i]->getGene().PHP_EOL);
        }
    }

    public static function compaireFitness($a, $b)
    {
        if ($a->getFitness() == $b->getFitness()) {
            return 0;
        }

        return ($a->getFitness() > $b->getFitness()) ? +1 : -1;
    }

    protected function termination()
    {
        $this->generations ++;
        if ($this->generations > $this->maxGenerations) {
            return true;
        }
        if ($this->population[0]->getFitness() === 0) {
            return true;
        }

        return false;
    }

    public function main()
    {
        $this->initPopulation();
        $this->nextGeneration();
    }

    protected function nextGeneration()
    {
        $this->selection();
        if ($this->termination()) {
            return;
        }
        $this->nextGeneration();
    }
}
