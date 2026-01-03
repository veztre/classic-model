<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class ClassicModelsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Offices
        DB::table('offices')->insert([
            'officeCode' => '1',
            'city' => 'San Francisco',
            'phone' => '415 555 1234',
            'addressLine1' => '100 Market St',
            'country' => 'USA',
            'postalCode' => '94105',
            'territory' => 'NA'
        ]);

        // Employees
        DB::table('employees')->insert([
            'employeeNumber' => 1002,
            'lastName' => 'Doe',
            'firstName' => 'John',
            'extension' => 'x123',
            'email' => 'john.doe@example.com',
            'officeCode' => '1',
            'reportsTo' => null,
            'jobTitle' => 'Sales Rep'
        ]);

        // Product lines
        DB::table('product_lines')->insert([
            'productLine' => 'Classic Cars',
            'textDescription' => 'Vintage and classic cars',
        ]);

        // Products
        DB::table('products')->insert([
            'productCode' => 'S10_1678',
            'productName' => '1969 Harley Davidson Ultimate Chopper',
            'productLine' => 'Classic Cars',
            'productScale' => '1:10',
            'productVendor' => 'Vendor A',
            'productDescription' => 'A classic chopper',
            'quantityInStock' => 7933,
            'buyPrice' => 48.81,
            'MSRP' => 95.70,
        ]);

        // Customers
        DB::table('customers')->insert([
            'customerNumber' => 103,
            'customerName' => 'Atelier graphique',
            'contactLastName' => 'Schmitt',
            'contactFirstName' => 'Carine',
            'phone' => '40.32.2555',
            'addressLine1' => '54, rue Royale',
            'city' => 'Nantes',
            'country' => 'France',
            'salesRepEmployeeNumber' => 1002,
            'creditLimit' => 21000.00,
        ]);

        // Orders
        DB::table('orders')->insert([
            'orderNumber' => 10100,
            'orderDate' => Carbon::now()->toDateString(),
            'requiredDate' => Carbon::now()->addDays(7)->toDateString(),
            'shippedDate' => Carbon::now()->addDays(2)->toDateString(),
            'status' => 'Shipped',
            'comments' => 'Test order',
            'customerNumber' => 103,
        ]);

        // Order details
        DB::table('order_details')->insert([
            'orderNumber' => 10100,
            'productCode' => 'S10_1678',
            'quantityOrdered' => 30,
            'priceEach' => 95.70,
            'orderLineNumber' => 1,
        ]);

        // Payments
        DB::table('payments')->insert([
            'customerNumber' => 103,
            'checkNumber' => 'HQ336338',
            'paymentDate' => Carbon::now()->toDateString(),
            'amount' => 2871.00,
        ]);
    }
}
