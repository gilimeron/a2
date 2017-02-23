<?php

namespace Bill;

class Form {

    /**
	* Properties
	*/
    private $request;
    public $hasErrors = false;


    /**
	*
	*/
    public function __construct($postOrGet) {

        # Store form data (POST or GET) in a class property called $request
        $this->request = $postOrGet;

    }


    /**
	* Get a value from the request, with the option of including a default
    * if the value is not set.
    * Example usage:
    *   $email = $this->get('email','example@gmail.com');
	*/
    public function get($name, $default = null) {

        $value = isset($this->request[$name]) ? $this->request[$name] : $default;

        return $value;

    }


    /**
	* Determines if a single checkbox is checked
    * Example usage:
    *   <input type='checkbox' name='caseSensitive' <?php if($form->isChecked('caseSensitive')) echo 'CHECKED' ?>>
	*/
    public function isChosen($name) {
        $value = isset($this->request[$name]) ? true : false;

        return $value;
    }


    /**
	* Returns True if *either* GET or POST have been submitted
	*/
    public function isSubmitted() {
        return $_SERVER['REQUEST_METHOD'] == 'POST' || !empty($_GET);
    }


    /**
    * Strips HTML characters; works with arrays or scalar values
    */
    public function sanitize($mixed = null) {

        # Base case
        if(!is_array($mixed)) {
            return htmlentities($mixed, ENT_QUOTES, "UTF-8");
        }
        else {
            return sanitize(array_shift($mixed));
        }

        return $mixed;

    }


    /**
	* Given an array of fields => validation rules
    * Will loop through each field's rules
    * Returns an array of error messages
    *
    * Note: Stops after the first error for a given field
	*/
    public function validate($fieldsToValidate) {

        $errors = [];

        foreach($fieldsToValidate as $fieldName => $rules) {

            # Each rule is separated by a |
            $rules = explode('|', $rules);

            foreach($rules as $rule) {

                # Get the value for this field from the request
                $value = $this->get($fieldName);

                # Handle any parameters with the rule, e.g. max:99
                $parameter = null;
                if(strstr($rule, ':')) {
                    list($rule, $parameter) = explode(':', $rule);
                }

                # Run the validation test with the given rule
                $test = $this->$rule($value, $parameter);

                # Test failed
                if(!$test) {
                    $errors[] = 'The field '.$fieldName.$this->getErrorMessage($rule, $parameter);

                    # Only indicate one error per field
                    break;
                }
            }
        }

        # Set public property hasErrors as Boolean
        $this->hasErrors = !empty($errors);

        return $errors;

    }


    /**
	* Given a String rule like 'alphaNumeric' or 'required'
    * It'll return a String message appropriate for that rule
    * Default message is used if no message is set for a given rule
	*/
    private function getErrorMessage($rule, $parameter = null) {

        $language = [
            'numeric' => ' can only contain numbers',
            'integer' => ' can only contain whole numbers',
            'required' => ' is required.',
            'min' => ' has to be greater than '.$parameter,
        ];

        # If a message for the rule was found, use that, otherwise default to " has an error"
        $message = isset($language[$rule]) ? $language[$rule] : ' has an error.';

        return $message;

    }


    ### VALIDATION METHODS FOUND BELOW HERE ###

    /**
	* Returns boolean if given value contains only numbers (either integers or floats)
	*/
    private function numeric($value) {
        return ctype_digit(str_replace(' ','', $value)) || is_numeric(str_replace(' ','', $value));
    }

    /**

	* Returns boolean if given value contains only integers
	*/
    private function integer($value) {
        return ctype_digit(str_replace(' ','', $value));
    }

    /**
	* Returns boolean if the given value is not blank
	*/
    private function required($value) {
        $value = trim($value);
        return $value != '' && isset($value) && !is_null($value);
    }


    /**
	* Returns value if the given value is GREATER THAN (non-inclusive) the given parameter
	*/
    private function min($value, $parameter) {
        return floatval($value) > floatval($parameter);
    }

} # end of class
