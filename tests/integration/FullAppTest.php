<?php


class FullAppTest extends TestCase
{
    /**
     * @test
     */
    public function it_fails_validation()
    {
        $this->post('/search', [])
            ->seeJsonContains([
                "status" => "error",
                "message" => "The query field is required."
            ]);
    }

    /**
     * @test
     */
    public function it_gets_a_response()
    {
        $this->post('/search', ['query' => 'youtube'])
            ->seeStatusCode(200);
    }

    /**
     * @test
     */
    public function it_throws_google_exception()
    {
        $this->post('/search', [
            'query' => 'youtube',
            'part' => 'crap'
        ])
            ->seeStatusCode(400)
            ->seeJsonEquals([
                'error' => [
                    'errors' => [
                        [
                            'domain' => 'youtube.part',
                            'reason' => 'unknownPart',
                            'message' => 'crap',
                            'locationType' => 'parameter',
                            'location' => 'part'
                        ]
                    ],
                    'code' => 400,
                    'message' => 'crap'
                ]
            ]);
    }
}
