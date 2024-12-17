<?php

namespace Tests\Feature;

use App\Models\Transaction;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TransactionTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test the index method.
     */
    public function testIndex()
    {
        $transactions = Transaction::factory()->count(3)->create();

        $response = $this->getJson('/api/transactions');

        $response->assertStatus(200)
        ->assertJsonStructure([
            '*' => ['id', 'amount', 'description', 'transaction_date','category_id','category_name', 'created_at', 'updated_at',]
        ]);
    }

    /**
     * Test the store method.
     */
    public function testStore()
    {
        $transactionData = Transaction::factory()->make()->toArray();

        $response = $this->postJson('/api/transactions', $transactionData);

        $response->assertStatus(201)
        ->assertJsonStructure([
            '*' => ['id', 'amount', 'description', 'transaction_date','category_id','category_name', 'created_at', 'updated_at',]
        ]);
    }

    /**
     * Test the show method.
     */
    public function testShow()
    {
        $transaction = Transaction::factory()->create();

        $response = $this->getJson("/api/transactions/{$transaction->id}");

        $response->assertStatus(200)
                 ->assertJsonPath('data.id', $transaction->id);
    }

    /**
     * Test the update method.
     */
    public function testUpdate()
    {
        $transaction = Transaction::factory()->create();
        $updatedData = Transaction::factory()->make()->toArray();

        $response = $this->putJson("/api/transactions/{$transaction->id}", $updatedData);

        $response->assertStatus(200)
                 ->assertJsonPath('data.amount', $updatedData['amount']);
    }

    /**
     * Test the destroy method.
     */
    public function testDestroy()
    {
        $transaction = Transaction::factory()->create();

        $response = $this->deleteJson("/api/transactions/{$transaction->id}");

        $response->assertStatus(204);
        $this->assertDatabaseMissing('transactions', ['id' => $transaction->id]);
    }
}
