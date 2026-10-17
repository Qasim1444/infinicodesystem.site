<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class CreateBlogAdmin extends Command
{
    protected $signature = 'blog:admin:create {email} {name?}';

    protected $description = 'Create or promote an account for the Filament administrator panel';

    public function handle(): int
    {
        $email = (string) $this->argument('email');
        $name = (string) ($this->argument('name') ?: $this->ask('Administrator name'));
        $validator = Validator::make(compact('email', 'name'), [
            'email' => ['required', 'email'],
            'name' => ['required', 'string', 'max:255'],
        ]);

        if ($validator->fails()) {
            $this->error($validator->errors()->first());

            return self::FAILURE;
        }

        $password = $this->secret('Set a password (minimum 12 characters)');
        $confirmation = $this->secret('Confirm password');

        if (! is_string($password) || strlen($password) < 12 || $password !== $confirmation) {
            $this->error('Password must be at least 12 characters and both entries must match.');

            return self::FAILURE;
        }

        $user = User::query()->firstOrNew(['email' => $email]);
        $user->name = $name;
        $user->password = Hash::make($password);
        $user->is_admin = true;
        $user->save();

        $this->info("Blog administrator ready for {$email}.");

        return self::SUCCESS;
    }
}
