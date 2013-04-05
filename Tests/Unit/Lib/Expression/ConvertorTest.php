<?php
class Expression_ConvertorTest extends PHPUnit_Framework_TestCase
{
    public function Expression_ConvertorTest_dataProvider()
    {
        return array(
                    array(
                        array(
                            'provided' =>
                                array (
                                    'infix' => '(10 + 20) + (1 + 3 * 2 / (1+1))',
                                    'postfix'=> '10 20 + 1 3 2 * 1 1 + / + +'
                                )
                        ),
                    )
                );
    }

    public function createData()
    {
        return $data;
    }

    /**
    * @dataProvider Expression_ConvertorTest_dataProvider
    */
    public function testInfixToPostfixTrue($data)
    {
        if (is_null($data['provided'])) {
            $data = $this->createData();
        }
        $convertor = Expression_Convertor::getInstance();
        $this->assertEquals($data['provided']['postfix'], $convertor->strInfixToStrPostfix($data['provided']['infix']));
    }

    /**
    * @dataProvider Expression_ConvertorTest_dataProvider
    */
    public function testInfixToPostfixFalse($data)
    {
        if (is_null($data['provided'])) {
            $data = $this->createData();
        }
        $convertor = Expression_Convertor::getInstance();
        $this->assertEquals($data['provided']['postfix'], $convertor->strInfixToStrPostfix($data['provided']['infix']));
    }
}
