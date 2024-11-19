<?php

namespace Tests\Unit\Http\Requests;

use Tests\TestCase;

/**
 * @see \App\Http\Requests\WratsUserApplicationHistoryUpdateRequest
 */
class WratsUserApplicationHistoryUpdateRequestTest extends TestCase
{
    /** @var \App\Http\Requests\WratsUserApplicationHistoryUpdateRequest */
    private $subject;

    protected function setUp(): void
    {
        parent::setUp();

        $this->subject = new \App\Http\Requests\WratsUserApplicationHistoryUpdateRequest;
    }

    #[Test]
    public function authorize(): void
    {
        $this->markTestIncomplete('');

        $actual = $this->subject->authorize();

        $this->assertTrue($actual);
    }

    #[Test]
    public function rules(): void
    {
        $this->markTestIncomplete('');

        $actual = $this->subject->rules();

        $this->assertValidationRules([
            'wratsUserApplicationHistory' => [
                'required',
            ],
        ], $actual);
    }

    // test cases...
}
