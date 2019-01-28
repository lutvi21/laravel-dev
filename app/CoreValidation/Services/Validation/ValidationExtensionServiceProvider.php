<?php
/**
 * Created by PhpStorm.
 * User: Lutvi
 * Date: 25/01/2019
 * Time: 01:06 PM
 */

namespace App\CoreValidation\Services\Validation;

use Illuminate\Support\ServiceProvider;

class ValidationExtensionServiceProvider extends ServiceProvider {

    public function register() {}

    public function boot() {
        /*
         * Setup validation extension in boot() because Laravel runs this just before
         * routing a request. The register() is called immediately when service provider
         * is loaded and since that happens quite early on, Laravel's Validation class object
         * is not available at that time which would result in an exception being thrown.
         */
        $this->app->validator->resolver( function( $translator, $data, $rules, $messages = array(), $customAttributes = array() ) {
            return new ValidatorExtended( $translator, $data, $rules, $messages, $customAttributes );
        } );
    }

}
