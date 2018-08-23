<?php
/**
 * Created by PhpStorm.
 * User: evan
 * Date: 23.08.18
 * Time: 12:41
 */

namespace App\Repositories\SiteUser;


use App\User;
use Carbon\Carbon;

class BackUser
{

    private $model;

    public function __construct()
    {
        $this->model = new User();
    }

    public function userCount()
    {
        return $this->model->count();
    }

    public function activeUserCount()
    {
        return $this->model->where('active',1)->count();
    }

    public function deactivateUserCount()
    {
        return $this->userCount() - $this->activeUserCount();
    }

    public function dashboardEnableUserCount()
    {
        return $this->model->where('dashboard_enable',1)->count();
    }

    public function newUserForLastDay()
    {
        return $this->model->where('created_at','>',
            Carbon::now()->addDay(-1)->toDateTimeString())
            ->count();
    }

    public function newUserForLastWeek()
    {
        return $this->model->where('created_at','>',
            Carbon::now()->addWeek(-1)->toDateTimeString())
            ->count();
    }

    public function newUserForLastMonth()
    {
        return $this->model->where('created_at','>',
            Carbon::now()->addMonth(-1)->toDateTimeString())
            ->count();
    }
}