<?php

use PHPUnit\Framework\TestCase;
use Fidelize\Flowchart\ToPng\FlowChartImage;

class FlowChartImageTest extends TestCase
{
    public function testToPngShouldGenerateCorrectly()
    {
        $expected = 'e8d065ac24600682639ef29238195c2c';
        $image = new FlowChartImage();
        $image->setContent($this->simpleFlowchart());
        $image->generate();
        ob_start();
            $image->toPng();
            $result = md5(ob_get_contents());
        ob_end_clean();
        $this->assertEquals($expected, $result);
    }

    protected function simpleFlowchart()
    {
        $flowchart = [
            "nodes" => [
                [
                    "id" =>  "flowchartStart",
                    "type" =>  "start",
                    "text" =>  "Start",
                    "left" =>  "20px",
                    "top" =>  "180px",
                    "countSource" =>  null
                ],
                [
                    "id" =>  "flowchartEnd",
                    "type" =>  "end",
                    "text" =>  "End",
                    "left" =>  "940px",
                    "top" =>  "180px",
                    "countSource" =>  null
                ],
                [
                    "id" =>  "flowchartWindow1489779664638",
                    "type" =>  "action",
                    "text" =>  "Approve",
                    "left" =>  "680px",
                    "top" =>  "260px",
                    "action" =>  "Approve",
                    "extraParams" =>  "",
                    "countSource" =>  "1"
                ],
                [
                    "id" =>  "flowchartWindow1489779672763",
                    "type" =>  "action",
                    "text" =>  "Reject",
                    "left" =>  "620px",
                    "top" =>  "40px",
                    "action" =>  "Reject",
                    "extraParams" =>  "",
                    "countSource" =>  "1"
                ]
            ],
            "edges" =>  [
                [
                    "source" =>  "flowchartStart",
                    "target" =>  "flowchartWindow1489779664638",
                    "data" =>  [
                        "label" =>  "",
                        "positionSource" =>  "RightMiddle",
                        "positionTarget" =>  "LeftMiddle"
                    ]
                ],
                [
                    "source" =>  "flowchartStart",
                    "target" =>  "flowchartWindow1489779672763",
                    "data" =>  [
                        "label" =>  "",
                        "positionSource" =>  "RightMiddle",
                        "positionTarget" =>  "LeftMiddle"
                    ]
                ],
                [
                    "source" =>  "flowchartWindow1489779672763",
                    "target" =>  "flowchartEnd",
                    "data" =>  [
                        "label" =>  "Success",
                        "return" =>  "success",
                        "positionSource" =>  "RightMiddle",
                        "positionTarget" =>  "LeftMiddle"
                    ]
                ],
                [
                    "source" =>  "flowchartWindow1489779664638",
                    "target" =>  "flowchartEnd",
                    "data" =>  [
                    "label" =>  "Success",
                        "return" =>  "success",
                        "positionSource" =>  "RightMiddle",
                        "positionTarget" =>  "LeftMiddle"
                    ]
                ]
            ]
        ];
        return json_encode($flowchart);
    }

    public function testChunkTextMustTurnStringInArrayOfChunkedStrings()
    {
        $input = "123456789asdf 0123456789 abcdefgh lorem ipsu";
        $expected = [
            '123456789asdf',
            '0123456789',
            'abcdefgh',
            'lorem ipsu'
        ];

        $this->assertEquals($expected, FlowChartImage::chunkText($input));
    }
}

