<?php

namespace App\Http\Controllers\Api\Contents;

use App\CoreValidation\Exceptions\ValidationException;
use App\CoreValidation\Services\Validation\TestContentValidator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContentsController extends Controller
{
    //
    protected $_validator;

    public function __construct(TestContentValidator $validator ) {
        $this->_validator = $validator;
    }

    public function index(Request $request)
    {
        try {
            $validate_data = $this->_validator->validate( $request->all() );

            if($request->has('id')) {
                $return = ['id' => $request->id, 'name' => 'test'];
            } else {
                $return = ['id' => null, 'name' => 'undefined'];
            }

            return response()->json($return, 200);
        } catch ( ValidationException $e ) {

            return response()->json(['error' => $e->get_errors()], 300);
        }
    }
}
