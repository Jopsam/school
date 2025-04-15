<?php

namespace Tests\Feature;

use App\Models\Course;
use App\Models\School;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Laravel\Passport\Passport;
use Tests\TestCase;

class CourseControllerTest extends TestCase
{
    use RefreshDatabase;

    private function authenticate(): void
    {
        $user = User::factory()->create();
        Passport::actingAs($user);
    }

    /** @test */
    public function it_returns_a_list_of_courses()
    {
        $this->authenticate();

        $school = School::factory()->create();
        Course::factory()->count(3)->create(['school_id' => $school->id]);

        $response = $this->getJson('/api/courses');

        $response->assertStatus(200)
            ->assertJsonCount(3);
    }

    /** @test */
    public function it_creates_a_course()
    {
        $this->authenticate();

        $school = School::factory()->create();

        $data = [
            'school_id' => $school->id,
            'name' => 'Math',
            'description' => 'Basic math course',
            'amount' => 150.00,
            'duration' => '19:20:00',
        ];

        $response = $this->postJson('/api/courses', $data);

        $response->assertStatus(Response::HTTP_CREATED)
            ->assertJsonFragment(['name' => 'Math']);

        $this->assertDatabaseHas('courses', ['name' => 'Math']);
    }

    /** @test */
    public function it_shows_a_single_course()
    {
        $this->authenticate();

        $school = School::factory()->create();
        $course = Course::factory()->create(['school_id' => $school->id]);

        $response = $this->getJson("/api/courses/{$course->id}");

        $response->assertStatus(200)
            ->assertJsonFragment(['id' => $course->id]);
    }

    /** @test */
    public function it_updates_a_course()
    {
        $this->authenticate();

        $school = School::factory()->create();
        $course = Course::factory()->create(['school_id' => $school->id]);

        $response = $this->putJson("/api/courses/{$course->id}", [
            'name' => 'Updated Name',
        ]);

        $response->assertStatus(200)
            ->assertJsonFragment(['name' => 'Updated Name']);

        $this->assertDatabaseHas('courses', ['id' => $course->id, 'name' => 'Updated Name']);
    }

    /** @test */
    public function it_deletes_a_course()
    {
        $this->authenticate();

        $school = School::factory()->create();
        $course = Course::factory()->create(['school_id' => $school->id]);

        $response = $this->deleteJson("/api/courses/{$course->id}");

        $response->assertStatus(Response::HTTP_NO_CONTENT);

        $this->assertDatabaseMissing('courses', ['id' => $course->id]);
    }
}
