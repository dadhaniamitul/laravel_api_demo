<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Http\Response;

class RealEstateEntitiesTest extends TestCase
{
    /**
     * Get all real estate entity list.
     *
     * @return void
     */
    public function test_get_real_estate_entities()
    {
        $this->json('get', '/api/realestate')
        ->assertStatus(Response::HTTP_OK)
        ->assertJsonStructure([
            'status',
            'message',
            'data' => [
                'data' => [
                    '*' => [
                        'id',
                        'name',
                        'real_state_type',
                        'city',
                        'country'
                    ]
                ]
            ]
        ]);
    }
    /**
     * Get real estate entity by id.
     *
     * @return void
     */
    public function test_get_real_estate_entity_by_id()
    {
        $this->json('get', '/api/realestate/7')
        ->assertStatus(Response::HTTP_OK)
        ->assertJsonStructure([
            'status',
            'message',
            'data' => [
                'id',
                'name',
                'real_state_type',
                'city',
                'country'
            ]
        ]);
    }
    /**
     * Create real estate entity.
     *
     * @return void
     */
    public function test_create_real_estate_entity()
    {
        $params = array(
            'name' => 'Sapath-V',
            'real_state_type' => 'land',
            'external_number' => 'test-123',
            'country' => 'US',
            'rooms' => 'dfdfd',
            'bathrooms' => '0',
            'city' => 'Ahmedabad',
            'street' => 'test street name',
            'internal_number' => 'TEst123',
            'neighborhood' => 'test neighborhood',
            'rooms' => '3',
            'comment' => 'TEst comment'
        );

        $this->json('post', '/api/realestate',$params)->assertStatus(201);
    }
    /**
     * Update real estate entity.
     *
     * @return void
     */
    public function test_update_real_estate_entity()
    {
        $params = array(
            'name' => 'Sapath-I',
            'real_state_type' => 'land',
            'external_number' => 'test-123',
            'country' => 'US',
            'rooms' => 'dfdfd',
            'bathrooms' => '0',
            'city' => 'Ahmedabad',
            'street' => 'test street name',
            'internal_number' => 'TEst123',
            'neighborhood' => 'test neighborhood',
            'rooms' => '3',
            'comment' => 'TEst comment'
        );

        $this->json('PUT', '/api/realestate/7',$params)
        ->assertStatus(Response::HTTP_OK);
    }
    /**
     * Delete real estate entity.
     *
     * @return void
     */
    public function test_delete_real_estate_entity()
    {
        $this->json('DELETE', '/api/realestate/7')->assertStatus(Response::HTTP_OK);
    }
}
