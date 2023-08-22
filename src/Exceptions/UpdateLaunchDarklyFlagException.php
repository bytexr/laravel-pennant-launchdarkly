<?php

namespace ByteXR\LaravelPennantLaunchDarkly\Exceptions;

use Exception;

class UpdateLaunchDarklyFlagException extends Exception
{
    protected $message = 'Create/Update/Delete of feature flags are only available inside LaunchDarkly app.';
}