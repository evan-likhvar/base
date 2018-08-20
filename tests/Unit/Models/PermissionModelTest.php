<?php

namespace Tests\Unit\Models;

use App\Models\Permission;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PermissionModelTest extends TestCase
{

    public function test_PermissionModel_is_property_configured()
    {
        $permission = Permission::find(1);

        $this->assertEquals('CAN_VIEW_DASHBOARD',$permission->name);
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection',$permission->roles);

    }


}
