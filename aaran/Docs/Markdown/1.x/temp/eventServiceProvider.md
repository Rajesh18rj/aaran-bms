To trigger an event when a user logs in, you need to define the event and listener in the `EventServiceProvider` and ensure the listener handles the event appropriately. Here is how you can do it:

1. Define the event and listener in the `EventServiceProvider`.
2. Create the event class.
3. Create the listener class.

### Step 1: Define the event and listener in the `EventServiceProvider`

Update the `EventServiceProvider` to include the `Login` event and the corresponding listener.

```php
<?php

namespace App\Providers;

use App\Helper\Listeners\SetTenantIdInSession;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        Login::class => [
            SetTenantIdInSession::class,
        ],
    ];

    public function boot()
    {
        parent::boot();

        // Register an event at the time of boot
        Event::listen(Login::class, SetTenantIdInSession::class);
    }
}
```

### Step 2: Create the event class

If you don't already have an event class for the login event, you can create one. However, in this case, Laravel already provides the `Login` event, so you don't need to create a new one.

### Step 3: Create the listener class

You already have the `SetTenantIdInSession` listener class. Ensure it handles the `Login` event correctly.

```php
<?php

namespace App\Helper\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SetTenantIdInSession
{
    public function __construct()
    {
        //
    }

    public function handle(Login $event): void
    {
        session()->put('tenant_id', $event->user->tenant_id);
        session()->put('role_id', $event->user->role_id);
    }
}
```

With these steps, the `SetTenantIdInSession` listener will be triggered whenever a user logs in.
