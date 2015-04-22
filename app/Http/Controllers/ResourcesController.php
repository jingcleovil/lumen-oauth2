<?php namespace App\Http\Controllers;

/**
 * Class ResourcesController
 *
 * @package App\Http\Controllers
 */
class ResourcesController extends Controller
{
    /**
     * @return string
     */
    public function index()
    {
        return [
            'response' => 'You are now able to access this endpoint'
        ];
    }
}
