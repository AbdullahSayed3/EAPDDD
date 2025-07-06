<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Support\Collection;
use Spatie\Permission\Contracts\Permission as PermissionContract;
use Spatie\Permission\Exceptions\PermissionAlreadyExists;
use Spatie\Permission\Exceptions\PermissionDoesNotExist;
use Spatie\Permission\Guard;
use Spatie\Permission\PermissionRegistrar;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Traits\RefreshesPermissionCache;

class Permission extends Model implements PermissionContract
{
    use HasRoles;
    use RefreshesPermissionCache;

    public $guarded = ['id'];

    protected $fillable = ['name', 'guard_name', 'nice_name'];

    public function __construct(array $attributes = [])
    {
        $attributes['guard_name'] = $attributes['guard_name'] ?? config('auth.defaults.guard');

        parent::__construct($attributes);

        $this->setTable(config('permission.table_names.permissions'));
    }

    public static function create(array $attributes = [])
    {
        $attributes['guard_name'] = $attributes['guard_name'] ?? Guard::getDefaultName(static::class);

        $permission = static::getPermissions()->filter(function ($permission) use ($attributes) {
            return $permission->name === $attributes['name'] && $permission->guard_name === $attributes['guard_name'];
        })->first();

        if ($permission) {
            throw PermissionAlreadyExists::create($attributes['name'], $attributes['guard_name']);
        }

        if (isNotLumen() && app()::VERSION < '5.4') {
            return parent::create($attributes);
        }

        return static::query()->create($attributes);
    }

    /**
     * A permission can be applied to roles.
     */
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(
            config('permission.models.role'),
            config('permission.table_names.role_has_permissions')
        );
    }

    /**
     * A permission belongs to some users of the model associated with its guard.
     */
    public function users(): MorphToMany
    {
        return $this->morphedByMany(
            getModelForGuard($this->attributes['guard_name']),
            'model',
            config('permission.table_names.model_has_permissions'),
            'permission_id',
            'model_id'
        );
    }

    /**
     * Find a permission by its name (and optionally guardName).
     *
     *
     * @throws \Spatie\Permission\Exceptions\PermissionDoesNotExist
     */
    public static function findByName(string $name, ?string $guardName = null): PermissionContract
    {
        $guardName = $guardName ?? Guard::getDefaultName(static::class);

        $permission = static::getPermissions()->filter(function ($permission) use ($name, $guardName) {
            return $permission->name === $name && $permission->guard_name === $guardName;
        })->first();

        if (! $permission) {
            throw PermissionDoesNotExist::create($name, $guardName);
        }

        return $permission;
    }

    /**
     * Find a permission by its id (and optionally guardName).
     *
     *
     * @throws \Spatie\Permission\Exceptions\PermissionDoesNotExist
     */
    public static function findById($id, ?string $guardName = null): PermissionContract
    {
        $guardName = $guardName ?? Guard::getDefaultName(static::class);

        $permission = static::getPermissions()->filter(function ($permission) use ($id, $guardName) {
            return $permission->id === $id && $permission->guard_name === $guardName;
        })->first();

        if (! $permission) {
            throw PermissionDoesNotExist::withId($id, $guardName);
        }

        return $permission;
    }

    /**
     * Find or create permission by its name (and optionally guardName).
     */
    public static function findOrCreate(string $name, ?string $guardName = null): PermissionContract
    {
        $guardName = $guardName ?? Guard::getDefaultName(static::class);

        $permission = static::getPermissions()->filter(function ($permission) use ($name, $guardName) {
            return $permission->name === $name && $permission->guard_name === $guardName;
        })->first();

        if (! $permission) {
            return static::create(['name' => $name, 'guard_name' => $guardName]);
        }

        return $permission;
    }

    /**
     * Get the current cached permissions.
     */
    protected static function getPermissions(): Collection
    {
        return app(PermissionRegistrar::class)->getPermissions();
    }
}
