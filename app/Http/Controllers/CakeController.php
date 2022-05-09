<?php

namespace App\Http\Controllers;

use App\Http\Requests\{StoreCakeRequest,UpdateCakeRequest,OrderCakeRequest};
use App\Models\Cake;
use Illuminate\Http\Request;

class CakeController extends Controller
{
    protected $cake;

    public function __construct(Cake $cake)
    {
        $this->cake = $cake;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $cakes = $this->cake->paginate($request->per_page ?? 10);
        return response()->json($cakes, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCakeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCakeRequest $request)
    {
        $cake = $this->cake->create($request->all());
        return response()->json([
            'success'   => true,
            'message' => 'Inserted resource',
            'data' => $cake
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cake  $cake
     * @return \Illuminate\Http\Response
     */
    public function show(Cake $cake)
    {
        return response()->json([
            'success'   => true,
            'message' => 'Shown resource',
            'data' => $cake
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCakeRequest  $request
     * @param  \App\Models\Cake  $cake
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCakeRequest $request, Cake $cake)
    {
        $cake->update($request->all());
        return response()->json([
            'success'   => true,
            'message' => 'Updated resource',
            'data' => $cake
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cake  $cake
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cake $cake)
    {
        $id = $cake->id;
        $name = $cake->name;
        $cake->delete();
        return response()->json([
            'success'   => true,
            'message' => 'Deleted resource',
            'data' => [
                'id' => $id,
                'name' => $name,
            ]
        ], 200);
    }

    /**
     * Add one new unity to existing cake make a new cake).
     *
     * @param  \App\Models\Cake  $cake
     * @return \Illuminate\Http\Response
     */
    public function make(Cake $cake)
    {
        $cake->update([
            'available' => ++$cake->available,
        ]);
        return response()->json([
            'success'   => true,
            'message' => 'Added new cake',
            'data' => $cake
        ], 200);
    }

    /**
     * Order a cake (add email to order list).
     *
     * @param  \App\Http\Requests\OrderCakeRequest  $request
     * @param  \App\Models\Cake  $cake
     * @return \Illuminate\Http\Response
     */
    public function order(OrderCakeRequest $request, Cake $cake)
    {
        $orders = $cake->orders;
        array_push($orders, [
            'email' => $request->email,
            'situation' => 'new',
        ]);
        $cake->update([
            'orders' => $orders,
        ]);
        return response()->json([
            'success'   => true,
            'message' => 'Ordered cake',
            'data' => $cake
        ], 200);
    }
}
