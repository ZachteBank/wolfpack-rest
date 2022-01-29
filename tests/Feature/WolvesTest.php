<?php

namespace Tests\Feature;

use App\Models\Wolf;
use Tests\TestCase;

class WolvesTest extends TestCase
{

    public function testGetAllWolves()
    {
        $dbWolves = Wolf::all();
        $dbWolvesJson = $dbWolves->jsonSerialize();
        $response = $this->json('GET', 'api/wolves');
        $response->assertJson($dbWolvesJson);
        $response->assertJsonCount($dbWolves->count());

        $response->assertStatus(200);
    }

    public function testAddWolf()
    {
        $wolf = Wolf::factory()->make();
        $response = $this->json('POST', 'api/wolves', $wolf->toArray());
        $response->assertStatus(200);
        $response->assertJsonStructure(["name", "id", "birthday", "lat", "lng", "gender"]);
        $response->assertJson([
            "name" => $wolf->name,
            "birthday" => $wolf->birthday,
            "lat" => $wolf->lat,
            "lng" => $wolf->lng,
            "gender" => $wolf->gender,
            "pack_id" => $wolf->pack_id,
        ]);
    }

    public function testAddWolfWrongGender()
    {
        $wolf = Wolf::factory()->make();
        $wolf->gender = "man";

        $response = $this->json('POST', 'api/wolves', $wolf->toArray());
        $response->assertStatus(422);
        $response->assertJsonStructure(["message", "errors"]);
        $response->assertJson([
                "errors" => [
                    "gender" => ["The selected gender is invalid."]
                ]
            ]
        );
    }

    public function testAddWolfWrongNegativePackId()
    {
        $wolf = Wolf::factory()->make(["pack_id" => -3]);

        $response = $this->json('POST', 'api/wolves', $wolf->toArray());
        $response->assertStatus(422);
        $response->assertJsonStructure(["message", "errors"]);
        $response->assertJson([
                "errors" => [
                    "pack_id" => [
                        "The pack id must be at least 0."
                    ]
                ]
            ]
        );
    }

    public function testAddWolfWrongNonExistingPackId()
    {
        $wolf = Wolf::factory()->make(['pack_id' => 11]);

        $response = $this->json('POST', 'api/wolves', $wolf->toArray());
        $response->assertStatus(422);
        $response->assertJsonStructure(["message", "errors"]);
        $response->assertJson([
                "errors" => [
                    "pack_id" => [
                        "The selected pack id is invalid."
                    ]
                ]
            ]
        );
    }

    public function testUpdateWolfCorrect()
    {
        $wolf = Wolf::findOrFail(1);
        $wolf->gender = "male";

        $response = $this->json('PUT', 'api/wolves/' . $wolf->id, $wolf->toArray());
        $response->assertStatus(200);
        $response->assertJsonStructure(["name", "id", "birthday", "lat", "lng", "gender"]);
        $response->assertJson([
            "name" => $wolf->name,
            "birthday" => $wolf->birthday,
            "lat" => $wolf->lat,
            "lng" => $wolf->lng,
            "gender" => "male",
            "pack_id" => $wolf->pack_id,
        ]);

        $wolf->gender = "female";

        $response = $this->json('PUT', 'api/wolves/' . $wolf->id, $wolf->toArray());
        $response->assertStatus(200);
        $response->assertJsonStructure(["name", "id", "birthday", "lat", "lng", "gender"]);
        $response->assertJson([
            "name" => $wolf->name,
            "birthday" => $wolf->birthday,
            "lat" => $wolf->lat,
            "lng" => $wolf->lng,
            "gender" => "female",
            "pack_id" => $wolf->pack_id,
        ]);
    }

    public function testUpdateWolfWrongGender()
    {
        $wolf = Wolf::findOrFail(1);
        $wolf->gender = "man";

        $response = $this->json('PUT', 'api/wolves/' . $wolf->id, $wolf->toArray());
        $response->assertStatus(422);
        $response->assertJsonStructure(["message", "errors"]);
        $response->assertJson([
                "errors" => [
                    "gender" => ["The selected gender is invalid."]
                ]
            ]
        );
    }
}
