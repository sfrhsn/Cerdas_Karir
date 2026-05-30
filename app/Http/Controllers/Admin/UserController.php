<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\UserRepositoryInterface;

class UserController extends Controller
{
    public function __construct(protected UserRepositoryInterface $userRepository) {}

    public function index()
    {
        $users = $this->userRepository->all();
        return view('admin.users.index', compact('users'));
    }

    public function destroy(int $id)
    {
        $this->userRepository->delete($id);
        return redirect()->route('admin.users.index')->with('success', 'User dihapus.');
    }
}