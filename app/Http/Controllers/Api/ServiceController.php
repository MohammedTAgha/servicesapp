<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    // Get all services
    public function index()
    {
        $services = Service::all();
        return response()->json($services);
    }
    
    // Create a new service
    public function store(Request $request)
    {
        // return response()->json($request, 201);;
        $request->validate([
            'name' => 'required|string',
            'details' => 'required|string',
            'price' => 'required|numeric',
        ]);

        $service = Service::create($request->all());    
        return response()->json($service, 201);
    }

    // Get a specific service
    public function show(Service $service)
    {
        return response()->json($service);
    }

    // Update a service
    public function update(Request $request, Service $service)
    {
         

        $request->validate([
            'name' => 'sometimes|string',
            'details' => 'sometimes|string',
            'price' => 'sometimes|numeric',
        ]);

        $service->update($request->all());
        return response()->json($service);
    }

    // Delete a service
    public function destroy(Service $service)
    {
        $service->delete();
        return response()->json(null, 204);
    }
}
