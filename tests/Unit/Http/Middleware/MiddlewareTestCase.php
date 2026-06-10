<?php

namespace MantaCil\Tests\Unit\Http\Middleware;

use MantaCil\Tests\TestCase;
use MantaCil\Tests\Traits\Http\RequestMockHelpers;
use MantaCil\Tests\Traits\Http\MocksMiddlewareClosure;
use MantaCil\Tests\Assertions\MiddlewareAttributeAssertionsTrait;

abstract class MiddlewareTestCase extends TestCase
{
    use MiddlewareAttributeAssertionsTrait;
    use MocksMiddlewareClosure;
    use RequestMockHelpers;

    /**
     * Setup tests with a mocked request object and normal attributes.
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->buildRequestMock();
    }
}
