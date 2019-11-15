<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Twilio\Rest\Client;
use Twilio\Exceptions\RestException;

class ValidPhoneNumber implements Rule
{
    private $twilioClient;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(Client $twilioClient)
    {
        $this->twilioClient = $twilioClient;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        try {
            $result = $this->twilioClient->lookups->v1->phoneNumbers('+1' . $value)
                ->fetch();
        } catch (RestException $e) {
            return false;
        }

        $parsedPhoneNumber = $result->phoneNumber ?? null;

        return $parsedPhoneNumber !== null;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'This phone number does not appear to be a valid US phone number.';
    }
}
