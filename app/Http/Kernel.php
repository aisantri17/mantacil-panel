<?php

namespace MantaCil\Http;

use Illuminate\Auth\Middleware\Authorize;
use Illuminate\Http\Middleware\HandleCors;
use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Http\Middleware\TrustProxies;
use MantaCil\Http\Middleware\TrimStrings;
use Illuminate\Session\Middleware\StartSession;
use MantaCil\Http\Middleware\EncryptCookies;
use MantaCil\Http\Middleware\Api\IsValidJson;
use MantaCil\Http\Middleware\VerifyCsrfToken;
use MantaCil\Http\Middleware\VerifyReCaptcha;
use Illuminate\Routing\Middleware\ThrottleRequests;
use MantaCil\Http\Middleware\LanguageMiddleware;
use MantaCil\Http\Middleware\SetSecurityHeaders;
use Illuminate\Foundation\Http\Kernel as HttpKernel;
use Illuminate\Routing\Middleware\SubstituteBindings;
use MantaCil\Http\Middleware\Activity\TrackAPIKey;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use MantaCil\Http\Middleware\MaintenanceMiddleware;
use MantaCil\Http\Middleware\EnsureStatefulRequests;
use MantaCil\Http\Middleware\RedirectIfAuthenticated;
use Illuminate\Auth\Middleware\AuthenticateWithBasicAuth;
use MantaCil\Http\Middleware\Api\AuthenticateIPAccess;
use Illuminate\Foundation\Http\Middleware\ValidatePostSize;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use MantaCil\Http\Middleware\Api\Daemon\DaemonAuthenticate;
use MantaCil\Http\Middleware\Api\Client\RequireClientApiKey;
use MantaCil\Http\Middleware\RequireTwoFactorAuthentication;
use Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull;
use MantaCil\Http\Middleware\Api\Client\SubstituteClientBindings;
use Illuminate\Foundation\Http\Middleware\PreventRequestsDuringMaintenance;
use MantaCil\Http\Middleware\Api\Application\AuthenticateApplicationUser;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     */
    protected $middleware = [
        TrustProxies::class,
        HandleCors::class,
        PreventRequestsDuringMaintenance::class,
        ValidatePostSize::class,
        TrimStrings::class,
        ConvertEmptyStringsToNull::class,
        SetSecurityHeaders::class,
    ];

    protected $middlewarePriority = [
        SubstituteClientBindings::class,
    ];

    /**
     * The application's route middleware groups.
     */
    protected $middlewareGroups = [
        'web' => [
            EncryptCookies::class,
            AddQueuedCookiesToResponse::class,
            StartSession::class,
            ShareErrorsFromSession::class,
            VerifyCsrfToken::class,
            SubstituteBindings::class,
            LanguageMiddleware::class,
        ],
        'api' => [
            EnsureStatefulRequests::class,
            'auth:sanctum',
            IsValidJson::class,
            TrackAPIKey::class,
            RequireTwoFactorAuthentication::class,
            AuthenticateIPAccess::class,
        ],
        'application-api' => [
            SubstituteBindings::class,
            AuthenticateApplicationUser::class,
        ],
        'client-api' => [
            SubstituteClientBindings::class,
            RequireClientApiKey::class,
        ],
        'daemon' => [
            SubstituteBindings::class,
            DaemonAuthenticate::class,
        ],
    ];

    /**
     * The application's route middleware.
     */
    protected $middlewareAliases = [
        'auth' => Authenticate::class,
        'auth.basic' => AuthenticateWithBasicAuth::class,
        'auth.session' => AuthenticateSession::class,
        'guest' => RedirectIfAuthenticated::class,
        'csrf' => VerifyCsrfToken::class,
        'throttle' => ThrottleRequests::class,
        'can' => Authorize::class,
        'bindings' => SubstituteBindings::class,
        'recaptcha' => VerifyReCaptcha::class,
        'node.maintenance' => MaintenanceMiddleware::class,
    ];
}
