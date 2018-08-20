<?php

namespace Tests\Unit\Models;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserModelTest extends TestCase
{

    public function test_UserModel_SuperAdmin_is_property_configured()
    {
        $superAdmin = User::find(1);

        $this->assertEquals(1,$superAdmin->active);
        $this->assertEquals(1,$superAdmin->dashboard_enable);
        $this->assertEquals(1,$superAdmin->language_id);
        $this->assertEquals('super_admin',$superAdmin->name);
        $this->assertEquals('super_admin@test.test',$superAdmin->email);

        $this->assertInstanceOf('App\Models\Language',$superAdmin->language);
        $this->assertEquals('en',$superAdmin->userLanguageName());

        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection',$superAdmin->roles);
        $this->assertTrue($superAdmin->hasRole('Super_admin'));
        $this->assertTrue($superAdmin->canDo('CAN_VIEW_DASHBOARD'));
        $this->assertTrue($superAdmin->canDo('CAN_VIEW_USERS'));
        $this->assertTrue($superAdmin->canDo('CAN_VIEW_USER'));
        $this->assertTrue($superAdmin->canDo('CAN_EDIT_USER'));
        $this->assertTrue($superAdmin->canDo('CAN_VIEW_ROLES'));
        $this->assertTrue($superAdmin->canDo('CAN_VIEW_ROLE'));
        $this->assertTrue($superAdmin->canDo('CAN_EDIT_ROLE'));
        $this->assertTrue($superAdmin->canDo('CAN_VIEW_ROLES_PERMISSIONS'));
        $this->assertTrue($superAdmin->canDo('CAN_EDIT_ROLES_PERMISSIONS'));
    }


}
