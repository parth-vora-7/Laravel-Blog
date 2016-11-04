<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class BasicpageController extends Controller
{
    public function getServices()
    {
    	return 'Services';
    }

	public function getPortfolio()
    {
    	return 'Portfolio';
    }

    public function getAbout()
    {
    	return 'About';
    }

    public function getTeam()
    {
    	return 'Team';
    }

    public function getContact()
    {
    	return 'Contact';
    }    
}
