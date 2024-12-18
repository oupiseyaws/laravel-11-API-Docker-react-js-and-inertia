<?php

namespace Tests\Feature;

use App\Http\Resources\TransactionResource;
use App\Models\Category;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Log;
use Tests\TestCase;

class TransactionControllerTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function test_can_display_all_transaction()
    {
        // login and get token
        $user = User::factory()->create();
        $token = $user->createToken('auth_token')->plainTextToken;

        Transaction::factory()->count(10)->create();
        $response = $this->withHeader('Authorization', 'Bearer ' . $token)->getJson(route('transactions.index'));

        $response->assertStatus(200)
        ->assertJsonCount(10)
        ->assertJsonStructure([
            '*' => ['id', 'amount', 'description', 'transaction_date','category_id','category_name', 'created_at', 'updated_at',]
        ]);
    }

    #[Test]
    public function test_store_transaction()
    {

        // login and get token
        $user = User::factory()->create();
        $token = $user->createToken('auth_token')->plainTextToken;

        // user create a category
        $category = Category::factory()->create(['user_id' => $user->id]);

        $transactionData =  [
            "category_id" => $category->id,
            "amount" => 44004,
            "description" => "Dolores blanditiis adipisci culpa amet est quasi.",
            "transaction_date" => '11/11/2024'
        ];

        $response = $this->withHeader('Authorization', 'Bearer ' . $token)->postJson(route('transactions.store'), $transactionData);

        $response->assertStatus(201)
        ->assertJson([
            "id" => 1,
            "category_id" => $category->id,
            "amount" =>  number_format(44004,2),
            "category_name" => $category->name,
            "transaction_date" => '11/11/2024',
            "description" => "Dolores blanditiis adipisci culpa amet est quasi.",
            "created_at" => $response['created_at'],
            "updated_at" => $response['updated_at']
        ]);
    }

    /**
     * Test the show method.
     */
    public function test_show_transaction()
    {
         // login and get token
        $user = User::factory()->create();
        $token = $user->createToken('auth_token')->plainTextToken;

        // user create a category
        $category = Category::factory()->create(['user_id' => $user->id]);

        $transaction = Transaction::factory()->create(['category_id' => $category->id]);

        $response = $this->withHeader('Authorization', 'Bearer ' . $token)->getJson(route('transactions.show', $transaction));

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'id',
            'amount',
            'category_id',
            'category_name',
            'transaction_date',
            'description',
            'created_at',
            'updated_at',
        ]);
    }

    /**
     * Test the update method.
     */
    public function test_update_transaction()
    {
        // login and get token
        $user = User::factory()->create();
        $token = $user->createToken('auth_token')->plainTextToken;

        // user create a category
        $category = Category::factory()->create(['user_id' => $user->id]);

        $transaction = Transaction::factory()->create(['category_id' => $user->id]);
        $updatedData = [
            "category_id" => $category->id,
            "amount" => 44004,
            "description" => "Dolores blanditiis adipisci culpa amet est quasi.",
            "transaction_date" => '11/11/2024'
        ];

        $response = $response = $this->withHeader('Authorization', 'Bearer ' . $token)->putJson(route('transactions.update', $transaction), $updatedData);

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'id',
            'amount',
            'category_id',
            'category_name',
            'transaction_date',
            'description',
            'created_at',
            'updated_at',
        ]);
    }

    /**
     * Test the destroy method.
     */
    public function test_destroy_transaction()
    {

        // login and get token
        $user = User::factory()->create();
        $token = $user->createToken('auth_token')->plainTextToken;

         // user create a category
        $category = Category::factory()->create(['user_id' => $user->id]);

        $transactionData =  [
            "category_id" => $category->id,
            "amount" => 44004,
            "description" => "Dolores blanditiis adipisci culpa amet est quasi.",
            "transaction_date" => '11/11/2024'
        ];

         // create a transaction with factory
        $responseTransactionData = Transaction::factory()->create($transactionData);

        $response =$this->withHeader('Authorization', 'Bearer ' . $token)->deleteJson(route('transactions.destroy', $responseTransactionData));

        $response->assertStatus(204);
    }
}
