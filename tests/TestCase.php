<?php

namespace Tests;

use App\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Foundation\Testing\TestResponse;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected $currentActor;
    
    /**
     * Undocumented function
     *
     * @return $this
     */
    protected function actinAsUser() {
        $currentActor = factory(User::class)->create();
        return $this->actingAs($currentActor);
    }

    /**
     * Undocumented function
     *
     * @return $this
     */
    protected function actinAsAdmin() {
        $currentActor = factory(User::class)->create();
        $currentActor->is_admin = true;
        $currentActor->save();
        return $this->actingAs($currentActor);
    }

    /**
     * Call the given URI with a JSON POST request.
     *
     * @param string $uri
     * @param array $data
     * @param array $headers
     * @return TestResponse
     */
    protected function jsonPost(string $uri, array $data = [], array $headers = []): TestResponse {
        return $this->json('POST', $uri, $data, $headers);
    }

    /**
     * Call the given URI with a JSON POST request.
     *
     * @param string $uri
     * @param array $data
     * @param array $headers
     * @return TestResponse
     */
    protected function jsonGet(string $uri, array $data = [], array $headers = []): TestResponse {
        return $this->json('GET', $uri, $data, $headers);
    }
}
