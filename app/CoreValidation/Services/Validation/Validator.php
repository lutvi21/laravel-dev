<?php
/**
 * Created by PhpStorm.
 * User: Lutvi
 * Date: 25/01/2019
 * Time: 01:09 PM
 */

namespace App\CoreValidation\Services\Validation;

use Illuminate\Validation\Factory as IlluminateValidator;
use App\CoreValidation\Exceptions\ValidationException;


/**
 * Base Validation class. All entity specific validation classes inherit
 * this class and can override any function for respective specific needs
 */
abstract class Validator {

    /**
     * @var Illuminate\Validation\Factory
     */
    protected $_validator;

    public function __construct( IlluminateValidator $validator ) {
        $this->_validator = $validator;
    }

    public function validate( array $data, array $rules = array(), array $custom_errors = array() ) {
        if ( empty( $rules ) && ! empty( $this->rules ) && is_array( $this->rules ) ) {
            //no rules passed to function, use the default rules defined in sub-class
            $rules = $this->rules;
        }

        //use Laravel's Validator and validate the data
        $validation = $this->_validator->make( $data, $rules, $custom_errors );

        if ( $validation->fails() ) {
            //validation failed, throw an exception
            throw new ValidationException( $validation->messages() );
        }

        //all good and shiny
        return true;
    }

} //end of class

