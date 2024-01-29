<?php

namespace Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Orchestra\Testbench\Concerns\WithWorkbench;
use Tests\Helpers\BlogPostTestHelperTrait;
use Tests\Helpers\BlogTestHelperTrait;

class TestCase extends \Orchestra\Testbench\TestCase
{
    use WithWorkbench;
    use RefreshDatabase;
    use BlogTestHelperTrait;
    use BlogPostTestHelperTrait;
}
