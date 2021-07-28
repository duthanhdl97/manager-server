<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BaseController extends Controller
{
    /**
     * Get pageination
     *
     * @return \Illuminate\Http\Response
     */
    public function paginate($results)
    {
        return response()->json([
            'status' => Response::HTTP_OK,
            'message' => '',
            'result' => [
                'data' => $results->items(),
                'current_page' => $results->currentPage(),
                'from' => $results->firstItem(),
                'to' => $results->lastItem(),
                'total' => $results->total(),
                'last_page' => $results->lastPage(),
            ]
        ]);
    }
}
