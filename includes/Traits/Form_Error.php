<?php

namespace My_Contact\Traits;

/**
 * Form Error Trait
 * Handle All Form Error
 */
trait Form_Error {

    public $errors = [];

    /**
     * Check error set or not
     * @return boolean
     */
    public function has_error( $key ) {
        return isset( $this->errors[ $key ] ) ? true : false; 
    }

    /**
     * get errors
     * @return string|boolean
     */
    public function get_error( $key ) {
        if ( isset( $this->errors[ $key ] ) ) {
            return $this->errors[ $key ];
        }
        return false;
    }
}