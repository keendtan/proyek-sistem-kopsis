<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class CheckoutForeignKeyTest extends TestCase
{
    public function test_transaksi_users_id_foreign_key_references_users_table(): void
    {
        $constraint = DB::selectOne("SELECT REFERENCED_TABLE_NAME
            FROM information_schema.REFERENTIAL_CONSTRAINTS
            WHERE CONSTRAINT_SCHEMA = DATABASE()
              AND TABLE_NAME = 'transaksi'
              AND CONSTRAINT_NAME = 'transaksi_users_id_foreign'");

        $this->assertNotNull($constraint, 'Foreign key transaksi_users_id_foreign should exist.');
        $this->assertSame('users', $constraint->REFERENCED_TABLE_NAME);
    }
}
