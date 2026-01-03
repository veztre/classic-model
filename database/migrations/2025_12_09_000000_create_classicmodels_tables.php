<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Offices
        Schema::create('offices', function (Blueprint $table) {
            $table->string('officeCode', 10)->primary();
            $table->string('city', 50);
            $table->string('phone', 50);
            $table->string('addressLine1', 50);
            $table->string('addressLine2', 50)->nullable();
            $table->string('state', 50)->nullable();
            $table->string('country', 50);
            $table->string('postalCode', 15)->nullable();
            $table->string('territory', 10)->nullable();
        });

        // Employees
        Schema::create('employees', function (Blueprint $table) {
            $table->increments('employeeNumber');
            $table->string('lastName', 50);
            $table->string('firstName', 50);
            $table->string('extension', 10)->nullable();
            $table->string('email', 100)->nullable();
            $table->string('officeCode', 10)->nullable();
            $table->integer('reportsTo')->unsigned()->nullable();
            $table->string('jobTitle', 50)->nullable();
        });

        // Product lines
        Schema::create('product_lines', function (Blueprint $table) {
            $table->string('productLine', 50)->primary();
            $table->text('textDescription')->nullable();
            $table->text('htmlDescription')->nullable();
            $table->binary('image')->nullable();
        });

        // Products
        Schema::create('products', function (Blueprint $table) {
            $table->string('productCode', 15)->primary();
            $table->string('productName', 70);
            $table->string('productLine', 50)->nullable();
            $table->string('productScale', 10)->nullable();
            $table->string('productVendor', 50)->nullable();
            $table->text('productDescription')->nullable();
            $table->smallInteger('quantityInStock')->unsigned()->nullable();
            $table->decimal('buyPrice', 10, 2)->nullable();
            $table->decimal('MSRP', 10, 2)->nullable();

            $table->foreign('productLine')->references('productLine')->on('product_lines')->onDelete('set null');
        });

        // Customers
        Schema::create('customers', function (Blueprint $table) {
            $table->increments('customerNumber');
            $table->string('customerName', 50);
            $table->string('contactLastName', 50)->nullable();
            $table->string('contactFirstName', 50)->nullable();
            $table->string('phone', 50)->nullable();
            $table->string('addressLine1', 50)->nullable();
            $table->string('addressLine2', 50)->nullable();
            $table->string('city', 50)->nullable();
            $table->string('state', 50)->nullable();
            $table->string('postalCode', 15)->nullable();
            $table->string('country', 50)->nullable();
            $table->integer('salesRepEmployeeNumber')->unsigned()->nullable();
            $table->decimal('creditLimit', 10, 2)->nullable();

            $table->foreign('salesRepEmployeeNumber')->references('employeeNumber')->on('employees')->onDelete('set null');
        });

        // Orders
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('orderNumber');
            $table->date('orderDate')->nullable();
            $table->date('requiredDate')->nullable();
            $table->date('shippedDate')->nullable();
            $table->string('status', 15)->nullable();
            $table->text('comments')->nullable();
            $table->integer('customerNumber')->unsigned();

            $table->foreign('customerNumber')->references('customerNumber')->on('customers')->onDelete('cascade');
        });

        // Order details (line items)
        Schema::create('order_details', function (Blueprint $table) {
            $table->integer('orderNumber')->unsigned();
            $table->string('productCode', 15);
            $table->integer('quantityOrdered')->unsigned()->nullable();
            $table->decimal('priceEach', 10, 2)->nullable();
            $table->smallInteger('orderLineNumber')->unsigned()->nullable();

            $table->primary(['orderNumber', 'productCode']);
            $table->foreign('orderNumber')->references('orderNumber')->on('orders')->onDelete('cascade');
            $table->foreign('productCode')->references('productCode')->on('products')->onDelete('cascade');
        });

        // Payments
        Schema::create('payments', function (Blueprint $table) {
            $table->integer('customerNumber')->unsigned();
            $table->string('checkNumber', 50);
            $table->date('paymentDate')->nullable();
            $table->decimal('amount', 10, 2)->nullable();

            $table->primary(['customerNumber', 'checkNumber']);
            $table->foreign('customerNumber')->references('customerNumber')->on('customers')->onDelete('cascade');
        });

        // Add self-referencing FK for employees.reportsTo (after employees table exists)
        Schema::table('employees', function (Blueprint $table) {
            $table->foreign('officeCode')->references('officeCode')->on('offices')->onDelete('set null');
            $table->foreign('reportsTo')->references('employeeNumber')->on('employees')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('employees', function (Blueprint $table) {
            $table->dropForeign(['officeCode']);
            $table->dropForeign(['reportsTo']);
        });

        Schema::dropIfExists('payments');
        Schema::dropIfExists('order_details');
        Schema::dropIfExists('orders');
        Schema::dropIfExists('customers');
        Schema::dropIfExists('products');
        Schema::dropIfExists('product_lines');
        Schema::dropIfExists('employees');
        Schema::dropIfExists('offices');
    }
};