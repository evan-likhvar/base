<?php

namespace Tests\Unit\Models;

use App\Models\Language;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LanguageModelTest extends TestCase
{

    public function test_LanguageModel_is_property_configured()
    {
        $defaultLanguage = Language::find(1);

        $this->assertEquals(1,$defaultLanguage->active);
        $this->assertEquals('en',$defaultLanguage->name);
        $this->assertEquals('english',$defaultLanguage->full_name);
    }


}
