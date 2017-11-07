<?php

namespace App\Event;

use Illuminate\Queue\SerializesModels;

abstract class Event
{
    use SerializesModels;
}
