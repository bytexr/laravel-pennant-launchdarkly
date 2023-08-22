<?php

namespace ByteXR\LaravelPennantLaunchDarkly\Concerns;

use LaunchDarkly\LDContext;
use LaunchDarkly\LDUser;

interface HasLaunchDarklyContext
{
    public function getLaunchDarklyContext(): LDContext|LDUser;
}
