<?php

namespace App\Http\Controllers;

use App\Models\Program;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProgramController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
    }

    /**
     *
     * @throws AuthorizationException
     */
    public function index()
    {
        $this->authorize("viewAny", Program::class);
        return Inertia::render("Programs/Index", [
            "programs" => Program::withTrashed()->paginate(10)
        ]);
    }

    /**
     * @return string
     * @throws AuthorizationException
     */
    public function create()
    {
        $this->authorize('create', Program::class);
        return "Can Create";
    }

    /**
     * @param Program $program
     * @return string
     * @throws AuthorizationException
     */
    public function show(Program $program)
    {
        $this->authorize('view', $program);
        return "Can Show";
    }

    /**
     * @param Program $program
     * @return string
     * @throws AuthorizationException
     */
    public function edit(Program $program)
    {
        $this->authorize('update', $program);
        return "Can Edit";
    }

    /**
     * @param Request $request
     * @param Program $program
     * @return string
     * @throws AuthorizationException
     */
    public function update(Request $request, Program $program)
    {
        $this->authorize('update', $program);
        return "Can Update";
    }

    /**
     * @param Program $program
     * @return string
     * @throws AuthorizationException
     */
    public function destroy(Program $program)
    {
        $this->authorize('delete', $program);
        return "Can Delete";
    }

    /**
     * @param int $id
     * @return string
     * @throws AuthorizationException
     */
    public function restore(int $id)
    {
        $program = Program::withTrashed()->find($id);
        $this->authorize('restore', $program);
        return "Can Restore";
    }
}
