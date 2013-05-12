<?php

class GA_HelloWorldMember
{
    protected $fitness = NULL;
    protected $gene = NULL;
    protected $geneSize = NULL;

    public function __construct()
    {
    }

    public function setGene($value)
    {
        $this->gene = $value;
        $this->geneSize = strlen($value);

        return $this;
    }

    public function getGene()
    {
        return $this->gene;
    }

    public function setGeneSize($value)
    {
        $this->geneSize = $value;
    }

    public function getGeneSize()
    {
        return $this->geneSize;
    }

    public function setRandomGene($geneConfig)
    {
        $this->setGene($this->randomStr($geneConfig['length']));

        return $this;
    }

    public function randomStr($length = 8)
    {
        $values = array_merge(range(32, 126));
        $max = count($values) - 1;
        $str = '';
        for ($i = 0; $i < $length; $i++) {
            $str .= chr($values[mt_rand(0, $max)]);
        }

        return $str;
    }

    public function setFitness($value)
    {
        $this->fitness = $value;
    }

    public function getFitness()
    {
        return $this->fitness;
    }

    public function computeFitness($target)
    {
        $this->fitness = 0;
        for ($i = 0; $i < strlen($target); $i ++) {
            $this->fitness += pow(ord($target[$i]) - ord($this->gene[$i]), 2);
        }

        return $this;
    }

    public function mutate()
    {
        $randomIndex = rand(0, strlen($this->gene)-1);
        $literal = $this->gene[$randomIndex];
        $ordLiteralIncrement = ord($literal) + rand(-1, 1);
        $this->gene[$randomIndex] = chr($ordLiteralIncrement);

        return $this;
    }

    public function crossover($memberY)
    {
        $geneX = $this->getGene();
        $geneY = $memberY->getGene();
        $geneZ = '';

        $randomIndex = rand(0, $this->geneSize - 1);
        for ($i = 0; $i < $randomIndex; $i ++) {
            $geneZ .= $geneX[$i];
        }

        for ($i = $randomIndex; $i < $this->geneSize; $i ++) {
            $geneZ .= $geneY[$i];
        }

        $memberZ = new GA_HelloWorldMember();
        $memberZ->setGene($geneZ);

        return $memberZ;
    }
}
