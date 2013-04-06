<?php
class Sort_QuickSort2pivotTest extends PHPUnit_Framework_TestCase
{
    public function Sort_QuickSort2pivotTest_dataProvider()
    {
        return array(
                    array(
                        array (
                            1, 2, 4, 3
                        ),
                        array (
                            1, 2, 3, 4
                        )
                    ),
                    array(
                        array (
                            1, 2, 3
                        ),
                        array (
                            1, 2, 3
                        )
                    ),
                    array(
                        array (
                            3, 2, 1
                        ),
                        array (
                            1, 2, 3
                        )
                    ),
                    array(
                        array (
                            2, 1
                        ),
                        array (
                            1, 2
                        )
                    ),
                    array(
                        array (
                            1, 2
                        ),
                        array (
                            1, 2
                        )
                    ),
                    array(
                        array (
                            1, 2, 1
                        ),
                        array (
                            1, 1, 2
                        )
                    ),
                    array(
                        array (
                            1,  1
                        ),
                        array (
                            1, 1
                        )
                    ),
                    array(
                        array (
                            1
                        ),
                        array (
                            1
                        )
                    ),
                    array(
                        array (
                        ),
                        array (
                        )
                    )
                );
    }

    /**
    * @dataProvider Sort_QuickSort2pivotTest_dataProvider
    */
    public function testsortTrue($unsorted, $sorted)
    {
        $sortInstance = Sort_QuickSort::getInstance();
        $this->assertEquals($sorted, $sortInstance->sort($unsorted));
    }
}
