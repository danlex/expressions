<?php

/**
 * Cartesian Genetic Algorithm
 *
 * $1$
 * $Alexandru Dan <dan_lex@yahoo.com>$
 * $2012-07-22$
 *
 * @category   : Math Algorithms
 * @package    : Genetic Algorithm
 * @subpackage : Cartesian
 * @copyright  : Copyright (C) 2013, Alexandru Dan
 * @author     : Alexandru Dan <dan_lex@yahoo.com>
 * @version    : $1$
 */
class GA_Cartesian
{
    protected $population = NULL;
    protected $populationSize = 1000;
    protected $populationIncrement = 900;
    protected $populationMaxMutate = 900;
    protected $generations = 0;
    protected $maxGenerations = 10000;

    public function setPopulationSize($value)
    {
        $this->populationSize = $value;

        return $this;
    }

    public function setPopulationIncrement($value)
    {
        $this->populationIncrement = $value;

        return $this;
    }

    public function setPopulationMaxMutate($value)
    {
        $this->populationMaxMutate = $value;

        return $this;
    }

    protected function initPopulation()
    {
        for ($i = 0; $i < $this->populationSize; $i ++) {
            $this->population[$i] = new GA_CartesianMember();
            $this->population[$i]->setRandomGene();
            if ($i == 0) {
                $this->population[$i]->setRandomInput();
            } else {
                $this->population[$i]->setInput($this->population[0]->getInput());
            }
        }
        $this->generations = 0;
    }

    protected function selection()
    {
        for ($i = 0; $i < $this->populationSize; $i ++) {
            $this->population[$i]->computeFitness($this);
        }

        usort($this->population, array("GA_Cartesian", "compaireFitness"));

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
            echo ($this->generations.'|'.$this->population[$i]->getFitness().PHP_EOL);
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
        if ($this->generations > $this->maxGenerations || ((int) $this->population[0]->getFitness()) === 0) {
            $input = $this->population[0]->getInput();
            foreach ($this->population[0]->getInput() as $input) {
                print_p($input);
                $this->population[0]->computeOutput($input, true);
            }

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
